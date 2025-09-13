<?php

namespace Miraheze\Config\Tests\ManageWiki;

use JsonSchema\Constraints\BaseConstraint;

class ExtensionsTest extends ManageWikiTestCase {

	public function getSchema(): object {
		$installOrRemove = [
			'type' => 'object',
			'additionalProperties' => false,
			'properties' => [
				'mwscript' => [
					'type' => 'object',
					'description' => 'mapped to script path => array of options.',
				],
				'namespaces' => [
					'type' => 'object',
					'description' => "array of which namespaces and namespace data to install with extension; 'remove' only needs namespace ID.",
					'patternProperties' => [
						'^[A-Z][A-Za-z_]+$' => [
							'type' => 'object',
						],
					],
				],
				'permissions' => [
					'type' => 'object',
					'description' => 'array of which permissions to install with extension.',
					'properties' => [
						'type' => 'array',
					]
				],
				'settings' => [
					'type' => 'object',
					'description' => 'array of ManageWikiSettings to modify when the extension is enabled, mapped variable => value.',
					'patternProperties' => [
						self::REGEX_CONFIG => []
					],
				],
				'sql' => [
					'type' => 'object',
					'description' => 'array of sql files to install with extension, mapped table name => sql file path.',
				],
			],
		];

		return BaseConstraint::arrayToObjectRecursive( [
			'type' => 'object',
			'additionalProperties' => false,
			'patternProperties' => [
				'^[a-z0-9_-]+$' => [
					'type' => 'object',
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
							'type' => 'object',
							'additionalProperties' => false,
							'properties' => [
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
								'files' => [
									'type' => 'integer',
									'description' => 'max integer amount of files a wiki may have in order to enable this extension.',
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
								'users' => [
									'type' => 'integer',
									'description' => 'max integer amount of users a wiki may have in order to enable this extension.',
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
		] );
	}

	/** @covers $wgManageWikiExtensions */
	public function testManageWikiExtensions() {
		global $wgManageWikiExtensions, $wi;
		$wi = $this->mockMirahezeFunctions();

		require_once __DIR__ . '/../../ManageWikiExtensions.php';
		$this->assertSchema( BaseConstraint::arrayToObjectRecursive( $wgManageWikiExtensions ) );
	}

	/** @inheritDoc */
	public static function configProvider(): array {
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
