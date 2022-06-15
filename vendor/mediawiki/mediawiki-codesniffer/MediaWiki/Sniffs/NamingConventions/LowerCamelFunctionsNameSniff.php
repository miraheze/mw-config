<?php

namespace MediaWiki\Sniffs\NamingConventions;

use MediaWiki\Sniffs\PHPUnit\PHPUnitTestTrait;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Make sure lower camel function name.
 */
class LowerCamelFunctionsNameSniff implements Sniff {

	use PHPUnitTestTrait;

	// Magic methods.
	private const MAGIC_METHODS = [
		'__construct' => true,
		'__destruct' => true,
		'__call' => true,
		'__callstatic' => true,
		'__get' => true,
		'__set' => true,
		'__isset' => true,
		'__unset' => true,
		'__sleep' => true,
		'__wakeup' => true,
		'__tostring' => true,
		'__set_state' => true,
		'__clone' => true,
		'__invoke' => true,
		'__serialize' => true,
		'__unserialize' => true,
		'__debuginfo' => true
	];

	// A list of non-magic methods with double underscore.
	private const METHOD_DOUBLE_UNDERSCORE = [
		'__soapcall' => true,
		'__getlastrequest' => true,
		'__getlastresponse' => true,
		'__getlastrequestheaders' => true,
		'__getlastresponseheaders' => true,
		'__getfunctions' => true,
		'__gettypes' => true,
		'__dorequest' => true,
		'__setcookie' => true,
		'__setlocation' => true,
		'__setsoapheaders' => true
	];

	// Scope list.
	private const SCOPE_LIST = [
		T_CLASS => true,
		T_INTERFACE => true,
		T_TRAIT => true
	];

	/**
	 * @inheritDoc
	 */
	public function register(): array {
		return [ T_FUNCTION ];
	}

	/**
	 * @param File $phpcsFile
	 * @param int $stackPtr The current token index.
	 * @return void
	 */
	public function process( File $phpcsFile, $stackPtr ) {
		$originalFunctionName = $phpcsFile->getDeclarationName( $stackPtr );
		if ( $originalFunctionName === null ) {
			return;
		}

		$lowerFunctionName = strtolower( $originalFunctionName );
		if ( isset( self::METHOD_DOUBLE_UNDERSCORE[$lowerFunctionName] ) ||
			isset( self::MAGIC_METHODS[$lowerFunctionName] )
		) {
			// Method is excluded from this sniff
			return;
		}

		$containsUnderscores = strpos( $originalFunctionName, '_' ) !== false;
		if ( $originalFunctionName[0] === $lowerFunctionName[0] &&
			( !$containsUnderscores || $this->isTestFunction( $phpcsFile, $stackPtr ) )
		) {
			// Everything is ok when the first letter is lowercase and there are no underscores
			// (except in tests where they are allowed)
			return;
		}

		$tokens = $phpcsFile->getTokens();
		foreach ( $tokens[$stackPtr]['conditions'] as $code ) {
			if ( !isset( self::SCOPE_LIST[$code] ) ) {
				continue;
			}

			$phpcsFile->addError(
				'Function name "%s" should use lower camel case.',
				$stackPtr,
				'FunctionName',
				[ $originalFunctionName ]
			);
		}
	}
}
