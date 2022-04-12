<?php

namespace Miraheze\Tests\ManageWiki;

use JsonSchema\Validator;
use PHPUnit\Framework\TestCase;
use stdClass;

abstract class ManageWikiTestCase extends TestCase {

	abstract public function getSchema(): array;

	public function mockConfig(): stdClass {
		$mock = $this->getMockBuilder( stdClass::class )
			->addMethods( [ 'get' ] )
			->getMock();
		$mock->method( 'get' )->willReturn( false );

		return $mock;
	}

	public function assertSchema( $config ) {
		$validator = new Validator();
		$validator->validate( $config, $this->getSchema() );

		$this->assertTrue(
			$validator->isValid(),
			self::readableError( $validator->getErrors() )
		);
	}

	abstract public function configProvider(): array;

	/** @dataProvider configProvider */
	public function testScheme( $config, $expected ) {
		$validator = new Validator();
		$validator->validate( $config, $this->getSchema() );

		$this->assertSame(
			$expected,
			self::readableError( $validator->getErrors() )
		);
	}

	public static function readableError( array $errors ): string {
		$msgs = [];
		foreach ( $errors as $err ) {
			$msgs[] = "[{$err['property']}] {$err['message']}";
		}
		return implode( "\n", $msgs );
	}

}
