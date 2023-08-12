<?php

use MediaWiki\MediaWikiServices;
use Wikimedia\Rdbms\DBConnRef;

class MirahezeFunctions {

	/** @var string */
	public $dbname;

	/** @var string */
	public $hostname;

	/** @var bool */
	public $missing;

	/** @var string */
	public $server;

	/** @var string */
	public $sitename;

	/** @var string */
	public $version;

	/** @var array */
	public $wikiDBClusters;

	/** @var array */
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

	private const MEDIAWIKI_DIRECTORY = '/srv/mediawiki/';

	private const TAGS = [
		'default' => 'default',
		'beta' => 'betaheze',
	];

	public const LISTS = [
		'default' => 'production',
		'betaheze' => 'beta',
	];

	public const MEDIAWIKI_VERSIONS = [
		'beta' => '1.40',
		'stable' => '1.39',
	];

	public const SUFFIXES = [
		'wiki' => 'miraheze.org',
		'wikibeta' => 'betaheze.org',
	];

	public function __construct() {
		self::setupHooks();
		self::setupSiteConfiguration();

		$this->dbname = self::getCurrentDatabase();
		$this->wikiDBClusters = self::getDatabaseClusters();

		$this->server = self::getServer();
		$this->sitename = self::getSiteName();
		$this->missing = self::isMissing();
		$this->version = self::getMediaWikiVersion();

		$this->hostname = $_SERVER['HTTP_HOST'] ??
			parse_url( $this->server, PHP_URL_HOST ) ?: 'undefined';

		$this->setDatabase();
		$this->setServers();
		$this->setSiteNames();
	}

	/** @var string */
	private static $currentDatabase;

	/**
	 * @return ?array
	 */
	public static function getLocalDatabases(): ?array {
		global $wgLocalDatabases;

		static $list = null;
		static $databases = null;

		self::$currentDatabase ??= self::getCurrentDatabase();

		$list ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::$currentDatabase ] ) ? 'beta' : 'production';

		// We need the CLI to be able to access 'deleted' wikis
		if ( PHP_SAPI === 'cli' ) {
			$databases ??= array_merge( self::readDbListFile( $list ), self::readDbListFile( 'deleted-' . $list ) );
		}

		$databases ??= self::readDbListFile( $list );

		$wgLocalDatabases = $databases;
		return $databases;
	}

	/**
	 * @param string $dblist
	 * @param bool $onlyDBs
	 * @param ?string $database
	 * @param bool $fromServer
	 * @return array|string
	 */
	public static function readDbListFile( string $dblist, bool $onlyDBs = true, ?string $database = null, bool $fromServer = false ) {
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
				$database = '';
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
				return '';
			}
		} else {
			global $wgDatabaseClustersMaintenance;

			$databases = $databasesArray['combi'] ?? $databasesArray['databases'];

			if ( $wgDatabaseClustersMaintenance ) {
				$databases = array_filter( $databases, static function ( $data, $key ) {
					global $wgDBname, $wgCommandLineMode, $wgDatabaseClustersMaintenance;

					if ( $wgDBname && $key === $wgDBname ) {
						if ( !$wgCommandLineMode && in_array( $data['c'], $wgDatabaseClustersMaintenance ) ) {
							require_once '/srv/mediawiki/ErrorPages/databaseMaintenance.php';
						}
					}

					return true;
				}, ARRAY_FILTER_USE_BOTH );
			}
		}

		if ( $onlyDBs ) {
			return array_keys( $databases );
		}

		return $databases;
	}

	public static function setupHooks() {
		global $wgHooks;

		$wgHooks['CreateWikiJsonGenerateDatabaseList'][] = 'MirahezeFunctions::onGenerateDatabaseLists';
		$wgHooks['CreateWikiJsonBuilder'][] = 'MirahezeFunctions::onCreateWikiJsonBuilder';
		$wgHooks['MediaWikiServices'][] = 'MirahezeFunctions::onMediaWikiServices';
	}

	public static function setupSiteConfiguration() {
		global $wgConf;

		$wgConf = new SiteConfiguration();

		$wgConf->suffixes = array_keys( self::SUFFIXES );
		$wgConf->wikis = self::getLocalDatabases();
	}

	/**
	 * @return string
	 */
	public static function getRealm(): string {
		static $realm = null;

		self::$currentDatabase ??= self::getCurrentDatabase();

		$realm ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::$currentDatabase ] ) ?
			self::TAGS['beta'] : self::TAGS['default'];

		return $realm;
	}

	/**
	 * @return string
	 */
	public static function getCurrentSuffix(): string {
		return array_flip( self::SUFFIXES )[ self::DEFAULT_SERVER[self::getRealm()] ];
	}

	/**
	 * @param ?string $database
	 * @param bool $deleted
	 * @return array|string
	 */
	public static function getServers( ?string $database = null, bool $deleted = false ) {
		global $wgConf;

		if ( $database !== null ) {
			if ( $wgConf->get( 'wgServer', $database ) ) {
				return $wgConf->get( 'wgServer', $database );
			}

			if ( isset( $wgConf->settings['wgServer'] ) && count( $wgConf->settings['wgServer'] ) > 1 ) {
				return 'https://' . self::DEFAULT_SERVER[self::getRealm()];
			}
		}

		if ( isset( $wgConf->settings['wgServer'] ) && count( $wgConf->settings['wgServer'] ) > 1 ) {
			return $wgConf->settings['wgServer'];
		}

		$servers = [];

		static $default = null;
		static $list = null;

		self::$currentDatabase ??= self::getCurrentDatabase();

		$list ??= isset( array_flip( self::readDbListFile( 'beta' ) )[ self::$currentDatabase ] ) ? 'beta' : 'production';
		$databases = self::readDbListFile( $list, false, $database );

		if ( $deleted && $databases ) {
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
			$servers[$db] = $data['u']
		}

		$default ??= 'https://' . self::DEFAULT_SERVER[self::getRealm()];
		$servers['default'] = $default;

		return $servers;
	}

	/**
	 * @return string
	 */
	public static function getCurrentDatabase(): string {
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

		return '';
	}

	public function setDatabase() {
		global $wgConf, $wgDBname;

		$wgConf->settings['wgDBname'][$this->dbname] = $this->dbname;
		$wgDBname = $this->dbname;
	}

	/**
	 * @return ?array
	 */
	public static function getDatabaseClusters(): ?array {
		static $allDatabases = null;
		static $deletedDatabases = null;

		$allDatabases ??= self::readDbListFile( self::LISTS[self::getRealm()], false );
		$deletedDatabases ??= self::readDbListFile( 'deleted-' . self::LISTS[self::getRealm()], false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$clusters = array_column( $databases, 'c' );

		return array_combine( array_keys( $databases ), $clusters );
	}

	/**
	 * @return string
	 */
	public static function getServer(): string {
		self::$currentDatabase ??= self::getCurrentDatabase();

		return self::getServers( self::$currentDatabase ?: 'default' );
	}

	public function setServers() {
		global $wgConf, $wgServer;

		$wgConf->settings['wgServer'] = self::getServers( null, true );
		$wgServer = $this->server;
	}

	public function setSiteNames() {
		global $wgConf, $wgSitename;

		$wgConf->settings['wgSitename'] = self::getSiteNames();
		$wgSitename = $this->sitename;
	}

	/**
	 * @return array
	 */
	public static function getSiteNames(): array {
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

	/**
	 * @return string
	 */
	public static function getSiteName(): string {
		self::$currentDatabase ??= self::getCurrentDatabase();

		return self::getSiteNames()[ self::$currentDatabase ] ?? self::getSiteNames()['default'];
	}

	/**
	 * @return string
	 */
	public static function getDefaultMediaWikiVersion(): string {
		return php_uname( 'n' ) === 'test131.miraheze.org' ? 'beta' : 'stable';
	}

	/**
	 * @param ?string $database
	 * @return string
	 */
	public static function getMediaWikiVersion( ?string $database = null ): string {
		if ( getenv( 'MIRAHEZE_WIKI_VERSION' ) ) {
			return getenv( 'MIRAHEZE_WIKI_VERSION' );
		}

		if ( $database ) {
			$mwVersion = self::readDbListFile( 'databases', false, $database )['v'] ?? null;
			return $mwVersion ?? self::MEDIAWIKI_VERSIONS[self::getDefaultMediaWikiVersion()];
		}

		static $version = null;

		if ( PHP_SAPI === 'cli' ) {
			$version ??= explode( '/', $_SERVER['SCRIPT_NAME'] )[3] ?? null;
			if ( !in_array( $version, self::MEDIAWIKI_VERSIONS ) ) {
				$version = null;
			}
		}

		self::$currentDatabase ??= self::getCurrentDatabase();
		$version ??= self::readDbListFile( 'databases', false, self::$currentDatabase )['v'] ?? null;

		return $version ?? self::MEDIAWIKI_VERSIONS[self::getDefaultMediaWikiVersion()];
	}

	/**
	 * @param string $file
	 * @return string
	 */
	public static function getMediaWiki( string $file ): string {
		global $IP;

		$IP = self::MEDIAWIKI_DIRECTORY . self::getMediaWikiVersion();

		chdir( $IP );
		putenv( "MW_INSTALL_PATH=$IP" );

		return $IP . '/' . $file;
	}

	/**
	 * @return bool
	 */
	public static function isMissing(): bool {
		global $wgConf;

		self::$currentDatabase ??= self::getCurrentDatabase();

		return !in_array( self::$currentDatabase, $wgConf->wikis );
	}

	/**
	 * @return array
	 */
	public static function getCacheArray(): array {
		self::$currentDatabase ??= self::getCurrentDatabase();

		// If we don't have a cache file, let us exit here
		if ( !file_exists( self::CACHE_DIRECTORY . '/' . self::$currentDatabase . '.json' ) ) {
			return [];
		}

		return (array)json_decode( file_get_contents(
			self::CACHE_DIRECTORY . '/' . self::$currentDatabase . '.json'
		), true );
	}

	/** @var array */
	private static $activeExtensions;

	/**
	 * @return array
	 */
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

		static $globals = null;
		$globals ??= self::readFromCache(
			self::CACHE_DIRECTORY . '/' . $confCacheFileName,
			$confActualMtime
		);

		if ( !$globals ) {
			$wgConf->settings = array_merge(
				$wgConf->settings,
				self::getManageWikiConfigCache()
			);

			self::$activeExtensions ??= self::getActiveExtensions();

			$globals = self::getConfigForCaching();

			$confCacheObject = [ 'mtime' => $confActualMtime, 'globals' => $globals, 'extensions' => self::$activeExtensions ];

			$minTime = $confActualMtime + intval( ini_get( 'opcache.revalidate_freq' ) );
			if ( time() > $minTime ) {
				self::writeToCache(
					$confCacheFileName, $confCacheObject
				);
			}
		}

		return $globals;
	}

	/**
	 * @return array
	 */
	public static function getConfigForCaching(): array {
		global $wgDBname, $wgConf;

		$wikiTags = [];
		if ( self::getRealm() !== 'default' ) {
			$wikiTags[] = self::getRealm();
		}

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();

		$wikiTags[] = self::getMediaWikiVersion();
		foreach ( $cacheArray['states'] ?? [] as $state => $value ) {
			if ( $value !== 'exempt' && (bool)$value ) {
				$wikiTags[] = $state;
			}
		}

		self::$activeExtensions ??= self::getActiveExtensions();
		$wikiTags = array_merge( preg_filter( '/^/', 'ext-',
				str_replace( ' ', '', self::$activeExtensions )
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

	/**
	 * @param string $cacheShard
	 * @param array $configObject
	 */
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

	/**
	 * @param string $confCacheFile
	 * @param string $confActualMtime
	 * @param string $type
	 * @return ?array
	 */
	public static function readFromCache(
		string $confCacheFile,
		string $confActualMtime,
		string $type = 'globals'
	): ?array {
		$cacheRecord = @file_get_contents( $confCacheFile );

		if ( $cacheRecord !== false ) {
			$cacheObject = json_decode( $cacheRecord, true );

			if ( json_last_error() === JSON_ERROR_NONE ) {
				if ( ( $cacheObject['mtime'] ?? null ) == $confActualMtime ) {
					return $cacheObject[$type] ?? null;
				}
			} else {
				trigger_error( 'Config cache failure: Decoding failed', E_USER_ERROR );
			}
		}

		return null;
	}

	/**
	 * @return array
	 */
	public static function getManageWikiConfigCache(): array {
		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();

		if ( !$cacheArray ) {
			return [];
		}

		$settings = [];

		// Assign language code
		$settings['wgLanguageCode']['default'] = $cacheArray['core']['wgLanguageCode'];

		// Assign states
		$settings['cwPrivate']['default'] = (bool)$cacheArray['states']['private'];
		$settings['cwClosed']['default'] = (bool)$cacheArray['states']['closed'];
		$settings['cwLocked']['default'] = (bool)$cacheArray['states']['locked'] ?? false;
		$settings['cwInactive']['default'] = ( $cacheArray['states']['inactive'] === 'exempt' ) ? 'exempt' : (bool)$cacheArray['states']['inactive'];
		$settings['cwExperimental']['default'] = (bool)( $cacheArray['states']['experimental'] ?? false );

		// Assign settings
		if ( isset( $cacheArray['settings'] ) ) {
			foreach ( $cacheArray['settings'] as $var => $val ) {
				$settings[$var]['default'] = $val;
			}
		}

		// Handle namespaces
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

	/**
	 * @param string $setting
	 * @param string $wiki
	 * @return mixed
	 */
	public function getSettingValue( string $setting, string $wiki = 'default' ) {
		global $wgConf;

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();

		if ( !$cacheArray ) {
			return $wgConf->get( $setting, $wiki );
		}

		return $cacheArray['settings'][$setting] ?? $wgConf->get( $setting, $wiki );
	}

	/**
	 * @return array
	 */
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
		$extensions ??= self::readFromCache(
			self::CACHE_DIRECTORY . '/' . $confCacheFileName,
			$confActualMtime,
			'extensions'
		);

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

	/**
	 * @param string $extension
	 * @return bool
	 */
	public function isExtensionActive( string $extension ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		return in_array( $extension, self::$activeExtensions );
	}

	/**
	 * @param string ...$extensions
	 * @return bool
	 */
	public function isAnyOfExtensionsActive( string ...$extensions ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		return count( array_intersect( $extensions, self::$activeExtensions ) ) > 0;
	}

	/**
	 * @param string ...$extensions
	 * @return bool
	 */
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

		self::$activeExtensions ??= self::getActiveExtensions();
		foreach ( self::$activeExtensions as $name ) {
			$path = $list[ $name ] ?? false;

			$pathInfo = pathinfo( $path )['extension'] ?? false;
			if ( $path && $pathInfo === 'json' ) {
				ExtensionRegistry::getInstance()->queue( $path );
			}
		}
	}

	/**
	 * @param string $databaseName
	 * @return DBConnRef
	 */
	private static function getDatabaseConnection( string $databaseName ): DBConnRef {
		return MediaWikiServices::getInstance()
			->getDBLoadBalancerFactory()
			->getMainLB( $databaseName )
			->getMaintenanceConnectionRef( DB_REPLICA, [], $databaseName );
	}

	/**
	 * @param string $globalDatabase
	 * @return array
	 */
	private static function generateDatabaseLists( string $globalDatabase ) {
		$dbr = self::getDatabaseConnection( $globalDatabase );
		$allWikis = $dbr->newSelectQueryBuilder()
			->table( 'cw_wikis' )
			->fields( [
				 'wiki_dbcluster',
				 'wiki_dbname',
				 'wiki_url',
				 'wiki_sitename',
				 'wiki_version',
				 'wiki_deleted',
				 'wiki_closed',
				 'wiki_inactive',
			] )
			->caller( __METHOD__ )
			->fetchResultSet();

		$activeList = [];
		$combiList = [];
		$deletedList = [];
		foreach ( $allWikis as $wiki ) {
			if ( (int)$wiki->wiki_deleted === 1 ) {
				$deletedList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];
			} else {
				if ( (int)$wiki->wiki_closed === 0 && (int)$wiki->wiki_inactive === 0 ) {
					$activeList[$wiki->wiki_dbname] = [
						's' => $wiki->wiki_sitename,
						'c' => $wiki->wiki_dbcluster,
					];
				}

				$combiList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
					'v' => ( $wiki->wiki_version ?? null ) ?: self::MEDIAWIKI_VERSIONS[self::getDefaultMediaWikiVersion()],
				];

				if ( $wiki->wiki_url !== null ) {
					$combiList[$wiki->wiki_dbname]['u'] = $wiki->wiki_url;
				} else {
					foreach ( array_flip( self::SUFFIXES ) as $suffix ) {
						if ( substr( $wiki->wiki_dbname, -strlen( $suffix ) ) === $suffix ) {
							$combiList[$wiki->wiki_dbname]['u'] = 'https://' . substr( $wiki->wiki_dbname, 0, -strlen( $suffix ) ) . '.' . self::SUFFIXES[$suffix];
						}
					}
				}
			}
		}

		return [
			'active' => $activeList,
			'databases' => $combiList,
			'deleted' => $deletedList,
		];
	}

	/**
	 * @param array &$databaseLists
	 */
	public static function onGenerateDatabaseLists( array &$databaseLists ) {
		$default = self::generateDatabaseLists( self::GLOBAL_DATABASE['default'] );
		$beta = self::generateDatabaseLists( self::GLOBAL_DATABASE['beta'] );
		$databaseLists = [
			'active' => [
				'combi' => $default['active']
			],
			'active-beta' => [
				'combi' => $beta['active']
			],
			'beta' => [
				'combi' => $beta['databases']
			],
			'databases' => [
				'combi' => $default['databases']
			],
			'deleted' => [
				'deleted' => 'databases',
				'databases' => $default['deleted']
			],
			'deleted-beta' => [
				'deleted-beta' => 'databases',
				'databases' => $beta['deleted']
			],
		];
	}

	/**
	 * @param string $wiki
	 * @param DBConnRef $dbr
	 * @param array &$jsonArray
	 */
	public static function onCreateWikiJsonBuilder( string $wiki, DBConnRef $dbr, array &$jsonArray ) {
		$row = $dbr->newSelectQueryBuilder()
			->table( 'cw_wikis' )
			->fields( [ 'wiki_locked' ] )
			->where( [ 'wiki_dbname' => $wiki ] )
			->caller( __METHOD__ )
			->fetchRow();

		$jsonArray['states']['locked'] = (bool)$row->wiki_locked;
	}

	public static function onMediaWikiServices() {
		if ( isset( $GLOBALS['globals'] ) ) {
			foreach ( $GLOBALS['globals'] as $global => $value ) {
				if ( !isset( $GLOBALS['wgConf']->settings["+$global"] ) ) {
					$GLOBALS[$global] = $value;
				}
			}

			// Don't need a global here
			unset( $GLOBALS['globals'] );
		}
	}
}
