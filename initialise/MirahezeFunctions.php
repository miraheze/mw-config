<?php

use MediaWiki\Config\SiteConfiguration;
use MediaWiki\Context\IContextSource;
use MediaWiki\JobQueue\Jobs\CdnPurgeJob;
use MediaWiki\MediaWikiServices;
use MediaWiki\Registration\ExtensionProcessor;
use MediaWiki\Registration\ExtensionRegistry;
use Miraheze\ManageWiki\Helpers\Factories\ModuleFactory;
use Wikimedia\Rdbms\IReadableDatabase;
use Wikimedia\StaticArrayWriter;

class MirahezeFunctions {

	public readonly string $dbname;
	public readonly string $realm;
	public readonly string $server;
	public readonly string $sitename;
	public readonly string $version;

	public readonly array $wikiDBClusters;
	public readonly bool $missing;

	private static array $activeExtensions;
	private static string $currentDatabase;

	public static array $disabledExtensions = [];

	private const array ALLOWED_DOMAINS = [
		'default' => [
			'miraheze.org',
			'wikitide.org',
		],
		'beta' => [
			'mirabeta.org',
			'nexttide.org',
		],
	];

	private const string BETA_HOSTNAME = 'test151';

	private const string CACHE_DIRECTORY = '/srv/mediawiki/cache';

	private const array CENTRAL_DATABASE = [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	];

	private const array DEFAULT_SERVER = [
		'default' => 'miraheze.org',
		'beta' => 'mirabeta.org',
	];

	private const array SHARED_DOMAIN = [
		'default' => 'auth.miraheze.org',
		'beta' => 'auth.mirabeta.org',
	];

	private const array GLOBAL_DATABASE = [
		'default' => 'mhglobal',
		'beta' => 'testglobal',
	];

	private const array INCIDENTS_DATABASE = [
		'default' => 'incidents',
		'beta' => 'testglobal',
	];

	private const string MEDIAWIKI_DIRECTORY = '/srv/mediawiki/';

	public const array MEDIAWIKI_VERSIONS = [
		'alpha' => '1.45',
		'beta' => '1.45',
		'stable' => '1.45',
	];

	public const array SUFFIXES = [
		'wiki' => self::ALLOWED_DOMAINS['default'],
		'wikibeta' => self::ALLOWED_DOMAINS['beta'],
	];

	public function __construct() {
		self::setupSiteConfiguration();
		$this->dbname = self::getCurrentDatabase();

		$expectedSuffix = php_uname( 'n' ) === self::BETA_HOSTNAME ? 'wikibeta' : 'wiki';
		if ( !str_ends_with( $this->dbname, $expectedSuffix ) ) {
			if ( MW_ENTRY_POINT === 'cli' ) {
				fwrite( STDERR, 'INVALID DATABASE! YOU CAN NOT USE THE DATABASE OF A DIFFERENT REALM!' . PHP_EOL );
				exit( 2 );
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

	public static function getLocalDatabases(): array {
		global $wgLocalDatabases;
		static $databases = null;

		self::$currentDatabase ??= self::getCurrentDatabase();

		// We need the CLI *and* the web to be able to access 'deleted' wikis
		$databases ??= [
			...self::readDbListFile( 'databases' ),
			...self::readDbListFile( 'deleted' ),
		];

		$wgLocalDatabases = $databases;
		return $databases;
	}

	public static function readDbListFile(
		string $dblist,
		bool $onlyDBs = true,
		?string $database = null,
		bool $fromServer = false
	): array|string {
		// Fast-path shortcut: if we're only requesting DB name and not resolving from server
		if ( $database && $onlyDBs && !$fromServer ) {
			return $database;
		}

		$databasesArray = @include self::CACHE_DIRECTORY . "/$dblist.php";
		if ( $databasesArray === false || $databasesArray === [] ) {
			return [];
		}

		// Lookup a single database by server URL
		if ( $database ) {
			if ( $fromServer ) {
				$server = $database;
				$database = '';
				foreach ( $databasesArray['databases'] ?? [] as $key => $data ) {
					if ( isset( $data['u'] ) && $data['u'] === $server ) {
						$database = $key;
						break;
					}
				}

				if ( $onlyDBs ) {
					return $database;
				}
			}

			return $databasesArray['databases'][ $database ] ?? '';
		}

		// Return the full list of databases
		$databases = $databasesArray['databases'] ?? [];

		global $wgDatabaseClustersMaintenance;
		if ( $wgDatabaseClustersMaintenance ) {
			$databases = array_filter(
				$databases,
				static function ( array $data, string $key ): true {
					global $wgDBname, $wgDatabaseClustersMaintenance;

					if (
						$wgDBname &&
						$key === $wgDBname &&
						MW_ENTRY_POINT !== 'cli' &&
						in_array( $data['c'] ?? null, $wgDatabaseClustersMaintenance, true )
					) {
						require_once self::MEDIAWIKI_DIRECTORY . 'ErrorPages/DatabaseMaintenance.php';
					}

					return true;
				}, ARRAY_FILTER_USE_BOTH
			);
		}

		return $onlyDBs ? array_keys( $databases ) : $databases;
	}

	public static function setupSiteConfiguration(): void {
		global $wgConf;
		$wgConf = new SiteConfiguration();

		$wgConf->suffixes = array_keys( self::SUFFIXES );
		$wgConf->wikis = self::getLocalDatabases();
	}

	public static function getRealm( ?string $database = null ): string {
		$database ??= self::$currentDatabase ??= self::getCurrentDatabase();
		$suffix = array_key_first( self::SUFFIXES );
		return str_ends_with( $database, $suffix ) ? 'default' : 'beta';
	}

	public static function getCurrentSuffix(): string {
		$default = self::DEFAULT_SERVER[ self::getRealm() ];
		foreach ( self::SUFFIXES as $suffix => $domains ) {
			// Skip linear scans when not necessary
			foreach ( $domains as $domain ) {
				if ( $domain === $default ) {
					return $suffix;
				}
			}
		}
	}

	public static function getServers( ?string $database = null, bool $deleted = false ): array|string {
		global $wgConf;

		// Return explicitly set server for a specific database
		if ( $database !== null ) {
			$server = $wgConf->get( 'wgServer', $database );
			if ( $server ) {
				return $server;
			}

			if ( !empty( $wgConf->settings['wgServer'] ) && count( $wgConf->settings['wgServer'] ) > 1 ) {
				return 'https://' . self::DEFAULT_SERVER[ self::getRealm() ];
			}
		}

		// If we're not querying a specific DB and wgServer is set globally, return that
		if ( !empty( $wgConf->settings['wgServer'] ) && count( $wgConf->settings['wgServer'] ) > 1 ) {
			return $wgConf->settings['wgServer'];
		}

		$servers = [];
		static $default = null;

		self::$currentDatabase ??= self::getCurrentDatabase();
		$realm = self::getRealm();

		// Load database list
		$databases = self::readDbListFile( 'databases', false, $database );
		if ( $deleted && $databases ) {
			$databases += self::readDbListFile( 'deleted', false, $database );
		}

		if ( $database !== null ) {
			if ( $database !== 'default' ) {
				foreach ( self::SUFFIXES as $suffix => $domains ) {
					if ( str_ends_with( $database, $suffix ) ) {
						$defaultServer = $databases['d']
							?? self::SUFFIXES[$suffix][ array_search( self::DEFAULT_SERVER[$realm], self::SUFFIXES[$suffix], true ) ];

						return $databases['u']
							?? 'https://' . substr( $database, 0, -strlen( $suffix ) ) . '.' . $defaultServer;
					}
				}
			}

			$default ??= 'https://' . self::DEFAULT_SERVER[$realm];
			return $default;
		}

		// Build list of all known wiki URLs
		foreach ( $databases as $db => $data ) {
			foreach ( self::SUFFIXES as $suffix => $domains ) {
				if ( str_ends_with( $db, $suffix ) ) {
					$defaultServer = $data['d']
						?? self::SUFFIXES[$suffix][ array_search( self::DEFAULT_SERVER[$realm], self::SUFFIXES[$suffix], true ) ];

					$servers[$db] = $data['u']
						?? 'https://' . substr( $db, 0, -strlen( $suffix ) ) . '.' . $defaultServer;
				}
			}
		}

		$default ??= 'https://' . self::DEFAULT_SERVER[$realm];
		$servers['default'] = $default;

		return $servers;
	}

	public static function getCurrentDatabase( bool $ignorePrimary = false ): string {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
		}

		$hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';
		if ( $hostname === 'auth.miraheze.org' || $hostname === 'auth.mirabeta.org' ) {
			$requestUri = $_SERVER['REQUEST_URI'];
			$pathBits = explode( '/', $requestUri, 3 );
			if ( count( $pathBits ) < 3 ) {
				trigger_error( "Invalid request URI (requestUri=" . $requestUri . "), can't determine language.\n", E_USER_ERROR );
				exit( 1 );
			}
			[ , $dbname, ] = $pathBits;
			// No validation of $dbname at this point - if it's invalid, an error will be produced
			return $dbname;
		}

		static $database = null;
		$database ??= self::readDbListFile( 'databases', true, 'https://' . $hostname, true );

		if ( $database ) {
			return $database;
		}

		// Explode the hostname to get potential subdomain + suffix
		$parts = explode( '.', $hostname, 2 );
		if ( $parts[0] === 'www' ) {
			$parts = explode( '.', $parts[1], 2 );
		}

		[ $subdomain, $domain ] = $parts + [ '', '' ];
		foreach ( self::SUFFIXES as $suffix => $sites ) {
			if (
				$domain === $sites[ array_search( $domain, $sites, true ) ] &&
				( $ignorePrimary || $domain === self::getPrimaryDomain( $subdomain . $suffix ) )
			) {
				return $subdomain . $suffix;
			}
		}

		return '';
	}

	public function getAllowedDomains(): array {
		return self::ALLOWED_DOMAINS[$this->realm];
	}

	public function getCentralDatabase(): string {
		return self::CENTRAL_DATABASE[$this->realm];
	}

	public function getGlobalDatabase(): string {
		return self::GLOBAL_DATABASE[$this->realm];
	}

	public function getIncidentsDatabase(): string {
		return self::INCIDENTS_DATABASE[$this->realm];
	}

	public function isBeta(): bool {
		return str_ends_with( $this->server, '.mirabeta.org' )
			|| str_ends_with( $this->server, '.nexttide.org' );
	}

	public function setDatabase(): void {
		global $wgConf, $wgDBname, $wgVirtualDomainsMapping;

		$wgConf->settings['wgDBname'][$this->dbname] = $this->dbname;
		$wgDBname = $this->dbname;

		$wgVirtualDomainsMapping['virtual-createwiki'] = [
			'db' => $this->getGlobalDatabase(),
		];

		$wgVirtualDomainsMapping['virtual-managewiki'] = [
			'db' => $this->getGlobalDatabase(),
		];
	}

	public static function getDatabaseClusters(): array {
		static $allDatabases = null;
		static $deletedDatabases = null;

		$allDatabases ??= self::readDbListFile( 'databases', false );
		$deletedDatabases ??= self::readDbListFile( 'deleted', false );

		$databases = [ ...$allDatabases, ...$deletedDatabases ];
		if ( !$databases ) {
			return [];
		}

		return array_combine(
			array_keys( $databases ),
			array_column( $databases, 'c' )
		);
	}

	public static function getPrimaryDomain( string $database ): string {
		$primaryDomain = self::readDbListFile( 'databases', false, $database )['d'] ?? null;
		return $primaryDomain ?? self::DEFAULT_SERVER[self::getRealm( $database )];
	}

	public function getSharedDomain(): string {
		return self::SHARED_DOMAIN[$this->realm];
	}

	public static function getDefaultServer( ?string $database = null ): string {
		static $realm = null;
		$realm ??= self::getRealm( $database );

		return self::DEFAULT_SERVER[$realm];
	}

	public static function getServer(): string {
		self::$currentDatabase ??= self::getCurrentDatabase();
		return self::getServers( self::$currentDatabase ?: 'default' );
	}

	public function setServers(): void {
		global $wgConf, $wgServer;

		$wgConf->settings['wgServer'] = self::getServers( null, true );
		$wgServer = $this->server;
	}

	public function setSiteNames(): void {
		global $wgConf, $wgSitename;

		$wgConf->settings['wgSitename'] = self::getSiteNames();
		$wgSitename = $this->sitename;
	}

	public static function getSiteNames(): array {
		static $allDatabases = null;
		static $deletedDatabases = null;

		$allDatabases ??= self::readDbListFile( 'databases', false );
		$deletedDatabases ??= self::readDbListFile( 'deleted', false );

		$databases = [ ...$allDatabases, ...$deletedDatabases ];
		if ( !$databases ) {
			return [ 'default' => 'No sitename set.' ];
		}

		$siteNames = array_combine(
			array_keys( $databases ),
			array_column( $databases, 's' )
		) ?: [];

		$siteNames['default'] = 'No sitename set.';
		return $siteNames;
	}

	public static function getSiteName(): string {
		self::$currentDatabase ??= self::getCurrentDatabase();
		return self::getSiteNames()[ self::$currentDatabase ] ?? self::getSiteNames()['default'];
	}

	public static function getDefaultMediaWikiVersion(): string {
		return ( php_uname( 'n' ) === self::BETA_HOSTNAME && isset( self::MEDIAWIKI_VERSIONS['beta'] ) ) ? 'beta' : 'stable';
	}

	public static function getMediaWikiVersion( ?string $database = null ): string {
		$envVersion = getenv( 'MIRAHEZE_WIKI_VERSION' );
		if ( $envVersion ) {
			return $envVersion;
		}

		if ( $database ) {
			return self::readDbListFile( 'databases', false, $database )['v']
				?? self::MEDIAWIKI_VERSIONS[ self::getDefaultMediaWikiVersion() ];
		}

		if ( PHP_SAPI === 'cli' ) {
			$parts = explode( '/', $_SERVER['SCRIPT_NAME'] );
			$version = $parts[3] ?? null;

			if ( $version && in_array( $version, self::MEDIAWIKI_VERSIONS, true ) ) {
				return $version;
			}
		}

		static $version = null;

		self::$currentDatabase ??= self::getCurrentDatabase();
		$version ??= self::readDbListFile( 'databases', false, self::$currentDatabase )['v'] ?? null;

		return $version ?? self::MEDIAWIKI_VERSIONS[ self::getDefaultMediaWikiVersion() ];
	}

	public static function getMediaWiki( string $file ): string {
		global $IP;

		$IP = self::MEDIAWIKI_DIRECTORY . self::getMediaWikiVersion();

		chdir( $IP );
		putenv( "MW_INSTALL_PATH=$IP" );

		return $IP . '/' . $file;
	}

	public static function isMissing(): bool {
		global $wgConf;

		self::$currentDatabase ??= self::getCurrentDatabase();
		return !in_array( self::$currentDatabase, $wgConf->wikis, true );
	}

	public static function getCacheArray(): array {
		self::$currentDatabase ??= self::getCurrentDatabase();

		$filePath = self::CACHE_DIRECTORY . '/' . self::$currentDatabase . '.php';
		$cacheData = @include $filePath;

		// If we don't have a cache file, return an empty array
		if ( $cacheData === false ) {
			return [];
		}

		return $cacheData;
	}

	public static function getConfigGlobals(): array {
		global $wgDBname, $wgConf;

		// Try configuration cache
		$confCacheFileName = "config-$wgDBname.php";

		// To-Do: merge ManageWiki cache with main config cache,
		// to automatically update when ManageWiki is updated
		$confActualMtime = max(
			filemtime( __DIR__ . '/../LocalSettings.php' ),
			filemtime( __DIR__ . '/../ManageWikiExtensions.php' ),
			filemtime( __DIR__ . '/../ManageWikiNamespaces.php' ),
			filemtime( __DIR__ . '/../ManageWikiSettings.php' ),
			filemtime( MW_INSTALL_PATH . '/includes/Defines.php' ),
			@filemtime( self::CACHE_DIRECTORY . "/$wgDBname.php" )
		);

		static $globals = null;
		$globals ??= self::readFromCache(
			self::CACHE_DIRECTORY . "/$confCacheFileName",
			'globals', $confActualMtime
		);

		if ( !$globals ) {
			// Merge ManageWiki cache into wgConf
			$wgConf->settings = [
				...$wgConf->settings,
				...self::getManageWikiConfigCache()
			];

			self::$activeExtensions ??= self::getActiveExtensions();
			$globals = self::getConfigForCaching();

			$confCacheObject = [
				'mtime' => $confActualMtime,
				'globals' => $globals,
				'extensions' => self::$activeExtensions,
			];

			$minTime = $confActualMtime + (int)ini_get( 'opcache.revalidate_freq' );
			if ( time() > $minTime ) {
				self::writeToCache( $confCacheFileName, $confCacheObject );
			}
		}

		return $globals;
	}

	public static function getConfigForCaching(): array {
		global $wgDBname, $wgConf;

		$wikiTags = [];

		$realm = self::getRealm( $wgDBname );
		if ( $realm !== 'default' ) {
			$wikiTags[] = $realm;
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

		$wikiTags = [
			...preg_filter( '/^/', 'ext-', str_replace( ' ', '', self::$activeExtensions ) ),
			...$wikiTags,
		];

		[ $site, $lang ] = $wgConf->siteFromDB( $wgDBname );
		$dbSuffix = self::getCurrentSuffix();

		$confParams = [
			'lang' => $lang,
			'site' => $site,
		];

		return $wgConf->getAll( $wgDBname, $dbSuffix, $confParams, $wikiTags );
	}

	public static function writeToCache( string $cacheShard, array $configObject ): void {
		@mkdir( self::CACHE_DIRECTORY );
		$tmpFile = tempnam( self::CACHE_DIRECTORY, $cacheShard );
		if ( $tmpFile !== false ) {
			$contents = StaticArrayWriter::write( $configObject, 'Automatically generated by MirahezeFunctions' );
			if ( file_put_contents( $tmpFile, $contents ) ) {
				$targetFile = self::CACHE_DIRECTORY . '/' . $cacheShard;
				if ( rename( $tmpFile, $targetFile ) ) {
					opcache_invalidate( $targetFile, true );
					return;
				}
			}

			unlink( $tmpFile );
		}
	}

	public static function readFromCache(
		string $confCacheFile,
		string $type,
		int $confActualMtime
	): ?array {
		$cacheRecord = @include $confCacheFile;
		if ( $cacheRecord === false ) {
			return null;
		}

		if ( ( $cacheRecord['mtime'] ?? null ) === $confActualMtime ) {
			return $cacheRecord[$type] ?? null;
		}

		return null;
	}

	public static function getManageWikiConfigCache(): array {
		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();
		if ( $cacheArray === [] ) {
			return [];
		}

		$settings = [];

		// Core language code
		$settings['wgLanguageCode']['default'] = $cacheArray['core']['wgLanguageCode'] ?? 'en';

		// States
		$states = $cacheArray['states'] ?? [];
		$settings['cwPrivate']['default'] = (bool)( $states['private'] ?? false );
		$settings['cwClosed']['default'] = (bool)( $states['closed'] ?? false );
		$settings['cwLocked']['default'] = (bool)( $states['locked'] ?? false );
		$settings['cwDeleted']['default'] = (bool)( $states['deleted'] ?? false );
		$settings['cwInactive']['default'] = $states['inactive'] === 'exempt' ? 'exempt' : (bool)( $states['inactive'] ?? false );
		$settings['cwExperimental']['default'] = (bool)( $states['experimental'] ?? false );

		// Config settings
		foreach ( $cacheArray['settings'] ?? [] as $var => $val ) {
			$settings[$var]['default'] = $val;
		}

		// Namespaces
		foreach ( $cacheArray['namespaces'] ?? [] as $name => $ns ) {
			$id = (int)$ns['id'];
			$settings['wgNamespacesToBeSearchedDefault']['default'][$id] = $ns['searchable'];
			$settings['wgNamespacesWithSubpages']['default'][$id] = $ns['subpages'];
			$settings['wgNamespaceContentModels']['default'][$id] = $ns['contentmodel'];

			if ( $ns['content'] ) {
				$settings['wgContentNamespaces']['default'][] = $id;
			}

			if ( $ns['protection'] ) {
				$settings['wgNamespaceProtection']['default'][$id] = [ $ns['protection'] ];
			}

			foreach ( (array)$ns['aliases'] as $alias ) {
				$settings['wgNamespaceAliases']['default'][$alias] = $id;
			}

			if ( $id === NS_PROJECT ) {
				$settings['wgMetaNamespace']['default'] = $name;
			} elseif ( $id === NS_PROJECT_TALK ) {
				$settings['wgMetaNamespaceTalk']['default'] = $name;
			} else {
				$settings['wgExtraNamespaces']['default'][$id] = $name;
			}
		}

		// Permissions
		foreach ( $cacheArray['permissions'] ?? [] as $group => $perm ) {
			foreach ( (array)$perm['permissions'] as $right ) {
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

			$autopromote = (array)$perm['autopromote'];
			if ( $autopromote !== [] ) {
				$onceId = array_search( 'once', $autopromote, true );
				if ( $onceId !== false ) {
					unset( $autopromote[$onceId] );
					$promoteVar = 'wgAutopromoteOnce';
				} else {
					$promoteVar = 'wgAutopromote';
				}

				$settings[$promoteVar]['default'][$group] = $autopromote;
			}
		}

		return $settings;
	}

	public function getSettingValue( string $setting, string $wiki = 'default' ): mixed {
		global $wgConf;

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();

		return $cacheArray['settings'][$setting] ?? $wgConf->get( $setting, $wiki );
	}

	public static function getActiveExtensions(): array {
		global $wgDBname, $wgManageWikiExtensions;

		$confCacheFileName = "config-$wgDBname.php";

		// To-Do: merge ManageWiki cache with main config cache,
		// to automatically update when ManageWiki is updated
		$confActualMtime = max(
			filemtime( __DIR__ . '/../LocalSettings.php' ),
			filemtime( __DIR__ . '/../ManageWikiExtensions.php' ),
			filemtime( MW_INSTALL_PATH . '/includes/Defines.php' ),
			@filemtime( self::CACHE_DIRECTORY . "/$wgDBname.php" )
		);

		static $extensions = null;
		$extensions ??= self::readFromCache(
			self::CACHE_DIRECTORY . "/$confCacheFileName",
			'extensions', $confActualMtime
		);

		if ( $extensions ) {
			return $extensions;
		}

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();
		if ( $cacheArray === [] ) {
			return [];
		}

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

	public static function handleDisabledExtensions(): void {
		global $wgManageWikiExtensions;
		foreach ( static::$disabledExtensions as $name => $reason ) {
			$wgManageWikiExtensions[$name]['help'] = '<b>Note</b>: This extension has been globally disabled. The following reason was given: ' . $reason;
			$wgManageWikiExtensions[$name]['requires'] = [
				'permissions' => [ 'managewiki-restricted' ],
			];
		}
	}

	public function isExtensionActive( string $extension ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		return in_array( $extension, self::$activeExtensions, true );
	}

	public function isAnyOfExtensionsActive( string ...$extensions ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		foreach ( $extensions as $ext ) {
			if ( in_array( $ext, self::$activeExtensions, true ) ) {
				return true;
			}
		}

		return false;
	}

	public function isAllOfExtensionsActive( string ...$extensions ): bool {
		self::$activeExtensions ??= self::getActiveExtensions();
		foreach ( $extensions as $ext ) {
			if ( !in_array( $ext, self::$activeExtensions, true ) ) {
				return false;
			}
		}

		return true;
	}

	public function loadExtensions(): void {
		global $wgDBname;

		$cacheData = @include self::CACHE_DIRECTORY . "/$wgDBname.php";
		if ( $cacheData === false || $cacheData === [] ) {
			global $wgConf;
			if ( self::getRealm( $wgDBname ) !== 'default' ) {
				$wgConf->siteParamsCallback = static fn (): array => [
					'suffix' => null,
					'lang' => 'en',
					'tags' => [ self::getRealm() ],
					'params' => [],
				];
			}

			return;
		}

		$listFile = self::CACHE_DIRECTORY . '/' . $this->version . '/extension-list.php';
		$list = @include $listFile;
		if ( $list === false ) {
			$versionDir = self::CACHE_DIRECTORY . '/' . $this->version;
			if ( !is_dir( $versionDir ) ) {
				// Create directory since it doesn't exist
				mkdir( $versionDir, recursive: true );
			}

			$extensions = glob( self::MEDIAWIKI_DIRECTORY . $this->version . '/extensions/*/extension*.json' );
			$skins = glob( self::MEDIAWIKI_DIRECTORY . $this->version . '/skins/*/skin.json' );
			$queue = array_fill_keys( array_merge( $extensions, $skins ), true );

			$processor = new ExtensionProcessor();
			foreach ( $queue as $path => $_ ) {
				$processor->extractInfoFromFile( $path );
			}

			$data = $processor->getExtractedInfo();
			$list = array_column( $data['credits'], 'path', 'name' );

			$contents = StaticArrayWriter::write( $list, 'Auto-generated extension list cache.' );
			file_put_contents( $listFile, $contents, LOCK_EX );
		}

		self::handleDisabledExtensions();
		self::$activeExtensions ??= self::getActiveExtensions();
		foreach ( self::$activeExtensions as $name ) {
			$path = $list[$name] ?? null;
			if ( $path && pathinfo( $path, PATHINFO_EXTENSION ) === 'json' ) {
				ExtensionRegistry::getInstance()->queue( $path );
			}
		}
	}

	private static function getDatabaseConnection( string $databaseName ): IReadableDatabase {
		return MediaWikiServices::getInstance()->getConnectionProvider()
			->getReplicaDatabase( $databaseName );
	}

	private static function generateDatabaseLists( string $globalDatabase ): array {
		$dbr = self::getDatabaseConnection( $globalDatabase );
		$allWikis = $dbr->newSelectQueryBuilder()
			->table( 'cw_wikis' )
			->fields( [
				'wiki_dbcluster',
				'wiki_dbname',
				'wiki_url',
				'wiki_sitename',
				'wiki_deleted',
				'wiki_closed',
				'wiki_inactive',
				'wiki_private',
				'wiki_extra',
			] )
			->caller( __METHOD__ )
			->fetchResultSet();

		$activeList = [];
		$closedList = [];
		$combiList = [];
		$deletedList = [];
		$inactiveList = [];
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

				if ( (int)$wiki->wiki_closed === 1 ) {
					$closedList[$wiki->wiki_dbname] = [
						's' => $wiki->wiki_sitename,
						'c' => $wiki->wiki_dbcluster,
					];
				}

				if ( (int)$wiki->wiki_inactive === 1 ) {
					$inactiveList[$wiki->wiki_dbname] = [
						's' => $wiki->wiki_sitename,
						'c' => $wiki->wiki_dbcluster,
					];
				}

				$extraData = json_decode( $wiki->wiki_extra ?: '[]', true );

				$primaryDomain = ( $extraData['primary-domain'] ?? null ) ?: self::DEFAULT_SERVER[self::getRealm( $wiki->wiki_dbname )];
				$wikiVersion = ( $extraData['mediawiki-version'] ?? null ) ?: self::MEDIAWIKI_VERSIONS[self::getDefaultMediaWikiVersion()];

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
			'closed' => $closedList,
			'databases' => $combiList,
			'deleted' => $deletedList,
			'inactive' => $inactiveList,
			'public' => $publicList,
			'private' => $privateList,
			'versions' => $versions,
		];
	}

	public static function onGenerateDatabaseLists( array &$databaseLists ): void {
		$isBeta = php_uname( 'n' ) === self::BETA_HOSTNAME;
		$databases = self::generateDatabaseLists(
			self::GLOBAL_DATABASE[ $isBeta ? 'beta' : 'default' ]
		);

		$databaseLists = [
			'active' => $databases['active'],
			'closed' => $databases['closed'],
			'databases' => $databases['databases'],
			'deleted' => $databases['deleted'],
			'inactive' => $databases['inactive'],
			'public' => $databases['public'],
			'private' => $databases['private'],
		];

		foreach ( self::MEDIAWIKI_VERSIONS as $name => $version ) {
			$databaseLists += [
				"$name-wikis" => $databases['versions'][$version],
			];
		}
	}

	public static function onManageWikiCoreAddFormFields(
		IContextSource $context,
		ModuleFactory $moduleFactory,
		string $dbname,
		bool $ceMW,
		array &$formDescriptor
	): void {
		$mwVersion = self::getMediaWikiVersion( $dbname );
		$versions = array_unique( array_filter(
			self::MEDIAWIKI_VERSIONS,
			static fn ( string $version ): bool => $mwVersion === $version ||
				is_dir( self::MEDIAWIKI_DIRECTORY . $version )
		) );

		asort( $versions );

		$formDescriptor['primary-domain'] = [
			'label-message' => 'miraheze-label-managewiki-primary-domain',
			'type' => 'select',
			'options' => array_combine( self::ALLOWED_DOMAINS[self::getRealm( $dbname )], self::ALLOWED_DOMAINS[self::getRealm( $dbname )] ),
			'default' => self::getPrimaryDomain( $dbname ),
			'disabled' => !$context->getAuthority()->isAllowed( 'managewiki-restricted' ),
			'cssclass' => 'ext-managewiki-infuse',
			'section' => 'main',
		];

		$mwSettings = $moduleFactory->settings( $dbname );
		$setList = $mwSettings->listAll();
		$formDescriptor['article-path'] = [
			'label-message' => 'miraheze-label-managewiki-article-path',
			'type' => 'select',
			'options-messages' => [
				'miraheze-label-managewiki-article-path-wiki' => '/wiki/$1',
				'miraheze-label-managewiki-article-path-root' => '/$1',
			],
			'default' => $setList['wgArticlePath'] ?? '/wiki/$1',
			'disabled' => !$context->getAuthority()->isAllowed( 'managewiki-restricted' ),
			'cssclass' => 'ext-managewiki-infuse',
			'section' => 'main',
		];

		$formDescriptor['mainpage-is-domain-root'] = [
			'label-message' => 'miraheze-label-managewiki-mainpage-is-domain-root',
			'type' => 'check',
			'default' => $setList['wgMainPageIsDomainRoot'] ?? false,
			'disabled' => !$context->getAuthority()->isAllowed( 'managewiki-restricted' ),
			'cssclass' => 'ext-managewiki-infuse',
			'section' => 'main',
		];

		$formDescriptor['mediawiki-version'] = [
			'label-message' => 'miraheze-label-managewiki-mediawiki-version',
			'type' => 'select',
			'options' => array_combine( $versions, $versions ),
			'default' => $mwVersion,
			'disabled' => !$context->getAuthority()->isAllowed( 'managewiki-restricted' ),
			'cssclass' => 'ext-managewiki-infuse',
			'section' => 'main',
		];
	}

	public static function onManageWikiCoreFormSubmission(
		IContextSource $context,
		ModuleFactory $moduleFactory,
		string $dbname,
		array $formData
	): void {
		$version = self::getMediaWikiVersion( $dbname );
		$mediawikiVersion = $formData['mediawiki-version'] ?? $version;
		$mwCore = $moduleFactory->core( $dbname );
		if ( $mediawikiVersion !== $version && is_dir( self::MEDIAWIKI_DIRECTORY . $mediawikiVersion ) ) {
			$mwCore->setExtraFieldData(
				'mediawiki-version', $mediawikiVersion, default: $version
			);
		}

		$domain = self::getPrimaryDomain( $dbname );
		$primaryDomain = $formData['primary-domain'] ?? $domain;
		if ( $primaryDomain !== $domain ) {
			$mwCore->setExtraFieldData(
				'primary-domain', $primaryDomain, default: $domain
			);
		}

		$mwSettings = $moduleFactory->settings( $dbname );
		$articlePath = $mwSettings->list( 'wgArticlePath' ) ?? '/wiki/$1';
		if ( $formData['article-path'] !== $articlePath ) {
			$mwSettings->modify( [ 'wgArticlePath' => $formData['article-path'] ], default: '/wiki/$1' );
			$mwSettings->commit();

			$mwCore->trackChange( 'article-path', $articlePath, $formData['article-path'] );

			$server = self::getServer();
			$jobQueueGroupFactory = MediaWikiServices::getInstance()->getJobQueueGroupFactory();
			$jobQueueGroupFactory->makeJobQueueGroup( $dbname )->push(
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

		$mainPageIsDomainRoot = $mwSettings->list( 'wgMainPageIsDomainRoot' ) ?? false;
		if ( $formData['mainpage-is-domain-root'] !== $mainPageIsDomainRoot ) {
			$mwSettings->modify( [ 'wgMainPageIsDomainRoot' => $formData['mainpage-is-domain-root'] ], default: false );
			$mwSettings->commit();

			$mwCore->trackChange( 'mainpage-is-domain-root',
				$mainPageIsDomainRoot,
				$formData['mainpage-is-domain-root']
			);
		}
	}

	public static function onMediaWikiServices(): void {
		if ( !isset( $GLOBALS['globals'] ) || !is_array( $GLOBALS['globals'] ) ) {
			return;
		}

		$settings = $GLOBALS['wgConf']->settings;
		foreach ( $GLOBALS['globals'] as $global => $value ) {
			if (
				!isset( $settings["+$global"] ) &&
				$global !== 'wgArticlePath' &&
				$global !== 'wgServer' &&
				$global !== 'wgManageWikiPermissionsAdditionalRights'
			) {
				$GLOBALS[$global] = $value;
			}
		}

		// Don't need a global here
		unset( $GLOBALS['globals'] );
	}
}
