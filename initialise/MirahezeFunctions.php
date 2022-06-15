<?php

require_once '/srv/mediawiki/config/vendor/autoload.php';

use pcrov\JsonReader\InputStream\IOException;
use pcrov\JsonReader\JsonReader;

class MirahezeFunctions {
	private $cacheArray;

	public $hostname;
	public $dbname;
	public $server;
	public $sitename;
	public $missing;
	public $wikiDBClusters;
	public static $disabledExtensions = [];

	private const CACHE_DIRECTORY = '/srv/mediawiki/cache';

	private const DEFAULT_SERVER = [
		'default' => 'miraheze.org',
		'betaheze' => 'betaheze.org',
	];

	private const GLOBAL_DATABASE = [
		'default' => 'mhglobal',
		'beta' => 'testglobal',
	];

	private const TAGS = [
		'default' => 'default',
		'beta' => 'betaheze',
	];

	public const LISTS = [
		'default' => 'production',
		'betaheze' => 'beta',
	];

	public const SUFFIXES = [
		'wiki' => 'miraheze.org',
		'wikibeta' => 'betaheze.org',
	];

	public function __construct() {
		self::setupHooks();
		self::setupSiteConfiguration();

		$this->hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';
		$this->dbname = self::getCurrentDatabase();
		$this->wikiDBClusters = self::getDatabaseClusters();

		$this->server = self::getServer();
		$this->sitename = self::getSiteName();
		$this->missing = self::isMissing();

		$this->setDatabase();
		$this->setServers();
		$this->setSiteNames();
	}

	public static function getLocalDatabases(): array {
		global $wgLocalDatabases;

		static $list = null;
		static $databases = null;

		$list ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::getCurrentDatabase() ] ) ? 'beta' : 'production';

		// We need the CLI to be able to access 'deleted' wikis
		if ( PHP_SAPI === 'cli' ) {
			$databases ??= array_merge( self::readDbListFile( $list ), self::readDbListFile( 'deleted-' . $list ) );
		}

		$databases ??= self::readDbListFile( $list );

		$wgLocalDatabases = $databases;
		return $databases;
	}

	public static function readDbListFile( $dblist, $onlyDBs = true, $database = false, $fromServer = false ) {
			if ( $database && $onlyDBs && !$fromServer ) {
				return $database;
			}

			if ( $dblist === 'production' ) {
				$dblist = 'databases';
			}

			if ( $dblist === 'deleted-production' ) {
				$dblist = 'deleted';
			}

			if ( !file_exists( self::CACHE_DIRECTORY . "/{$dblist}.json" ) ) {
				$databases = [];

				return $databases;
			} else {
				$databasesArray = json_decode( file_get_contents( self::CACHE_DIRECTORY . "/{$dblist}.json" ), true );
			}

			if ( $database ) {
				if ( $fromServer ) {
					$server = $database;
					$database = false;
					foreach ( $databasesArray['combi'] ?? $databasesArray['databases'] as $key => $data ) {
						if ( isset( $data['u'] ) && $data['u'] === $server ) {
							$database = $key;
							break;
						}
					}

					if ( $onlyDBs ) {
						return $database;
					}
				}

				if ( isset( $databasesArray['combi'][$database] ) || isset( $databasesArray['databases'][$database] ) ) {
					return $databasesArray['combi'][$database] ?? $databasesArray['databases'][$database];
				} else {
					return false;
				}
			} else {
				$databases = $databasesArray['combi'] ?? $databasesArray['databases'];
			}

			if ( $onlyDBs ) {
				return array_keys( $databases );
			}

			return $databases;
	}

	public static function setupHooks() {
		global $wgHooks;

		$wgHooks['CreateWikiJsonGenerateDatabaseList'][] = 'MirahezeFunctions::onGenerateDatabaseLists';
	}

	public static function setupSiteConfiguration() {
		global $wgConf;

		$wgConf = new SiteConfiguration();

		$wgConf->suffixes = array_keys( self::SUFFIXES );
		$wgConf->wikis = self::getLocalDatabases();
	}

	public static function getRealm(): string {
		static $realm = null;

		$realm ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::getCurrentDatabase() ] ) ?
			self::TAGS['beta'] : self::TAGS['default'];

		return $realm;
	}

	public static function getCurrentSuffix(): string {
		return array_flip( self::SUFFIXES )[ self::DEFAULT_SERVER[self::getRealm()] ];
	}

	public static function getServers( ?string $database = null, bool $deleted = false ) {
		$servers = [];

		static $default = null;
		static $list = null;

		$list ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::getCurrentDatabase() ] ) ? 'beta' : 'production';
		$databases = self::readDbListFile( $list, false, $database );

		if ( $deleted ) {
			$databases += self::readDbListFile( "deleted-$list", false, $database );
		}

		if ( $database !== null ) {
			if ( is_string( $database ) && $database !== 'default' ) {
				foreach ( array_flip( self::SUFFIXES ) as $suffix ) {
					if ( substr( $database, -strlen( $suffix ) ) === $suffix ) {
						return $databases['u'] ?? 'https://' . substr( $database, 0, -strlen( $suffix ) ) . '.' . self::SUFFIXES[$suffix];
					}
				}
			}

			$default ??= 'https://' . self::DEFAULT_SERVER[self::getRealm()];
			return $default;
		}

		foreach ( $databases as $db => $data ) {
			foreach ( array_flip( self::SUFFIXES ) as $suffix ) {
				if ( substr( $db, -strlen( $suffix ) ) === $suffix ) {
					$servers[$db] = $data['u'] ?? 'https://' . substr( $db, 0, -strlen( $suffix ) ) . '.' . self::SUFFIXES[$suffix];
				}
			}
		}

		$default ??= 'https://' . self::DEFAULT_SERVER[self::getRealm()];
		$servers['default'] = $default;

		return $servers;
	}

	public static function getCurrentDatabase() {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
		}

		$hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';

		static $database = null;
		$database ??= self::readDbListFile( 'production', true, 'https://' . $hostname, true ) ?:
			self::readDbListFile( 'beta', true, 'https://' . $hostname, true );

		if ( $database ) {
			return $database;
		}

		$explode = explode( '.', $hostname, 2 );

		if ( $explode[0] === 'www' ) {
			$explode = explode( '.', $explode[1], 2 );
		}

		foreach ( self::SUFFIXES as $suffix => $site ) {
			if ( $explode[1] === $site ) {
				return $explode[0] . $suffix;
			}
		}
	}

	public function setDatabase() {
		global $wgConf, $wgDBname;

		$wgConf->settings['wgDBname'][$this->dbname] = $this->dbname;
		$wgDBname = $this->dbname;
	}

	public static function getDatabaseClusters(): array {
		static $allDatabases = null;
		static $deletedDatabases = null;

		$allDatabases ??= self::readDbListFile( self::LISTS[self::getRealm()], false );
		$deletedDatabases ??= self::readDbListFile( 'deleted-' . self::LISTS[self::getRealm()], false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$clusters = array_column( $databases, 'c' );

		return array_combine( array_keys( $databases ), $clusters );
	}

	public static function getServer(): string {
		return self::getServers( self::getCurrentDatabase() ?: 'default' );
	}

	public function setServers() {
		global $wgConf, $wgServer;

		$wgConf->settings['wgServer'] = self::getServers( null, true );
		$wgServer = self::getServer();
	}

	public function setSiteNames() {
		global $wgConf, $wgSitename;

		$wgConf->settings['wgSitename'] = self::getSiteNames();
		$wgSitename = self::getSiteName();
	}

	public static function getSiteNames() {
		static $allDatabases = null;
		static $deletedDatabases = null;

		$allDatabases ??= self::readDbListFile( self::LISTS[self::getRealm()], false );
		$deletedDatabases ??= self::readDbListFile( 'deleted-' . self::LISTS[self::getRealm()], false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$siteNameColumn = array_column( $databases, 's' );

		$siteNames = array_combine( array_keys( $databases ), $siteNameColumn );
		$siteNames['default'] = 'No sitename set.';

		return $siteNames;
	}

	public static function getSiteName() {
		return self::getSiteNames()[self::getCurrentDatabase()] ?? self::getSiteNames()['default'];
	}

	public static function isMissing() {
		global $wgConf;

		return !in_array( self::getCurrentDatabase(), $wgConf->wikis );
	}

	public static function getCacheArray(): array {
		// If we don't have a cache file, let us exit here
		if ( !file_exists( self::CACHE_DIRECTORY . '/' . self::getCurrentDatabase() . '.json' ) ) {
			return [];
		}

		return (array)json_decode( file_get_contents(
			self::CACHE_DIRECTORY . '/' . self::getCurrentDatabase() . '.json'
		), true );
	}

	private static $globals;

	public static function getConfigGlobals(): array {
		global $IP, $wgDBname, $wgConf;

		// Try configuration cache
		$confCacheFileName = "config-$wgDBname.json";

		// To-Do: merge ManageWiki cache with main config cache,
		// to automatically update when ManageWiki is updated
		$confActualMtime = max(
			// When config files are updated
			filemtime( __DIR__ . '/../LocalSettings.php' ),
			filemtime( __DIR__ . '/../ManageWikiExtensions.php' ),
			filemtime( __DIR__ . '/../ManageWikiNamespaces.php' ),
			filemtime( __DIR__ . '/../ManageWikiSettings.php' ),

			// When MediaWiki is upgraded
			filemtime( "$IP/includes/Defines.php" ),

			// When ManageWiki is changed
			@filemtime( self::CACHE_DIRECTORY . '/' . $wgDBname . '.json' )
		);

		self::$globals ??= iterator_to_array(
			self::readFromCache(
				self::CACHE_DIRECTORY . '/' . $confCacheFileName,
				$confActualMtime
			)
		)[1] ?? null;

		if ( !self::$globals ) {
			$wgConf->settings = array_merge(
				$wgConf->settings,
				self::getManageWikiConfigCache()
			);

			self::$globals = self::getConfigForCaching();

			$confCacheObject = [ 'mtime' => $confActualMtime, 'globals' => $globals, 'extensions' => self::getActiveExtensions() ];

			$minTime = $confActualMtime + intval( ini_get( 'opcache.revalidate_freq' ) );
			if ( time() > $minTime ) {
				self::writeToCache(
					$confCacheFileName, $confCacheObject
				);
			}
		}

		return self::$globals;
	}

	public static function getConfigForCaching() {
		global $wgDBname, $wgConf;

		$wikiTags = [];
		if ( self::getRealm() !== 'default' ) {
			$wikiTags[] = self::getRealm();
		}

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();
		foreach ( $cacheArray['states'] ?? [] as $state => $value ) {
			if ( $value !== 'exempt' && (bool)$value ) {
				$wikiTags[] = $state;
			}
		}

		$wikiTags = array_merge( preg_filter( '/^/', 'ext-',
				str_replace( ' ', '', self::getActiveExtensions() )
			), $wikiTags
		);

		list( $site, $lang ) = $wgConf->siteFromDB( $wgDBname );
		$dbSuffix = self::getCurrentSuffix();

		$confParams = [
			'lang' => $lang,
			'site' => $site,
		];

		$globals = $wgConf->getAll( $wgDBname, $dbSuffix, $confParams, $wikiTags );

		return $globals;
	}

	public static function writeToCache( string $cacheShard, array $configObject ) {
		@mkdir( self::CACHE_DIRECTORY );
		$tmpFile = tempnam( '/tmp/', $cacheShard );

		$cacheObject = json_encode(
			$configObject,
			JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		) . "\n";

		if ( $tmpFile ) {
			if ( json_last_error() !== JSON_ERROR_NONE ) {
				trigger_error( 'Config cache failure: Encoding failed', E_USER_ERROR );
			} else {
				if ( file_put_contents( $tmpFile, $cacheObject ) ) {
					if ( rename( $tmpFile, self::CACHE_DIRECTORY . '/' . $cacheShard ) ) {
						return;
					}
				}
			}

			unlink( $tmpFile );
		}
	}

	public static function readFromCache(
		string $confCacheFile,
		string $confActualMtime,
		string $type = 'globals'
	): Generator {
		try {
			$reader = new JsonReader();
			$reader->open( $confCacheFile );
			$reader->read( 'mtime' );

			if ( $reader->value() == $confActualMtime ) {
				do {
					yield $reader->value();
				} while ( $reader->read( $type ) );
			}

			$reader->close();
		} catch ( IOException $e ) {
			trigger_error( 'Config cache failure: Decoding failed', $e );
		}

		return null;
	}

	public static function getManageWikiConfigCache(): array {
		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();

		if ( !$cacheArray ) {
			return [];
		}

		$settings['wgLanguageCode']['default'] = $cacheArray['core']['wgLanguageCode'];

		// Assign states
		$settings['cwPrivate']['default'] = (bool)$cacheArray['states']['private'];
		$settings['cwClosed']['default'] = (bool)$cacheArray['states']['closed'];
		$settings['cwInactive']['default'] = ( $cacheArray['states']['inactive'] === 'exempt' ) ? 'exempt' : (bool)$cacheArray['states']['inactive'];
		$settings['cwExperimental']['default'] = (bool)( $cacheArray['states']['experimental'] ?? false );

		// Assign settings
		if ( isset( $cacheArray['settings'] ) ) {
			foreach ( $cacheArray['settings'] as $var => $val ) {
				$settings[$var]['default'] = $val;
			}
		}

		// Handle namespaces - additional settings will be done in ManageWiki
		if ( isset( $cacheArray['namespaces'] ) ) {
			foreach ( $cacheArray['namespaces'] as $name => $ns ) {
				$settings['wgExtraNamespaces']['default'][(int)$ns['id']] = $name;
				$settings['wgNamespacesToBeSearchedDefault']['default'][(int)$ns['id']] = $ns['searchable'];
				$settings['wgNamespacesWithSubpages']['default'][(int)$ns['id']] = $ns['subpages'];
				$settings['wgNamespaceContentModels']['default'][(int)$ns['id']] = $ns['contentmodel'];

				if ( $ns['content'] ) {
					$settings['wgContentNamespaces']['default'][] = (int)$ns['id'];
				}

				if ( $ns['protection'] ) {
					$settings['wgNamespaceProtection']['default'][(int)$ns['id']] = [ $ns['protection'] ];
				}

				foreach ( (array)$ns['aliases'] as $alias ) {
					$settings['wgNamespaceAliases']['default'][$alias] = (int)$ns['id'];
				}
			}
		}

		// Handle Permissions
		if ( isset( $cacheArray['permissions'] ) ) {
			foreach ( $cacheArray['permissions'] as $group => $perm ) {
				foreach ( (array)$perm['permissions'] as $id => $right ) {
					$settings['wgGroupPermissions']['default'][$group][$right] = true;
				}

				foreach ( (array)$perm['addgroups'] as $name ) {
					$settings['wgAddGroups']['default'][$group][] = $name;
				}

				foreach ( (array)$perm['removegroups'] as $name ) {
					$settings['wgRemoveGroups']['default'][$group][] = $name;
				}

				foreach ( (array)$perm['addself'] as $name ) {
					$settings['wgGroupsAddToSelf']['default'][$group][] = $name;
				}

				foreach ( (array)$perm['removeself'] as $name ) {
					$settings['wgGroupsRemoveFromSelf']['default'][$group][] = $name;
				}

				if ( $perm['autopromote'] !== null ) {
					$onceId = array_search( 'once', $perm['autopromote'] );

					if ( !is_bool( $onceId ) ) {
						unset( $perm['autopromote'][$onceId] );
						$promoteVar = 'wgAutopromoteOnce';
					} else {
						$promoteVar = 'wgAutopromote';
					}

					$settings[$promoteVar]['default'][$group] = $perm['autopromote'];
				}
			}
		}

		return $settings;
	}

	public function getSettingValue( string $setting, string $wiki = 'default' ) {
		global $wgConf;

		$this->cacheArray ??= self::getCacheArray();

		return $this->cacheArray['settings'][$setting] ?? $wgConf->get( $setting, $wiki );
	}

	public static function getActiveExtensions(): array {
		global $IP, $wgDBname;

		$confCacheFileName = "config-$wgDBname.json";

		// To-Do: merge ManageWiki cache with main config cache,
		// to automatically update when ManageWiki is updated
		$confActualMtime = max(
			// When config files are updated
			filemtime( __DIR__ . '/../LocalSettings.php' ),
			filemtime( __DIR__ . '/../ManageWikiExtensions.php' ),

			// When MediaWiki is upgraded
			filemtime( "$IP/includes/Defines.php" ),

			// When ManageWiki is changed
			@filemtime( self::CACHE_DIRECTORY . '/' . $wgDBname . '.json' )
		);

		static $extensions = null;
		$extensions ??= iterator_to_array(
			self::readFromCache(
				self::CACHE_DIRECTORY . '/' . $confCacheFileName,
				$confActualMtime,
				'extensions'
			)
		)[2] ?? null;

		if ( $extensions ) {
			return $extensions;
		}

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();

		if ( !$cacheArray ) {
			return [];
		}

		global $wgManageWikiExtensions;

		$allExtensions = array_filter( array_combine(
			array_column( $wgManageWikiExtensions, 'name' ),
			array_keys( $wgManageWikiExtensions )
		) );

		$enabledExtensions = array_keys(
			array_diff( $allExtensions, static::$disabledExtensions )
		);

		// To-Do: Deprecate 'var', and make database/cache use extension names
		/* return array_intersect( array_keys(
			array_intersect(
				array_flip( $allExtensions ),
				$cacheArray['extensions'] ?? []
			)
		), $enabledExtensions ); */

		return array_intersect(
			array_keys( array_intersect(
				array_flip( array_filter( array_flip(
					array_column( $wgManageWikiExtensions, 'var', 'name' )
				) ) ),
				$cacheArray['extensions'] ?? []
			) ),
			$enabledExtensions
		);
	}

	private static $activeExtensions;

	public function isExtensionActive( string $extension ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		return in_array( $extension, self::$activeExtensions );
	}

	public function isAnyOfExtensionsActive( string ...$extensions ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		return count( array_intersect( $extensions, self::$activeExtensions ) ) > 0;
	}

	public function isAllOfExtensionsActive( string ...$extensions ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		return count( array_intersect( $extensions, self::$activeExtensions ) ) === count( $extensions );
	}

	public function loadExtensions() {
		global $wgDBname;

		if ( !file_exists( self::CACHE_DIRECTORY . '/' . $wgDBname . '.json' ) ) {
			global $wgConf;
			if ( self::getRealm() !== 'default' ) {
				$wgConf->siteParamsCallback = static function () {
					return [
						'suffix' => null,
						'lang' => 'en',
						'tags' => [ self::getRealm() ],
						'params' => [],
					];
				};
			}

			return;
		}

		if ( !file_exists( self::CACHE_DIRECTORY . '/extension-list.json' ) ) {
			$queue = array_fill_keys( array_merge(
					glob( '/srv/mediawiki/w/extensions/*/extension*.json' ),
					glob( '/srv/mediawiki/w/skins/*/skin.json' )
				),
			true );

			$processor = new ExtensionProcessor();

			foreach ( $queue as $path => $mtime ) {
				$json = file_get_contents( $path );
				$info = json_decode( $json, true );
				$version = $info['manifest_version'];

				$processor->extractInfo( $path, $info, $version );
			}

			$data = $processor->getExtractedInfo();

			$list = array_column( $data['credits'], 'path', 'name' );

			file_put_contents( self::CACHE_DIRECTORY . '/extension-list.json', json_encode( $list ), LOCK_EX );
		} else {
			$list = json_decode( file_get_contents( self::CACHE_DIRECTORY . '/extension-list.json' ), true );
		}

		foreach ( self::getActiveExtensions() as $name ) {
			$path = $list[ $name ] ?? false;

			$pathInfo = pathinfo( $path )['extension'] ?? false;
			if ( $path && $pathInfo === 'json' ) {
				ExtensionRegistry::getInstance()->queue( $path );
			}
		}
	}

	private static function getActiveList( $globalDatabase ) {
		$dbr = wfGetDB( DB_REPLICA, [], $globalDatabase );
		$activeWikis = $dbr->select(
			'cw_wikis',
			[
				'wiki_dbcluster',
				'wiki_dbname',
				'wiki_sitename',
			], [
				'wiki_closed' => 0,
				'wiki_deleted' => 0,
				'wiki_inactive' => 0,
			],
			__METHOD__
		);

		$activeList = [];
		foreach ( $activeWikis as $wiki ) {
			$activeList[$wiki->wiki_dbname] = [
				's' => $wiki->wiki_sitename,
				'c' => $wiki->wiki_dbcluster,
			];
		}

		return $activeList;
	}

	private static function getCombiList( $globalDatabase ) {
		$dbr = wfGetDB( DB_REPLICA, [], $globalDatabase );
		$allWikis = $dbr->select(
			'cw_wikis',
			[
				'wiki_dbcluster',
				'wiki_dbname',
				'wiki_url',
				'wiki_sitename',
			], [
				'wiki_deleted' => 0,
			],
			__METHOD__
		);

		$combiList = [];
		foreach ( $allWikis as $wiki ) {
			$combiList[$wiki->wiki_dbname] = [
				's' => $wiki->wiki_sitename,
				'c' => $wiki->wiki_dbcluster,
			];

			if ( $wiki->wiki_url !== null ) {
				$combiList[$wiki->wiki_dbname]['u'] = $wiki->wiki_url;
			}
		}

		return $combiList;
	}

	private static function getDeletedList( $globalDatabase ) {
		$dbr = wfGetDB( DB_REPLICA, [], $globalDatabase );
		$deletedWikis = $dbr->select(
			'cw_wikis',
			[
				'wiki_dbcluster',
				'wiki_dbname',
				'wiki_sitename',
			], [
				'wiki_deleted' => 1,
			],
			__METHOD__
		);

		$deletedList = [];
		foreach ( $deletedWikis as $wiki ) {
			$deletedList[$wiki->wiki_dbname] = [
				's' => $wiki->wiki_sitename,
				'c' => $wiki->wiki_dbcluster,
			];
		}

		return $deletedList;
	}

	public static function onGenerateDatabaseLists( &$databaseLists ) {
		$databaseLists = [
			'active' => [
				'combi' => self::getActiveList(
					self::GLOBAL_DATABASE['default']
				),
			],
			'active-beta' => [
				'combi' => self::getActiveList(
					self::GLOBAL_DATABASE['beta']
				),
			],
			'beta' => [
				'combi' => self::getCombiList(
					self::GLOBAL_DATABASE['beta']
				),
			],
			'databases' => [
				'combi' => self::getCombiList(
					self::GLOBAL_DATABASE['default']
				),
			],
			'deleted' => [
				'deleted' => 'databases',
				'databases' => self::getDeletedList(
					self::GLOBAL_DATABASE['default']
				),
			],
			'deleted-beta' => [
				'deleted-beta' => 'databases',
				'databases' => self::getDeletedList(
					self::GLOBAL_DATABASE['beta']
				),
			],
		];
	}
}
