<?php

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace MediaWiki\Sniffs\PHPUnit;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Fix uses of assertEquals or assertSame with the actual value before the expected
 * Currently, only catches assertions where the actual value is a variable, or at least
 * starts with a variable token, and the expected is a literal value (string, boolean, null, or
 * number) or a variable named $expected.
 *
 * @author DannyS712
 */
class AssertionOrderSniff implements Sniff {
	use PHPUnitTestTrait;

	private const ASSERTIONS = [
		'assertEquals' => true,
		'assertSame' => true,
	];

	/**
	 * @inheritDoc
	 */
	public function register(): array {
		return [ T_STRING ];
	}

	/**
	 * @param File $phpcsFile
	 * @param int $stackPtr
	 *
	 * @return void|int
	 */
	public function process( File $phpcsFile, $stackPtr ) {
		if ( !$this->isTestFile( $phpcsFile, $stackPtr ) ) {
			return $phpcsFile->numTokens;
		}

		$tokens = $phpcsFile->getTokens();
		if ( $tokens[$stackPtr]['level'] < 2 ) {
			// Needs to be in a method in a class
			return;
		}

		$assertion = $tokens[$stackPtr]['content'];
		if ( !isset( self::ASSERTIONS[$assertion] ) ) {
			// Don't care about this string
			return;
		}

		$opener = $phpcsFile->findNext( T_WHITESPACE, $stackPtr + 1, null, true );
		if ( !isset( $tokens[$opener]['parenthesis_closer'] ) ) {
			// Needs to be a method call
			return $opener;
		}

		$varToken = $phpcsFile->findNext( T_WHITESPACE, $opener + 1, null, true );
		if ( $tokens[$varToken]['code'] !== T_VARIABLE ) {
			// First parameter isn't a variable
			return;
		}

		// First parameter could just be a variable $foo, or something more complicated,
		// like $foo->method() or $foo['key'] - regardless, since it starts with a variable,
		// if the second parameter is a literal then they should be swapped
		// Jump over the expected parameter, whatever it is
		$end = $tokens[$opener]['parenthesis_closer'];
		$searchTokens = [
			T_OPEN_CURLY_BRACKET,
			T_OPEN_SQUARE_BRACKET,
			T_OPEN_PARENTHESIS,
			T_OPEN_SHORT_ARRAY,
			T_COMMA,
		];
		$commaToken = false;
		$next = $phpcsFile->findNext( $searchTokens, $varToken, $end );
		while ( $commaToken === false ) {
			if ( $next === false ) {
				// No token
				return;
			}
			switch ( $tokens[$next]['code'] ) {
				case T_OPEN_CURLY_BRACKET:
				case T_OPEN_SQUARE_BRACKET:
				case T_OPEN_PARENTHESIS:
				case T_OPEN_SHORT_ARRAY:
					if ( isset( $tokens[$next]['parenthesis_closer'] ) ) {
						// jump to closing parenthesis to ignore commas between opener and closer
						$next = $tokens[$next]['parenthesis_closer'];
					} elseif ( isset( $tokens[$next]['bracket_closer'] ) ) {
						// jump to closing bracket
						$next = $tokens[$next]['bracket_closer'];
					}
					break;
				case T_COMMA:
					$commaToken = $next;
					break;
			}
			$next = $phpcsFile->findNext( $searchTokens, $next + 1, $end );
		}

		// If we got here, then we know there is a first parameter based on a variable,
		// and then $commaToken - check the second parameter. It should be the "actual"
		// value, but if its a literal, or a variable named $expected*, then we assume it
		// was meant to be the "expected" value and switch them.

		$expectedToken = $phpcsFile->findNext( T_WHITESPACE, $commaToken + 1, null, true );
		$codesToReplace = [ T_NULL, T_FALSE, T_TRUE, T_LNUMBER, T_DNUMBER, T_CONSTANT_ENCAPSED_STRING ];
		if ( !in_array( $tokens[$expectedToken]['code'], $codesToReplace ) ) {
			// Not a comparison to one of the allowed literals, check variable name
			if ( $tokens[$expectedToken]['code'] !== T_VARIABLE ) {
				return;
			}
			$expectedVarName = $tokens[$expectedToken]['content'];
			// optimize for common case - full name is $expected
			if ( $expectedVarName !== '$expected'
				// but also handle $expectedRes and similar
				&& strpos( $expectedVarName, '$expected' ) !== 0
			) {
				return;
			}
		}

		$nextToken = $phpcsFile->findNext( T_WHITESPACE, $expectedToken + 1, null, true );
		if ( !in_array( $tokens[$nextToken]['code'], [ T_COMMA, T_CLOSE_PARENTHESIS ] ) ) {
			// Not followed by a comma and a third parameter, or a closing parenthesis
			// something more complex is going on
			// TODO handle complex cases where the second parameter isn't just a literal,
			// but is a combination thereof because it has no variables, eg 2+2
			return;
		}

		$fix = $phpcsFile->addFixableWarning(
			'The expected value goes before the actual value in assertions',
			$stackPtr,
			'WrongOrder'
		);
		if ( !$fix ) {
			// There is no way the next assertion can be closer than this
			return $end + 4;
		}

		// $varToken is the start of the actual, find the end excluding the whitespace
		// before the comma
		$actualParamEnd = $phpcsFile->findPrevious( T_WHITESPACE, $commaToken - 1, null, true );
		$actualParamContent = $phpcsFile->getTokensAsString(
			$varToken,
			$actualParamEnd - $varToken + 1,
			// keep tabs on multiline statements
			true
		);

		// For now, we know that the expected param is only a single token, so its easier,
		// but this will eventually need to have the same handling as the actual param
		$expectedParamContent = $tokens[$expectedToken]['content'];

		$phpcsFile->fixer->beginChangeset();

		// Remove the first parameter that previously held the actual value,
		// and replace with the expected
		$phpcsFile->fixer->replaceToken( $varToken, $expectedParamContent );
		for ( $i = $varToken + 1; $i <= $actualParamEnd; $i++ ) {
			$phpcsFile->fixer->replaceToken( $i, '' );
		}

		// Remove the second parameter that previously held the expected value,
		// and replace with the actual
		$phpcsFile->fixer->replaceToken( $expectedToken, $actualParamContent );

		$phpcsFile->fixer->endChangeset();

		// There is no way the next assertion can be closer than this
		return $end + 4;
	}

}
