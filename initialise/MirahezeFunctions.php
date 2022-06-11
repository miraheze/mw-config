<?php

use MediaWiki\MediaWikiServices;

class MirahezeFunctions {
	private $cacheArray;

	public $hostname;
	public $dbname;
	public $server;
	public $sitename;
	public $missing;
	public $wikiDBClusters;
	public $disabledExtensions = [];

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

	public static function getServers( $database = null ) {
		$servers = [];

		static $default = null;
		static $list = null;

		$list ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::getCurrentDatabase() ] ) ? 'beta' : 'production';
		$databases = self::readDbListFile( $list, false, $database );

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
		global $wgConf;

		$wgConf->settings['wgDBname'][$this->dbname] = $this->dbname;
		$wgConf->extractGlobal( 'wgDBname', $this->dbname );
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
		global $wgConf;

		$wgConf->settings['wgServer'] = self::getServers();
		$wgConf->extractGlobal( 'wgServer', $this->dbname );
	}

	public function setSiteNames() {
		global $wgConf;

		$wgConf->settings['wgSitename'] = self::getSiteNames();
		$wgConf->extractGlobal( 'wgSitename', $this->dbname );
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

	public function getCacheArray(): array {
		// If we don't have a cache file, let us exit here
		if ( !file_exists( self::CACHE_DIRECTORY . '/' . $this->dbname . '.json' ) ) {
			return [];
		}

		return (array)json_decode( file_get_contents(
			self::CACHE_DIRECTORY . '/' . $this->dbname . '.json'
		), true );
	}

	public static function getCachedConfig( string $wiki = 'all' ): array {
		global $wgDBname;
		$wanObjectCache = MediaWikiServices::getInstance()->getMainWANObjectCache();
		return $wanObjectCache->getWithSetCallback(
			$wanObjectCache->makeGlobalKey(
				'miraheze-config',
				$wgDBname
			),
			WANObjectCache::TTL_HOUR,
			static function () use ( $wiki ) {
				global $wgConf;

				if ( $wiki === 'all' ) {
					return $wgConf->settings;
				}

				return $wgConf->getAll( $wiki );
			}
		);
	}

	public function getManageWikiConfigCache(): array {
		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return [];
		}

		$settings['wgLanguageCode'] = $this->cacheArray['core']['wgLanguageCode'];

		// Assign states
		$settings['cwPrivate'] = (bool)$this->cacheArray['states']['private'];
		$settings['cwClosed'] = (bool)$this->cacheArray['states']['closed'];
		$settings['cwInactive'] = ( $this->cacheArray['states']['inactive'] === 'exempt' ) ? 'exempt' : (bool)$this->cacheArray['states']['inactive'];
		$settings['cwExperimental'] = (bool)( $this->cacheArray['states']['experimental'] ?? false );

		// Assign settings
		$settings += $this->cacheArray['settings'] ?? [];

		// Handle namespaces - additional settings will be done in ManageWiki
		if ( isset( $this->cacheArray['namespaces'] ) ) {
			foreach ( $this->cacheArray['namespaces'] as $name => $ns ) {
				$settings['wgExtraNamespaces'][(int)$ns['id']] = $name;
				$settings['wgNamespacesToBeSearchedDefault'][(int)$ns['id']] = $ns['searchable'];
				$settings['wgNamespacesWithSubpages'][(int)$ns['id']] = $ns['subpages'];
				$settings['wgNamespaceContentModels'][(int)$ns['id']] = $ns['contentmodel'];

				if ( $ns['content'] ) {
					$settings['wgContentNamespaces'][] = (int)$ns['id'];
				}

				if ( $ns['protection'] ) {
					$settings['wgNamespaceProtection'][(int)$ns['id']] = [ $ns['protection'] ];
				}

				foreach ( (array)$ns['aliases'] as $alias ) {
					$settings['wgNamespaceAliases'][$alias] = (int)$ns['id'];
				}
			}
		}

		// Handle Permissions
		if ( isset( $this->cacheArray['permissions'] ) ) {
			foreach ( $this->cacheArray['permissions'] as $group => $perm ) {
				foreach ( (array)$perm['permissions'] as $id => $right ) {
					$settings['wgGroupPermissions'][$group][$right] = true;
				}

				foreach ( (array)$perm['addgroups'] as $name ) {
					$settings['wgAddGroups'][$group][] = $name;
				}

				foreach ( (array)$perm['removegroups'] as $name ) {
					$settings['wgRemoveGroups'][$group][] = $name;
				}

				foreach ( (array)$perm['addself'] as $name ) {
					$settings['wgGroupsAddToSelf'][$group][] = $name;
				}

				foreach ( (array)$perm['removeself'] as $name ) {
					$settings['wgGroupsRemoveFromSelf'][$group][] = $name;
				}

				if ( $perm['autopromote'] !== null ) {
					$onceId = array_search( 'once', $perm['autopromote'] );

					if ( !is_bool( $onceId ) ) {
						unset( $perm['autopromote'][$onceId] );
						$promoteVar = 'wgAutopromoteOnce';
					} else {
						$promoteVar = 'wgAutopromote';
					}

					$settings[$promoteVar][$group] = $perm['autopromote'];
				}
			}
		}

		return $settings;
	}

	public function getSettingValue( string $setting ) {
		$this->cacheArray ??= $this->getCacheArray();

		return $this->cacheArray['settings'][$setting] ?? null;
	}

	public function getActiveExtensions(): array {
		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return [];
		}

		global $wgManageWikiExtensions;

		$allExtensions = array_filter( array_combine(
			array_column( $wgManageWikiExtensions, 'name' ),
			array_keys( $wgManageWikiExtensions )
		) );

		$enabledExtensions = array_keys(
			array_diff( $allExtensions, $this->disabledExtensions )
		);

		// To-Do: Deprecate 'var', and make database/cache use extension names
		/* return array_intersect( array_keys(
			array_intersect(
				array_flip( $allExtensions ),
				$this->cacheArray['extensions'] ?? []
			)
		), $enabledExtensions ); */

		return array_intersect(
			array_keys( array_intersect(
				array_flip( array_filter( array_flip(
					array_column( $wgManageWikiExtensions, 'var', 'name' )
				) ) ),
				$this->cacheArray['extensions'] ?? []
			) ),
			$enabledExtensions
		);
	}

	public function isExtensionActive( string $extension ): bool {
		static $activeExtensions = null;

		$activeExtensions ??= $this->getActiveExtensions();
		return in_array( $extension, $activeExtensions );
	}

	public function isAnyOfExtensionsActive( string ...$extensions ): bool {
		static $activeExtensions = null;

		$activeExtensions ??= $this->getActiveExtensions();
		return count( array_intersect( $extensions, $activeExtensions ) ) > 0;
	}

	public function isAllOfExtensionsActive( string ...$extensions ): bool {
		static $activeExtensions = null;

		$activeExtensions ??= $this->getActiveExtensions();
		return count( array_intersect( $extensions, $activeExtensions ) ) === count( $extensions );
	}

	public function loadExtensions() {
		global $wgConf;

		static $activeExtensions = null;
		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
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

		$activeExtensions ??= $this->getActiveExtensions();

		$tags = [];
		if ( self::getRealm() !== 'default' ) {
			$tags[] = self::getRealm();
		}

		foreach ( $this->cacheArray['states'] as $state => $value ) {
			if ( $value !== 'exempt' && (bool)$value ) {
				$tags[] = $state;
			}
		}

		$tags = array_merge( preg_filter( '/^/', 'ext-',
				str_replace( ' ', '', $activeExtensions )
			), $tags
		);

		$lang = $this->cacheArray['core']['wgLanguageCode'] ?? 'en';

		$wgConf->siteParamsCallback = static function () use ( $tags, $lang ) {
			return [
				'suffix' => null,
				'lang' => $lang,
				'tags' => $tags,
				'params' => [],
			];
		};

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

		foreach ( $activeExtensions as $name ) {
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
				'active' => 'databases',
				'databases' => self::getActiveList(
					self::GLOBAL_DATABASE['default']
				),
			],
			'active-beta' => [
				'active-beta' => 'databases',
				'databases' => self::getActiveList(
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
