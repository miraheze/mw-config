<?php

namespace Miraheze\Tests\ManageWiki;

class SettingsTest extends ManageWikiTestCase {
	public const SCHEMA = [
		'type' => 'array',
		'additionalProperties' => false,
		'patternProperties' => [
			'^(wg|eg|wmg)[a-zA-Z_][a-zA-Z0-9_]*$' => [
				'type' => 'array',
				'additionalProperties' => false,
				'properties' => [
					'name' => [
						'type' => 'string',
						'required' => true,
					],
					'from' => [
						'type' => 'string',
						'required' => true,
					],
					'global' => [
						'type' => 'boolean',
					],
					'type' => [
						'type' => 'string',
						'enum' => [
							'check',
							'database',
							'integer',
							'integers',
							'list-multi-bool',
							'list-multi',
							'list',
							'preferences',
							'skin',
							'skins',
							'text',
							'texts',
							'timezone',
							'url',
							'user',
							'usergroups',
							'users',
							'wikipage',
							'wikipages',
						],
						'required' => true,
					],
					'exists' => [
						'type' => 'boolean',
					],
					'allopts' => [
						'type' => 'array',
						'additionalProperties' => false,
						'items' => [
							'type' => 'string',
						],
					],
					'options' => [
						'type' => 'array',
					],
					'minint' => [
						'type' => 'integer',
					],
					'maxint' => [
						'type' => 'integer',
					],
					'overridedefault' => [
						'required' => true,
					],
					'section' => [
						'type' => 'string',
						'required' => true,
					],
					'help' => [
						'type' => 'string',
						'required' => true,
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
					'script' => [
						'type' => 'array',
						'properties' => [
							'type' => 'array',
							'additionalProperties' => false,
							'patternProperties' => [
								'update' => 'boolean',
							],
						],
					],
				],
			],
		],
	];

	/** @covers $wgManageWikiSettings */
	public function testManageWikiSettings() {
		global $wgManageWikiSettings, $IP, $wmgSharedUploadDBname, $wmgUploadHostname, $wgConf, $wi;
		$IP = '';
		$wmgSharedUploadDBname = '';
		$wmgUploadHostname = '';
		$wgConf = $this->mockConfig();
		$wi = (object)[
			'dbname' => '',
		];

		require_once __DIR__ . '/../../ManageWikiSettings.php';
		$this->assertSchema(
			$wgManageWikiSettings,
			self::SCHEMA
		);
	}

	/** @inheritDoc */
	public function configProvider(): array {
		return [
			'A valid configuration should be passed the validation.' => [
				[
					'wgAbuseFilterActions' => [
						'name' => 'AbuseFilter Actions',
						'from' => 'abusefilter',
						'type' => 'list-multi-bool',
						'overridedefault' => [
							'block' => true,
						],
						'section' => 'anti-spam',
						'help' => 'Lorem ipsum.',
					]
				],
				self::SCHEMA,
				true
			],
			'An invalid configuration should not be passed the validation.' => [
				[
					'wgAbuseFilterActions' => [
						'foo' => 'bar'
					]
				],
				self::SCHEMA,
				false
			],
		];
	}
}
