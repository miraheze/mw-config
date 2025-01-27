<?php

use MediaWiki\Config\SiteConfiguration;
use MediaWiki\Context\IContextSource;
use MediaWiki\MediaWikiServices;
use Miraheze\CreateWiki\Services\RemoteWikiFactory;
use Miraheze\ManageWiki\Helpers\ManageWikiSettings;
use Wikimedia\Rdbms\IDatabase;
use Wikimedia\Rdbms\IReadableDatabase;

class MirahezeFunctions {

	/** @var string */
	public $dbname;

	/** @var bool */
	public $missing;

	/** @var string */
	public $realm;

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

	private const ALLOWED_DOMAINS = [
		'default' => [
			'miraheze.org',
			'wikitide.org',
		],
		'beta' => [
			'mirabeta.org',
			'nexttide.org',
		],
	];

	private const BETA_HOSTNAME = 'test151';

	private const CACHE_DIRECTORY = '/srv/mediawiki/cache';

	private const CENTRAL_DATABASE = [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	];

	private const DEFAULT_SERVER = [
		'default' => 'miraheze.org',
		'beta' => 'mirabeta.org',
	];

	private const GLOBAL_DATABASE = [
		'default' => 'mhglobal',
		'beta' => 'testglobal',
	];

	private const INCIDENTS_DATABASE = [
		'default' => 'incidents',
		'beta' => 'testglobal',
	];

	private const MEDIAWIKI_DIRECTORY = '/srv/mediawiki/';

	private const TAGS = [
		'default' => 'default',
		'beta' => 'beta',
	];

	public const MEDIAWIKI_VERSIONS = [
		'alpha' => '1.44',
		'beta' => '1.44',
		'stable' => '1.43',
	];

	public const SUFFIXES = [
		'wiki' => self::ALLOWED_DOMAINS['default'],
		'wikibeta' => self::ALLOWED_DOMAINS['beta'],
	];

	public function __construct() {
		self::setupSiteConfiguration();

		$this->dbname = self::getCurrentDatabase();

		$expectedSuffix = php_uname( 'n' ) === self::BETA_HOSTNAME ? 'wikibeta' : 'wiki';
		if ( !str_ends_with( $this->dbname, $expectedSuffix ) ) {
			if ( MW_ENTRY_POINT === 'cli' ) {
				die( 'INVALID DATABASE! YOU CAN NOT USE THE DATABASE OF A DIFFERENT REALM!' . PHP_EOL );
			}

			require_once self::MEDIAWIKI_DIRECTORY . 'ErrorPages/MissingWiki.php';
		}

		$this->wikiDBClusters = self::getDatabaseClusters();

		$this->server = self::getServer();
		$this->sitename = self::getSiteName();
		$this->missing = self::isMissing();
		$this->realm = self::getRealm();
		$this->version = self::getMediaWikiVersion();

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

		static $databases = null;

		self::$currentDatabase ??= self::getCurrentDatabase();

		// We need the CLI *and* the web to be able to access 'deleted' wikis
		$databases ??= array_merge( self::readDbListFile( 'databases' ), self::readDbListFile( 'deleted' ) );

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

		$filePath = self::CACHE_DIRECTORY . "/{$dblist}.php";

		if ( !file_exists( $filePath ) ) {
			return [];
		} else {
			$databasesArray = include $filePath;
		}

		if ( $database ) {
			if ( $fromServer ) {
				$server = $database;
				$database = '';
				foreach ( $databasesArray['databases'] as $key => $data ) {
					if ( isset( $data['u'] ) && $data['u'] === $server ) {
						$database = $key;
						break;
					}
				}

				if ( $onlyDBs ) {
					return $database;
				}
			}

			return $databasesArray['databases'][$database] ?? '';
		} else {
			global $wgDatabaseClustersMaintenance;

			$databases = $databasesArray['databases'] ?? [];

			if ( $wgDatabaseClustersMaintenance ) {
				$databases = array_filter( $databases, static function ( $data, $key ) {
					global $wgDBname, $wgDatabaseClustersMaintenance;

					if ( $wgDBname && $key === $wgDBname ) {
						if ( MW_ENTRY_POINT !== 'cli' && in_array( $data['c'], $wgDatabaseClustersMaintenance ) ) {
							require_once self::MEDIAWIKI_DIRECTORY . 'ErrorPages/databaseMaintenance.php';
						}
					}

					return true;
				}, ARRAY_FILTER_USE_BOTH );
			}
		}

		return $onlyDBs ? array_keys( $databases ) : $databases;
	}

	public static function setupSiteConfiguration() {
		global $wgConf;

		$wgConf = new SiteConfiguration();

		$wgConf->suffixes = array_keys( self::SUFFIXES );
		$wgConf->wikis = self::getLocalDatabases();
	}

	/**
	 * @param ?string $database
	 * @return string
	 */
	public static function getRealm( ?string $database = null ): string {
		if ( $database ) {
			return ( substr( $database, -strlen( array_keys( self::SUFFIXES )[0] ) ) === array_keys( self::SUFFIXES )[0] ) ?
				self::TAGS['default'] : self::TAGS['beta'];
		}

		self::$currentDatabase ??= self::getCurrentDatabase();

		return ( substr( self::$currentDatabase, -strlen( array_keys( self::SUFFIXES )[0] ) ) === array_keys( self::SUFFIXES )[0] ) ?
			self::TAGS['default'] : self::TAGS['beta'];
	}

	/**
	 * @return string
	 */
	public static function getCurrentSuffix(): string {
		return array_keys( array_filter( self::SUFFIXES, static function ( $v ) {
			return in_array( self::DEFAULT_SERVER[self::getRealm()], $v );
		} ) )[0];
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

		$realm ??= self::getRealm();

		$databases = self::readDbListFile( 'databases', false, $database );

		if ( $deleted && $databases ) {
			$databases += self::readDbListFile( 'deleted', false, $database );
		}

		if ( $database !== null ) {
			if ( is_string( $database ) && $database !== 'default' ) {
				foreach ( array_keys( self::SUFFIXES ) as $suffix ) {
					if ( substr( $database, -strlen( $suffix ) ) === $suffix ) {
						$defaultServer = $databases['d'] ?? self::SUFFIXES[$suffix][ array_search( self::DEFAULT_SERVER[$realm], self::SUFFIXES[$suffix] ) ];
						return $databases['u'] ?? 'https://' . substr( $database, 0, -strlen( $suffix ) ) . '.' . $defaultServer;
					}
				}
			}

			$default ??= 'https://' . self::DEFAULT_SERVER[$realm];
			return $default;
		}

		foreach ( $databases as $db => $data ) {
			foreach ( array_keys( self::SUFFIXES ) as $suffix ) {
				if ( substr( $db, -strlen( $suffix ) ) === $suffix ) {
					$defaultServer = $data['d'] ?? self::SUFFIXES[$suffix][ array_search( self::DEFAULT_SERVER[$realm], self::SUFFIXES[$suffix] ) ];
					$servers[$db] = $data['u'] ?? 'https://' . substr( $db, 0, -strlen( $suffix ) ) . '.' . $defaultServer;
				}
			}
		}

		$default ??= 'https://' . self::DEFAULT_SERVER[$realm];
		$servers['default'] = $default;

		return $servers;
	}

	/**
	 * @param bool $ignorePrimary
	 * @return string
	 */
	public static function getCurrentDatabase( bool $ignorePrimary = false ): string {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
		}

		$hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';

		static $database = null;

		$database ??= self::readDbListFile( 'databases', true, 'https://' . $hostname, true );

		if ( $database ) {
			return $database;
		}

		$explode = explode( '.', $hostname, 2 );

		if ( $explode[0] === 'www' ) {
			$explode = explode( '.', $explode[1], 2 );
		}

		foreach ( self::SUFFIXES as $suffix => $sites ) {
			if ( in_array( $explode[1], $sites ) && ( $ignorePrimary || $explode[1] === self::getPrimaryDomain( $explode[0] . $suffix ) ) ) {
				return $explode[0] . $suffix;
			}
		}

		return '';
	}

	/**
	 * @return array
	 */
	public function getAllowedDomains(): array {
		return self::ALLOWED_DOMAINS[$this->realm];
	}

	/**
	 * @return string
	 */
	public function getCentralDatabase(): string {
		return self::CENTRAL_DATABASE[ array_flip( self::TAGS )[$this->realm] ];
	}

	/**
	 * @return string
	 */
	public function getGlobalDatabase(): string {
		return self::GLOBAL_DATABASE[ array_flip( self::TAGS )[$this->realm] ];
	}

	/**
	 * @return string
	 */
	public function getIncidentsDatabase(): string {
		return self::INCIDENTS_DATABASE[ array_flip( self::TAGS )[$this->realm] ];
	}

	public function setDatabase() {
		global $wgConf, $wgDBname, $wgVirtualDomainsMapping;

		$wgConf->settings['wgDBname'][$this->dbname] = $this->dbname;
		$wgDBname = $this->dbname;

		$wgVirtualDomainsMapping['virtual-createwiki'] = [
			'db' => $this->getGlobalDatabase(),
		];
	}

	/**
	 * @return ?array
	 */
	public static function getDatabaseClusters(): ?array {
		static $allDatabases = null;
		static $deletedDatabases = null;

		$allDatabases ??= self::readDbListFile( 'databases', false );
		$deletedDatabases ??= self::readDbListFile( 'deleted', false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$clusters = array_column( $databases, 'c' );

		return array_combine( array_keys( $databases ), $clusters );
	}

	/**
	 * @param string $database
	 * @return string
	 */
	public static function getPrimaryDomain( string $database ): string {
		$primaryDomain = self::readDbListFile( 'databases', false, $database )['d'] ?? null;
		return $primaryDomain ?? self::DEFAULT_SERVER[self::getRealm( $database )];
	}

	/**
	 * @param ?string $database
	 * @return string
	 */
	public static function getDefaultServer( ?string $database = null ): string {
		static $realm = null;
		$realm ??= self::getRealm( $database );

		return self::DEFAULT_SERVER[$realm];
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

		$allDatabases ??= self::readDbListFile( 'databases', false );
		$deletedDatabases ??= self::readDbListFile( 'deleted', false );

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
		return ( php_uname( 'n' ) === self::BETA_HOSTNAME && isset( self::MEDIAWIKI_VERSIONS['beta'] ) ) ? 'beta' : 'stable';
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

		if ( PHP_SAPI === 'cli' ) {
			$version = explode( '/', $_SERVER['SCRIPT_NAME'] )[3] ?? null;
			if ( $version && in_array( $version, self::MEDIAWIKI_VERSIONS ) ) {
				return $version;
			}
		}

		static $version = null;

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
		if ( !file_exists( self::CACHE_DIRECTORY . '/' . self::$currentDatabase . '.php' ) ) {
			return [];
		}

		$currentDatabaseFile = self::CACHE_DIRECTORY . '/' . self::$currentDatabase . '.php';
		return include $currentDatabaseFile;
	}

	/** @var array */
	private static $activeExtensions;

	/**
	 * @return array
	 */
	public static function getConfigGlobals(): array {
		global $wgDBname, $wgConf;

		// Try configuration cache
		$confCacheFileName = "config-$wgDBname.php";

		// To-Do: merge ManageWiki cache with main config cache,
		// to automatically update when ManageWiki is updated
		$confActualMtime = max(
			// When config files are updated
			filemtime( __DIR__ . '/../LocalSettings.php' ),
			filemtime( __DIR__ . '/../ManageWikiExtensions.php' ),
			filemtime( __DIR__ . '/../ManageWikiNamespaces.php' ),
			filemtime( __DIR__ . '/../ManageWikiSettings.php' ),

			// When MediaWiki is upgraded
			filemtime( MW_INSTALL_PATH . '/includes/Defines.php' ),

			// When ManageWiki is changed
			@filemtime( self::CACHE_DIRECTORY . '/' . $wgDBname . '.php' )
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
		if ( self::getRealm( $wgDBname ) !== 'default' ) {
			$wikiTags[] = self::getRealm( $wgDBname );
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

		[ $site, $lang ] = $wgConf->siteFromDB( $wgDBname );
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

		if ( $tmpFile ) {
			if ( file_put_contents( $tmpFile, '<?php return ' . var_export( $configObject, true ) . ';' ) ) {
				if ( rename( $tmpFile, self::CACHE_DIRECTORY . '/' . $cacheShard ) ) {
					return;
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
		$cacheRecord = @include $confCacheFile;

		if ( $cacheRecord !== false ) {
			if ( ( $cacheRecord['mtime'] ?? null ) == $confActualMtime ) {
				return $cacheRecord[$type] ?? null;
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
		$settings['cwDeleted']['default'] = (bool)$cacheArray['states']['deleted'] ?? false;
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
		global $wgDBname;

		$confCacheFileName = "config-$wgDBname.php";

		// To-Do: merge ManageWiki cache with main config cache,
		// to automatically update when ManageWiki is updated
		$confActualMtime = max(
			// When config files are updated
			filemtime( __DIR__ . '/../LocalSettings.php' ),
			filemtime( __DIR__ . '/../ManageWikiExtensions.php' ),

			// When MediaWiki is upgraded
			filemtime( MW_INSTALL_PATH . '/includes/Defines.php' ),

			// When ManageWiki is changed
			@filemtime( self::CACHE_DIRECTORY . '/' . $wgDBname . '.php' )
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
			array_diff( $allExtensions, array_keys( static::$disabledExtensions ) )
		);

		return array_values( array_intersect(
			$cacheArray['extensions'] ?? [],
			$enabledExtensions
		) );
	}

	public static function handleDisabledExtensions() {
		global $wgManageWikiExtensions;

		foreach ( static::$disabledExtensions as $name => $reason ) {
			$wgManageWikiExtensions[$name]['help'] = '<b>Note</b>: This extension has been globally disabled. The following reason was given: ' . $reason;
			$wgManageWikiExtensions[$name]['requires'] = [
				'permissions' => [
					'managewiki-restricted',
				],
			];
		}
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

		if ( !file_exists( self::CACHE_DIRECTORY . '/' . $wgDBname . '.php' ) ) {
			global $wgConf;
			if ( self::getRealm( $wgDBname ) !== 'default' ) {
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

		if ( !file_exists( self::CACHE_DIRECTORY . '/' . $this->version . '/extension-list.php' ) ) {
			if ( !is_dir( self::CACHE_DIRECTORY . '/' . $this->version ) ) {
				// Create directory since it doesn't exist
				mkdir( self::CACHE_DIRECTORY . '/' . $this->version );
			}

			$queue = array_fill_keys( array_merge(
				glob( self::MEDIAWIKI_DIRECTORY . $this->version . '/extensions/*/extension*.json' ),
				glob( self::MEDIAWIKI_DIRECTORY . $this->version . '/skins/*/skin.json' )
			), true );

			$processor = new ExtensionProcessor();

			foreach ( $queue as $path => $mtime ) {
				$json = file_get_contents( $path );
				$info = json_decode( $json, true );
				$version = $info['manifest_version'] ?? 2;

				$processor->extractInfo( $path, $info, $version );
			}

			$data = $processor->getExtractedInfo();

			$list = array_column( $data['credits'], 'path', 'name' );

			// Write the list to a PHP cache file
			$phpContent = "<?php\n\n" .
				"/**\n * Auto-generated extension list cache.\n */\n\n" .
				'return ' . var_export( $list, true ) . ";\n";

			file_put_contents( self::CACHE_DIRECTORY . '/' . $this->version . '/extension-list.php', $phpContent, LOCK_EX );
		} else {
			$list = include self::CACHE_DIRECTORY . '/' . $this->version . '/extension-list.php';
		}

		self::handleDisabledExtensions();

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
	 * @return IReadableDatabase
	 */
	private static function getDatabaseConnection( string $databaseName ): IReadableDatabase {
		return MediaWikiServices::getInstance()->getConnectionProvider()
			->getReplicaDatabase( $databaseName );
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
				 'wiki_primary_domain',
				 'wiki_sitename',
				 'wiki_version',
				 'wiki_deleted',
				 'wiki_closed',
				 'wiki_inactive',
				 'wiki_private',
			] )
			->caller( __METHOD__ )
			->fetchResultSet();

		$activeList = [];
		$combiList = [];
		$deletedList = [];
		$publicList = [];
		$privateList = [];
		$versions = [];

		foreach ( self::MEDIAWIKI_VERSIONS as $name => $version ) {
			$versions[$version] = [];
		}

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

				$primaryDomain = ( $wiki->wiki_primary_domain ?? null ) ?: self::DEFAULT_SERVER[self::getRealm( $wiki->wiki_dbname )];
				$wikiVersion = ( $wiki->wiki_version ?? null ) ?: self::MEDIAWIKI_VERSIONS[self::getDefaultMediaWikiVersion()];

				$combiList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
					'd' => $primaryDomain,
					'v' => $wikiVersion,
				];

				if ( $wiki->wiki_url !== null ) {
					$combiList[$wiki->wiki_dbname]['u'] = $wiki->wiki_url;
				}

				if ( isset( $versions[$wikiVersion] ) ) {
					$versions[$wikiVersion][$wiki->wiki_dbname] = $combiList[$wiki->wiki_dbname];
				}
			}

			if ( (int)$wiki->wiki_private === 1 ) {
				$privateList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];
			} else {
				$publicList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];
			}
		}

		return [
			'active' => $activeList,
			'databases' => $combiList,
			'deleted' => $deletedList,
			'public' => $publicList,
			'private' => $privateList,
			'versions' => $versions,
		];
	}

	/**
	 * @param array &$databaseLists
	 */
	public static function onGenerateDatabaseLists( array &$databaseLists ) {
		$isBeta = php_uname( 'n' ) === self::BETA_HOSTNAME;

		$databases = self::generateDatabaseLists(
			self::GLOBAL_DATABASE[ $isBeta ? 'beta' : 'default' ]
		);

		$databaseLists = [
			'active' => $databases['active'],
			'databases' => $databases['databases'],
			'deleted' => $databases['deleted'],
			'public' => $databases['public'],
			'private' => $databases['private'],
		];

		foreach ( self::MEDIAWIKI_VERSIONS as $name => $version ) {
			$databaseLists += [
				$name . '-wikis' => $databases['versions'][$version],
			];
		}
	}

	/**
	 * @param string $wiki
	 * @param IReadableDatabase $dbr
	 * @param array &$cacheArray
	 */
	public static function onCreateWikiDataFactoryBuilder(
		string $wiki,
		IReadableDatabase $dbr,
		array &$cacheArray
	) {
		$row = $dbr->newSelectQueryBuilder()
			->table( 'cw_wikis' )
			->fields( [
				 'wiki_deleted',
				 'wiki_locked',
			] )
			->where( [ 'wiki_dbname' => $wiki ] )
			->caller( __METHOD__ )
			->fetchRow();

		$cacheArray['states']['deleted'] = (bool)$row->wiki_deleted;
		$cacheArray['states']['locked'] = (bool)$row->wiki_locked;
	}

	/**
	 * @param bool $ceMW
	 * @param IContextSource $context
	 * @param string $dbName
	 * @param array &$formDescriptor
	 */
	public static function onManageWikiCoreAddFormFields( $ceMW, $context, $dbName, &$formDescriptor ) {
		$permissionManager = MediaWikiServices::getInstance()->getPermissionManager();

		$mwVersion = self::getMediaWikiVersion( $dbName );
		$versions = array_unique( array_filter( self::MEDIAWIKI_VERSIONS, static function ( $version ) use ( $mwVersion ): bool {
			return $mwVersion === $version || is_dir( self::MEDIAWIKI_DIRECTORY . $version );
		} ) );

		asort( $versions );

		$formDescriptor['primary-domain'] = [
			'label-message' => 'miraheze-label-managewiki-primary-domain',
			'type' => 'select',
			'options' => array_combine( self::ALLOWED_DOMAINS[self::getRealm( $dbName )], self::ALLOWED_DOMAINS[self::getRealm( $dbName )] ),
			'default' => self::getPrimaryDomain( $dbName ),
			'disabled' => !$permissionManager->userHasRight( $context->getUser(), 'managewiki-restricted' ),
			'cssclass' => 'managewiki-infuse',
			'section' => 'main',
		];

		$mwSettings = new ManageWikiSettings( $dbName );
		$setList = $mwSettings->list();
		$formDescriptor['article-path'] = [
			'label-message' => 'miraheze-label-managewiki-article-path',
			'type' => 'select',
			'options-messages' => [
				'miraheze-label-managewiki-article-path-wiki' => '/wiki/$1',
				'miraheze-label-managewiki-article-path-root' => '/$1',
			],
			'default' => $setList['wgArticlePath'] ?? '/wiki/$1',
			'disabled' => !$permissionManager->userHasRight( $context->getUser(), 'managewiki-restricted' ),
			'cssclass' => 'managewiki-infuse',
			'section' => 'main',
		];

		$formDescriptor['mainpage-is-domain-root'] = [
			'label-message' => 'miraheze-label-managewiki-mainpage-is-domain-root',
			'type' => 'check',
			'default' => $setList['wgMainPageIsDomainRoot'] ?? false,
			'disabled' => !$permissionManager->userHasRight( $context->getUser(), 'managewiki-restricted' ),
			'cssclass' => 'managewiki-infuse',
			'section' => 'main',
		];

		$formDescriptor['mediawiki-version'] = [
			'label-message' => 'miraheze-label-managewiki-mediawiki-version',
			'type' => 'select',
			'options' => array_combine( $versions, $versions ),
			'default' => $mwVersion,
			'disabled' => !$permissionManager->userHasRight( $context->getUser(), 'managewiki-restricted' ),
			'cssclass' => 'managewiki-infuse',
			'section' => 'main',
		];
	}

	/**
	 * @param IContextSource $context
	 * @param string $dbName
	 * @param IDatabase $dbw
	 * @param array $formData
	 * @param RemoteWikiFactory &$remoteWiki
	 */
	public static function onManageWikiCoreFormSubmission( $context, $dbName, $dbw, $formData, &$remoteWiki ) {
		$version = self::getMediaWikiVersion( $dbName );
		if ( $formData['mediawiki-version'] !== $version && is_dir( self::MEDIAWIKI_DIRECTORY . $formData['mediawiki-version'] ) ) {
			$remoteWiki->addNewRow( 'wiki_version', $formData['mediawiki-version'] );
			$remoteWiki->trackChange( 'mediawiki-version', $version, $formData['mediawiki-version'] );
		}

		if ( $formData['primary-domain'] !== self::getPrimaryDomain( $dbName ) ) {
			$remoteWiki->addNewRow( 'wiki_primary_domain', $formData['primary-domain'] );
			$remoteWiki->trackChange( 'primary-domain',
				self::getPrimaryDomain( $dbName ),
				$formData['primary-domain']
			);
		}

		$mwSettings = new ManageWikiSettings( $dbName );

		$articlePath = $mwSettings->list()['wgArticlePath'] ?? '';
		if ( $formData['article-path'] !== $articlePath ) {
			$mwSettings->modify( [ 'wgArticlePath' => $formData['article-path'] ] );
			$mwSettings->commit();

			$remoteWiki->trackChange( 'article-path', $articlePath, $formData['article-path'] );

			$server = self::getServer();
			$jobQueueGroupFactory = MediaWikiServices::getInstance()->getJobQueueGroupFactory();
			$jobQueueGroupFactory->makeJobQueueGroup( $dbName )->push(
				new CdnPurgeJob( [
					'urls' => [
						$server . '/wiki/',
						$server . '/wiki',
						$server . '/',
						$server,
					],
				] )
			);
		}

		$mainPageIsDomainRoot = $mwSettings->list()['wgMainPageIsDomainRoot'] ?? false;
		if ( $formData['mainpage-is-domain-root'] !== $mainPageIsDomainRoot ) {
			$mwSettings->modify( [ 'wgMainPageIsDomainRoot' => $formData['mainpage-is-domain-root'] ] );
			$mwSettings->commit();

			$remoteWiki->trackChange( 'mainpage-is-domain-root',
				$mainPageIsDomainRoot,
				$formData['mainpage-is-domain-root']
			);
		}
	}

	public static function onMediaWikiServices() {
		if ( isset( $GLOBALS['globals'] ) ) {
			foreach ( $GLOBALS['globals'] as $global => $value ) {
				if ( !isset( $GLOBALS['wgConf']->settings["+$global"] ) &&
					$global !== 'wgManageWikiPermissionsAdditionalRights'
				) {
					$GLOBALS[$global] = $value;
				}
			}

			// Don't need a global here
			unset( $GLOBALS['globals'] );
		}
	}
}
