<?php

namespace Miraheze\Config\Tests\ManageWiki;

class SettingsTest extends ManageWikiTestCase {

	public function getSchema(): object {
		return json_decode( json_encode( [
			'type' => 'object',
			'additionalProperties' => false,
			'patternProperties' => [
				self::REGEX_CONFIG => [
					'type' => 'object',
					'additionalProperties' => false,
					'properties' => [
						'associativeKey' => [
							'type' => 'string',
							'description' => 'the associative array key. Only used if you are setting the associative value.',
						],
						'name' => [
							'type' => 'string',
							'description' => 'the displayed name of the setting on Special:ManageWiki/settings.',
							'pattern' => self::REGEX_READABLE,
							'required' => true,
						],
						'from' => [
							'type' => 'string',
							'description' => "a text entry of which extension is required for this setting to work. If added by MediaWiki core, use 'mediawiki'.",
							'required' => true,
						],
						'global' => [
							'type' => 'boolean',
							'description' => 'set to true if the setting is added by MediaWiki core or a global extension or skin.',
						],
						'type' => [
							'description' => 'configuration type.',
							'anyOf' => [
								[
									'const' => 'check',
									'description' => 'adds a checkbox.',
								],
								[
									'const' => 'database',
									'description' => 'adds a textbox with input validation, verifying that its value is a valid database name.',
								],
								[
									'const' => 'float',
									'description' => 'adds a textbox with float validation (requires: minfloat and maxfloat which are minimum and maximum float values).',
								],
								[
									'const' => 'integer',
									'description' => 'adds a textbox with integer validation (requires: minint and maxint which are minimum and maximum integer values).',
								],
								[
									'const' => 'integers',
									'description' => 'see above, just supports multiple and does not require a min or max integer value.',
								],
								[
									'const' => 'language',
									'description' => 'adds a dropdown for language selection (all which are known to MediaWiki).',
								],
								[
									'const' => 'list',
									'description' => 'adds a list of options (requires: options which is an array in form of display => internal value).',
								],
								[
									'const' => 'list-multi',
									'description' => 'see above, just that multiple can be selected.',
								],
								[
									'const' => 'list-multi-bool',
									'description' => 'see above, just outputs are $this => $bool.',
								],
								[
									'const' => 'list-multi-int',
									'description' => 'see above, just saves values as a list of integers rather than strings.',
								],
								[
									'const' => 'matrix',
									'description' => 'adds an array of "columns" and "rows". Columns are the top array and rows will be the values.',
								],
								[
									'const' => 'preferences',
									'description' => 'adds a drop down selection box for selecting multiple user preferences.',
								],
								[
									'const' => 'skin',
									'description' => 'adds a drop down selection box for selecting a single enabled skin.',
								],
								[
									'const' => 'skins',
									'description' => 'adds a drop down selection box for selecting multiple enabled skins.',
								],
								[
									'const' => 'text',
									'description' => 'adds a single line text entry.',
								],
								[
									'const' => 'texts',
									'description' => 'see above, except multiple text values for inserting into a configuration array.',
								],
								[
									'const' => 'timezone',
									'description' => 'adds a dropdown for timezone selection.',
								],
								[
									'const' => 'url',
									'description' => 'adds a single line text entry which requires a full URL.',
								],
								[
									'const' => 'user',
									'description' => 'adds an autocomplete text box to select a single user on the wiki.',
								],
								[
									'const' => 'users',
									'description' => 'see above, except multiple users.',
								],
								[
									'const' => 'usergroups',
									'description' => 'adds a drop down selection box for selecting multiple user groups.',
								],
								[
									'const' => 'userrights',
									'description' => 'adds a drop down selection box for selecting multiple user rights.',
								],
								[
									'const' => 'wikipage',
									'description' => 'add a textbox which will return an autocomplete drop-down list of wikipages. Returns standardised MediaWiki pages.',
								],
								[
									'const' => 'wikipages',
									'description' => 'see above, except multiple wikipages.',
								],
							],
							'required' => true,
						],
						'overridedefault' => [
							'required' => true,
							'description' => 'a string/array override default when no existing value exist.',
						],
						'help' => [
							'type' => 'string',
							'description' => 'string providing help information for the setting.',
							'pattern' => self::REGEX_READABLE,
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
							'type' => 'object',
							'patternProperties' => [
								self::REGEX_READABLE => []
							]
						],
						'minfloat' => [
							'type' => 'number',
						],
						'maxfloat' => [
							'type' => 'number',
						],
						'minint' => [
							'type' => 'integer',
						],
						'maxint' => [
							'type' => 'integer',
						],
						'section' => [
							'type' => 'string',
							'description' => 'string name of groupings for settings.',
							'required' => true,
						],
						'requires' => [
							'type' => 'object',
							'additionalProperties' => false,
							'properties' => [
								'articles' => [
									'type' => 'integer',
									'description' => 'max integer amount of articles a wiki may have in order to be able to modify this setting.',
								],
								'extensions' => [
									'type' => 'array',
									'description' => "array of extensions that must be enabled in order to modify this setting. Different from 'from'. Only use if requires more then one extension.",
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
									'description' => 'max integer amount of files a wiki may have in order to be able to modify this setting.',
								],
								'pages' => [
									'type' => 'integer',
									'description' => 'max integer amount of pages a wiki may have in order to be able to modify this setting.',
								],
								'permissions' => [
									'type' => 'array',
									'description' => 'array of permissions a user must have to be able to modify this setting. Regardless of this value, a user must always have the managewiki permission.',
									'items' => [
										'type' => 'string'
									]
								],
								'settings' => [
									'type' => 'object',
								],
								'users' => [
									'type' => 'integer',
									'description' => 'max integer amount of users a wiki may have in order to be able to modify this setting.',
								],
								'visibility' => [
									'type' => 'object',
									'additionalProperties' => false,
									'properties' => [
										'permissions' => [
											'type' => 'array',
											'description' => 'Set to an array of permissions required for the setting to be visible.',
											'items' => [
												'type' => 'string',
											],
										],
										'state' => [
											'type' => 'string',
											'description' => 'Can be either \'private\' or \'public\'. If set to \'private\' this setting will only be visible on private wikis. If set to \'public\' it will only be visible on public wikis.',
											'enum' => [
												'private',
												'public',
											],
										],
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
		] ) );
	}

	/** @covers $wgManageWikiSettings */
	public function testManageWikiSettings() {
		global $wgManageWikiSettings, $IP, $wgPasswordSender, $wmgSharedUploadDBname, $wmgUploadHostname, $wi;
		$IP = '';
		$wgPasswordSender = '';
		$wmgSharedUploadDBname = '';
		$wmgUploadHostname = '';
		$wi = $this->mockMirahezeFunctions();

		require_once __DIR__ . '/../../ManageWikiSettings.php';
		$this->assertSchema( json_decode( json_encode( $wgManageWikiSettings ) ) );
	}

	/** @inheritDoc */
	public static function configProvider(): array {
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
				''
			],
			'An invalid configuration should not be passed the validation.' => [
				[
					'wgAbuseFilterActions' => [
						'type' => 'check',
					]
				],
				implode( "\n", [
					'[wgAbuseFilterActions.name] The property name is required',
					'[wgAbuseFilterActions.from] The property from is required',
					'[wgAbuseFilterActions.overridedefault] The property overridedefault is required',
					'[wgAbuseFilterActions.help] The property help is required',
					'[wgAbuseFilterActions.section] The property section is required',
				] ),
			],
		];
	}
}
