<?php

namespace Miraheze\Config\Tests\ManageWiki;

use JsonSchema\Validator;
use Miraheze\Config\Tests\Mock\MirahezeFunctions;
use PHPUnit\Framework\TestCase;

abstract class ManageWikiTestCase extends TestCase {

	public const REGEX_READABLE = '^(?!.*<a href=)(?!.*<br\s*>)[A-Za-z0-9 _,;:!?“”(){}*/&#<=>|\.\'\"\[\]\$-]+$';
	public const REGEX_CONFIG = '^(wg|eg|wmg|wgex|smwg)[A-Z_][a-zA-Z0-9_]*$';

	abstract public function getSchema(): array;

	public function mockMirahezeFunctions(): MirahezeFunctions {
		$methods = [
			'getSettingValue' => [],
			'isAllOfExtensionsActive' => true,
			'isAnyOfExtensionsActive' => true,
			'isExtensionActive' => true,
		];

		$mock = $this->getMockBuilder( MirahezeFunctions::class )
			->onlyMethods( array_keys( $methods ) )
			->getMock();

		$mock->dbname = '';
		$mock->server = '';
		$mock->sitename = '';
		$mock->version = '';

		foreach ( $methods as $m => $returnValue ) {
			$mock
				->method( $m )
				->willReturn( $returnValue );
		}

		return $mock;
	}

	public function assertSchema( $config ) {
		$validator = new Validator();
		$validator->validate( $config, $this->getSchema() );

		$this->assertTrue(
			$validator->isValid(),
			self::readableErrors( $validator->getErrors() )
		);
	}

	private static function readableErrors( array $errors ): string {
		$msgs = [];
		foreach ( $errors as $err ) {
			$msgs[] = "[{$err['property']}] {$err['message']}";
		}
		return implode( "\n", $msgs );
	}
}
