<?php

namespace Miraheze\Config\Tests\ManageWiki;

use JsonSchema\Validator;
use PHPUnit\Framework\TestCase;
use stdClass;

abstract class ManageWikiTestCase extends TestCase {

	public const REGEX_READABLE = '^[A-Za-z0-9 _,;:!?“”(){}*/&#<=>|\.\'\"\[\]\$-]+$';
	public const REGEX_CONFIG = '^(wg|eg|wmg|smwg)[A-Z_][a-zA-Z0-9_]*$';

	abstract public function getSchema(): array;

	public function mockConfig(): stdClass {
		$mock = $this->getMockBuilder( stdClass::class )
			->addMethods( [ 'get' ] )
			->getMock();

		$mock
			->method( 'get' )
			->willReturnCallback( static function ( $settingName, $wiki, $suffix = null, $params = [],
				$wikiTags = [] ) {
					switch ( $settingName ) {
						case 'wgFileExtensions':
							return [];
					}
			} );

		return $mock;
	}

	public function mockMirahezeFunctions(): stdClass {
		$methods = [
			'isAllOfExtensionsActive',
			'isExtensionActive'
		];

		$mock = $this->getMockBuilder( stdClass::class )
			->addMethods( $methods )
			->getMock();

		$mock->dbname = '';
		$mock->hostname = '';

		foreach ( $methods as $m ) {
			$mock
				->method( $m )
				->willReturn( true );
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

	abstract public function configProvider(): array;

	/** @dataProvider configProvider */
	public function testGetScheme( $config, $expected ) {
		$validator = new Validator();
		$validator->validate( $config, $this->getSchema() );

		$this->assertSame(
			$expected,
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
