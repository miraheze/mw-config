<?php

namespace MediaWiki\Sniffs\PHPUnit;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Replace assertEquals and assertSame where the actual value is count( anything ) with
 * the more specific assertCount. Based on AssertEqualsSniff sniff
 *
 * @author DannyS712
 * @license GPL-2.0-or-later
 */
class AssertCountSniff implements Sniff {
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
		$assertion = $tokens[$stackPtr]['content'];

		// We don't care about stuff that's not in a method in a class
		if ( $tokens[$stackPtr]['level'] < 2 || !isset( self::ASSERTIONS[$assertion] ) ) {
			return;
		}

		$opener = $phpcsFile->findNext( T_WHITESPACE, $stackPtr + 1, null, true );
		if ( !isset( $tokens[$opener]['parenthesis_closer'] ) ) {
			// Looks like this string is not a method call
			return $opener;
		}
		$end = $tokens[$opener]['parenthesis_closer'];

		// Don't complain about the second parameter using count() if the first does
		// too, see T273352
		$expectedStart = $phpcsFile->findNext( T_WHITESPACE, $opener + 1, null, true );
		if ( $expectedStart
			&& $tokens[$expectedStart]['code'] === T_STRING
			&& $tokens[$expectedStart]['content'] === 'count'
		) {
			// Don't trigger again for this line
			return $end;
		}

		// Jump over the expected parameter, whatever it is
		$searchTokens = [
			T_OPEN_CURLY_BRACKET,
			T_OPEN_SQUARE_BRACKET,
			T_OPEN_PARENTHESIS,
			T_OPEN_SHORT_ARRAY,
			T_COMMA
		];
		$commaToken = false;
		$next = $phpcsFile->findNext( $searchTokens, $opener + 1, $end );
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

		$countToken = $phpcsFile->findNext( T_WHITESPACE, $commaToken + 1, null, true );
		if ( $tokens[$countToken]['code'] !== T_STRING ||
			$tokens[$countToken]['content'] !== 'count'
		) {
			// Not `count`
			return;
		}

		$countOpen = $phpcsFile->findNext( T_WHITESPACE, $countToken + 1, null, true );
		if ( !isset( $tokens[$countOpen]['parenthesis_closer'] ) ) {
			// Not a function
			return;
		}

		$countClose = $tokens[$countOpen]['parenthesis_closer'];
		$afterCount = $phpcsFile->findNext( T_WHITESPACE, $countClose + 1, null, true );
		if ( !in_array( $tokens[$afterCount]['code'], [ T_COMMA, T_CLOSE_PARENTHESIS ] ) ) {
			// Not followed by a comma and a third parameter, or a closing parenthesis
			// something more complex is going on
			return;
		}

		$fix = $phpcsFile->addFixableWarning(
			'assertCount can be used instead of manually using %s with the result of count()',
			$stackPtr,
			'NotUsed',
			[ $assertion ]
		);
		if ( !$fix ) {
			return;
		}

		$countContentStart = $phpcsFile->findNext( T_WHITESPACE, $countOpen + 1, null, true );
		$countContentEnd = $phpcsFile->findPrevious( T_WHITESPACE, $countClose - 1, null, true );
		$phpcsFile->fixer->replaceToken( $stackPtr, 'assertCount' );
		$phpcsFile->fixer->replaceToken( $countToken, '' );
		$phpcsFile->fixer->replaceToken( $countOpen, '' );
		for ( $i = $countOpen + 1; $i < $countContentStart; $i++ ) {
			// Whitespace between count( and the content
			$phpcsFile->fixer->replaceToken( $i, '' );
		}
		for ( $i = $countContentEnd + 1; $i < $countClose; $i++ ) {
			// Whitespace between content and )
			$phpcsFile->fixer->replaceToken( $i, '' );
		}
		$phpcsFile->fixer->replaceToken( $countClose, '' );

		// There is no way the next assertEquals() or assertSame() can be closer than this
		return $tokens[$opener]['parenthesis_closer'] + 4;
	}

}
