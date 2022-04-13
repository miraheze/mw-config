<?php

namespace Miraheze\Tests\ManageWiki;

class ExtensionsTest extends ManageWikiTestCase {
	public function getSchema(): array {
		return [
			'type' => 'array',
			'additionalProperties' => false,
			'patternProperties' => [
				'^[a-z0-9_-]+$' => [
					'type' => 'array',
					'additionalProperties' => false,
					'properties' => [
						'name' => [
							'type' => 'string',
							'pattern' => self::REGEX_READABLE,
							'required' => true,
						],
						'displayname' => [
							'type' => 'string',
							'pattern' => self::REGEX_READABLE,
						],
						'description' => [
							'type' => 'string',
							'pattern' => self::REGEX_READABLE,
						],
						'linkPage' => [
							'type' => 'string',
							'required' => true,
						],
						'var' => [
							'type' => 'string',
							'pattern' => self::REGEX_CONFIG,
						],
						'conflicts' => [
							'anyOf' => [
								'type' => 'boolean',
							],
						],
						'requires' => [
							'type' => 'array',
							'anyOf' => [
								[
									'type' => 'array',
									'patternProperties' => [
										'extensions' => 'array',
									],
								],
								[
									'type' => 'array',
									'items' => [
										'type' => 'string',
									],
								],
							],
						],
						'install' => [
							'type' => 'array',
							'additionalProperties' => false,
							'properties' => [
								'settings' => [
									'type' => 'array',
								],
								'sql' => [
									'type' => 'array',
								],
								'namespaces' => [
									'patternProperties' => [
										'^[A-Z][A-Za-z_]+$' => [
											'type' => 'array',
										],
									],
								],
								'permissions' => [
									'type' => 'array',
									'properties' => [
										'type' => 'array',
									]
								],
								'mwscript' => [
									'type' => 'array',
								],
							],
						],
						'remove' => [
							'type' => 'array',
							'additionalProperties' => false,
							'properties' => [
								'settings' => [
									'type' => 'array',
									'patternProperties' => [
										self::REGEX_CONFIG => []
									],
								],
							],
						],
						'section' => [
							'type' => 'string',
							'required' => true,
						],
					],
				],
			],
		];
	}

	/** @covers $wgManageWikiSettings */
	public function testManageWikiSettings() {
		global $wgManageWikiExtensions, $wgConf, $wi, $IP;
		$IP = '';
		$wgConf = $this->mockConfig();
		$wi = $this->mockMirahezeFunctions();

		require_once __DIR__ . '/../../ManageWikiExtensions.php';
		$this->assertSchema( $wgManageWikiExtensions );
	}

	/** @inheritDoc */
	public function configProvider(): array {
		return [
			'A valid configuration should be passed the validation.' => [
				[
					'gettingstarted' => [
						'name' => 'GettingStarted',
						'linkPage' => 'foo',
						'var' => 'wmgUseGettingStarted',
						'conflicts' => false,
						'requires' => [
							'extensions' => [
								'guidedtour',
							],
						],
						'section' => 'api',
					],
				],
				''
			],
			'An invalid configuration should not be passed the validation.' => [
				[
					'pageimages' => [
						'name' => 'PageImages',
					]
				],
				implode( "\n", [
					'[pageimages.linkPage] The property linkPage is required',
					'[pageimages.section] The property section is required',
				] )
			],
		];
	}
}
