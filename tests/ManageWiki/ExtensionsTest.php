<?php

namespace Miraheze\Config\Tests\ManageWiki;

class ExtensionsTest extends ManageWikiTestCase {
	public function getSchema(): array {
		$installOrRemove = [
			'type' => 'array',
			'additionalProperties' => false,
			'properties' => [
				'files' => [
					'type' => 'array',
					'description' => 'mapped to location => source.',
				],
				'mwscript' => [
					'type' => 'array',
					'description' => 'mapped to script path => array of options.',
				],
				'namespaces' => [
					'type' => 'array',
					'description' => "array of which namespaces and namespace data to install with extension; 'remove' only needs namespace ID.",
					'patternProperties' => [
						'^[A-Z][A-Za-z_]+$' => [
							'type' => 'array',
						],
					],
				],
				'permissions' => [
					'type' => 'array',
					'description' => 'array of which permissions to install with extension.',
					'properties' => [
						'type' => 'array',
					]
				],
				'settings' => [
					'type' => 'array',
					'description' => 'array of ManageWikiSettings to modify when the extension is enabled, mapped variable => value.',
					'patternProperties' => [
						self::REGEX_CONFIG => []
					],
				],
				'sql' => [
					'type' => 'array',
					'description' => 'array of sql files to install with extension, mapped table name => sql file path.',
				],
			],
		];
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
							'description' => 'MUST match the name in extension.json, skin.json, or $wgExtensionCredits.',
							'pattern' => self::REGEX_READABLE,
							'required' => true,
						],
						'displayname' => [
							'type' => 'string',
							'description' => 'the plain text display name, or a localised message key to be displayed.',
							'pattern' => self::REGEX_READABLE,
						],
						'description' => [
							'type' => 'string',
							'pattern' => self::REGEX_READABLE,
						],
						'help' => [
							'type' => 'string',
							'description' => 'additional help information for the extension.',
							'pattern' => self::REGEX_READABLE,
						],
						'linkPage' => [
							'type' => 'string',
							'description' => 'full url for an information page for the extension.',
							'required' => true,
						],
						'conflicts' => [
							'description' => 'string of extensions that cause this extension to not work.',
							'anyOf' => [
								[
									'type' => 'boolean',
								],
								[
									'type' => 'string',
								],
							],
						],
						'requires' => [
							'type' => 'array',
							'additionalProperties' => false,
							'properties' => [
								'activeusers' => [
									'type' => 'integer',
									'description' => 'max integer amount of active users a wiki may have in order to enable this extension.',
								],
								'articles' => [
									'type' => 'integer',
									'description' => 'max integer amount of articles a wiki may have in order to enable this extension.',
								],
								'extensions' => [
									'type' => 'array',
									'description' => 'array of other extensions that must be enabled in order to enable this extension.',
									'items' => [
										'anyOf' => [
											[
												'type' => 'string'
											],
											[
												'type' => 'array',
												'items' => [
													'type' => 'string'
												],
											],
										]
									]
								],
								'pages' => [
									'type' => 'integer',
									'description' => 'max integer amount of pages a wiki may have in order to enable this extension.',
								],
								'permissions' => [
									'type' => 'array',
									'items' => [
										'type' => 'string'
									]
								],
								'visibility' => [
									'type' => 'array',
									'additionalProperties' => false,
									'properties' => [
										'state' => [
											'type' => 'string',
											'description' => "If set to 'private' this extension can only be enabled on private wikis. If set to 'public' it can only be enabled on public wikis.",
											'enum' => [
												'private',
												'public',
											],
										],
									],
								],
							],
						],
						'install' => $installOrRemove,
						'remove' => $installOrRemove,
						'section' => [
							'type' => 'string',
							'description' => 'string name of groupings for extension.',
							'required' => true,
						],
					],
				],
			],
		];
	}

	/** @covers $wgManageWikiExtensions */
	public function testManageWikiExtensions() {
		global $wgManageWikiExtensions, $wi, $IP;
		define( 'MW_VERSION', null );

		$IP = '';
		$wi = $this->mockConfigurationSetup();

		require_once __DIR__ . '/../../ManageWikiExtensions.php';
		$this->assertSchema( $wgManageWikiExtensions );
	}

	/** @inheritDoc */
	public function configProvider(): array {
		return [
			'A valid configuration should be passed the validation.' => [
				[
					'shortdescription' => [
						'name' => 'ShortDescription',
						'linkPage' => 'foo',
						'conflicts' => false,
						'requires' => [],
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
