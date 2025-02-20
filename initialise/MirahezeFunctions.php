<?php

use MediaWiki\Config\SiteConfiguration;
use MediaWiki\Context\IContextSource;
use MediaWiki\MediaWikiServices;
use MediaWiki\Registration\ExtensionProcessor;
use MediaWiki\Registration\ExtensionRegistry;
use Miraheze\CreateWiki\Services\RemoteWikiFactory;
use Miraheze\ManageWiki\Helpers\ManageWikiSettings;
use Wikimedia\Rdbms\IDatabase;
use Wikimedia\Rdbms\IReadableDatabase;

class MirahezeFunctions {

	public string $dbname;
	public string $realm;
	public string $server;
	public string $sitename;
	public string $version;

	public bool $missing;
	public array $wikiDBClusters;

	public static array $disabledExtensions = [];

	private static ?string $currentDatabase = null;
	private static ?array $activeExtensions = null;

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

	private static function getHostname(): string {
		static $hostname = null;
		if ( $hostname === null ) {
			$hostname = php_uname( 'n' );
		}

		return $hostname;
	}

	public function __construct() {
		self::setupSiteConfiguration();

		$this->dbname = self::getCurrentDatabase();

		$expectedSuffix = self::getHostname() === self::BETA_HOSTNAME ? 'wikibeta' : 'wiki';
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

	public static function getLocalDatabases(): ?array {
		global $wgLocalDatabases;
		static $databases = null;
		if ( $databases === null ) {
			self::$currentDatabase ??= self::getCurrentDatabase();
			$databases = array_merge(
				self::readDbListFile( 'databases' ),
				self::readDbListFile( 'deleted' )
			);

			$wgLocalDatabases = $databases;
		}

		return $databases;
	}

	public static function readDbListFile(
		string $dblist,
		bool $onlyDBs = true,
		?string $database = null,
		bool $fromServer = false
	): array|string {
		if ( $database && $onlyDBs && !$fromServer ) {
			return $database;
		}

		$filePath = self::CACHE_DIRECTORY . "/{$dblist}.php";

		if ( !file_exists( $filePath ) ) {
			return [];
		}

		$databasesArray = include $filePath;

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

			return $databasesArray['databases'][ $database ] ?? '';
		} else {
			global $wgDatabaseClustersMaintenance;
			$databases = $databasesArray['databases'] ?? [];

			if ( $wgDatabaseClustersMaintenance ) {
				$databases = array_filter( $databases, static function ( $data, $key ) use ( $wgDatabaseClustersMaintenance ) {
					global $wgDBname;
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

	public static function setupSiteConfiguration(): void {
		global $wgConf;
		$wgConf = new SiteConfiguration();
		$wgConf->suffixes = array_keys( self::SUFFIXES );
		$wgConf->wikis	= self::getLocalDatabases();
	}

	public static function getRealm( ?string $database = null ): string {
		if ( $database ) {
			$defaultSuffix = array_keys( self::SUFFIXES )[0];
			return ( substr( $database, -strlen( $defaultSuffix ) ) === $defaultSuffix )
				? self::TAGS['default']
				: self::TAGS['beta'];
		}

		self::$currentDatabase ??= self::getCurrentDatabase();
		$defaultSuffix = array_keys( self::SUFFIXES )[0];

		return ( substr( self::$currentDatabase, -strlen( $defaultSuffix ) ) === $defaultSuffix )
			? self::TAGS['default']
			: self::TAGS['beta'];
	}

	public static function getCurrentSuffix(): string {
		return array_keys( array_filter( self::SUFFIXES, static function ( $v ) {
			return in_array( self::DEFAULT_SERVER[ self::getRealm() ], $v );
		} ) )[0];
	}

	public static function getServers(
		?string $database = null,
		bool $deleted = false
	): array|string {
		global $wgConf;

		if ( $database !== null ) {
			if ( $wgConf->get( 'wgServer', $database ) ) {
				return $wgConf->get( 'wgServer', $database );
			}

			if ( isset( $wgConf->settings['wgServer'] ) && count( $wgConf->settings['wgServer'] ) > 1 ) {
				return 'https://' . self::DEFAULT_SERVER[ self::getRealm() ];
			}
		}

		if ( isset( $wgConf->settings['wgServer'] ) && count( $wgConf->settings['wgServer'] ) > 1 ) {
			return $wgConf->settings['wgServer'];
		}

		$servers = [];
		static $default = null;
		static $list = null;

		self::$currentDatabase ??= self::getCurrentDatabase();

		$realm = self::getRealm();
		$databases = self::readDbListFile( 'databases', false, $database );

		if ( $deleted && $databases ) {
			$databases += self::readDbListFile( 'deleted', false, $database );
		}

		if ( $database !== null ) {
			if ( is_string( $database ) && $database !== 'default' ) {
				foreach ( array_keys( self::SUFFIXES ) as $suffix ) {
					if ( substr( $database, -strlen( $suffix ) ) === $suffix ) {
						$defaultServer = $databases['d'] ?? self::SUFFIXES[ $suffix ][ array_search( self::DEFAULT_SERVER[ $realm ], self::SUFFIXES[ $suffix ] ) ];
						return $databases['u'] ?? 'https://' . substr( $database, 0, -strlen( $suffix ) ) . '.' . $defaultServer;
					}
				}
			}

			$default ??= 'https://' . self::DEFAULT_SERVER[ $realm ];
			return $default;
		}

		foreach ( $databases as $db => $data ) {
			foreach ( array_keys( self::SUFFIXES ) as $suffix ) {
				if ( substr( $db, -strlen( $suffix ) ) === $suffix ) {
					$defaultServer = $data['d'] ?? self::SUFFIXES[ $suffix ][ array_search( self::DEFAULT_SERVER[ $realm ], self::SUFFIXES[ $suffix ] ) ];
					$servers[ $db ] = $data['u'] ?? 'https://' . substr( $db, 0, -strlen( $suffix ) ) . '.' . $defaultServer;
				}
			}
		}

		$default ??= 'https://' . self::DEFAULT_SERVER[ $realm ];
		$servers['default'] = $default;

		return $servers;
	}

	public static function getCurrentDatabase( bool $ignorePrimary = false ): string {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
		}

		$hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';
		static $database = null;

		if ( $database !== null ) {
			return $database;
		}

		$database = self::readDbListFile( 'databases', true, 'https://' . $hostname, true );

		if ( $database ) {
			return $database;
		}

		$explode = explode( '.', $hostname, 2 );

		if ( $explode[0] === 'www' ) {
			$explode = explode( '.', $explode[1], 2 );
		}

		if ( isset( $explode[1] ) ) {
			foreach ( self::SUFFIXES as $suffix => $sites ) {
				if ( in_array( $explode[1], $sites ) &&
					( $ignorePrimary || $explode[1] === self::getPrimaryDomain( $explode[0] . $suffix ) ) ) {
					return $explode[0] . $suffix;
				}
			}
		}

		return '';
	}

	public function getAllowedDomains(): array {
		return self::ALLOWED_DOMAINS[ $this->realm ];
	}

	public function getCentralDatabase(): string {
		return self::CENTRAL_DATABASE[ array_flip( self::TAGS )[ $this->realm ] ];
	}

	public function getGlobalDatabase(): string {
		return self::GLOBAL_DATABASE[ array_flip( self::TAGS )[ $this->realm ] ];
	}

	public function getIncidentsDatabase(): string {
		return self::INCIDENTS_DATABASE[ array_flip( self::TAGS )[ $this->realm ] ];
	}

	public function setDatabase(): void {
		global $wgConf, $wgDBname, $wgVirtualDomainsMapping;
		$wgConf->settings['wgDBname'][ $this->dbname ] = $this->dbname;
		$wgDBname = $this->dbname;
		$wgVirtualDomainsMapping['virtual-createwiki'] = [
			'db' => $this->getGlobalDatabase(),
		];
	}

	public static function getDatabaseClusters(): ?array {
		static $allDatabases = null;
		static $deletedDatabases = null;
		$allDatabases ??= self::readDbListFile( 'databases', false );
		$deletedDatabases ??= self::readDbListFile( 'deleted', false );
		$databases = array_merge( $allDatabases, $deletedDatabases );
		$clusters = array_column( $databases, 'c' );
		return array_combine( array_keys( $databases ), $clusters );
	}

	public static function getPrimaryDomain( string $database ): string {
		$primaryDomain = self::readDbListFile( 'databases', false, $database )['d'] ?? null;
		return $primaryDomain ?? self::DEFAULT_SERVER[ self::getRealm( $database ) ];
	}

	public static function getDefaultServer( ?string $database = null ): string {
		static $realm = null;
		$realm ??= self::getRealm( $database );
		return self::DEFAULT_SERVER[ $realm ];
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
		static $siteNames = null;
		if ( $siteNames !== null ) {
			return $siteNames;
		}

		$allDatabases = self::readDbListFile( 'databases', false );
		$deletedDatabases = self::readDbListFile( 'deleted', false );
		$databases = array_merge( $allDatabases, $deletedDatabases );
		$siteNameColumn = array_column( $databases, 's' );
		$siteNames = array_combine( array_keys( $databases ), $siteNameColumn );
		$siteNames['default'] = 'No sitename set.';

		return $siteNames;
	}

	public static function getSiteName(): string {
		self::$currentDatabase ??= self::getCurrentDatabase();
		return self::getSiteNames()[ self::$currentDatabase ] ?? self::getSiteNames()['default'];
	}

	public static function getDefaultMediaWikiVersion(): string {
		return ( self::getHostname() === self::BETA_HOSTNAME && isset( self::MEDIAWIKI_VERSIONS['beta'] ) )
			? 'beta'
			: 'stable';
	}

	public static function getMediaWikiVersion( ?string $database = null ): string {
		if ( getenv( 'MIRAHEZE_WIKI_VERSION' ) ) {
			return getenv( 'MIRAHEZE_WIKI_VERSION' );
		}

		if ( $database ) {
			$mwVersion = self::readDbListFile( 'databases', false, $database )['v'] ?? null;
			return $mwVersion ?? self::MEDIAWIKI_VERSIONS[ self::getDefaultMediaWikiVersion() ];
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
		return !in_array( self::$currentDatabase, $wgConf->wikis );
	}

	public static function getCacheArray(): array {
		self::$currentDatabase ??= self::getCurrentDatabase();
		$cacheFile = self::CACHE_DIRECTORY . '/' . self::$currentDatabase . '.php';
		if ( !file_exists( $cacheFile ) ) {
			return [];
		}

		return include $cacheFile;
	}

	public static function getConfigGlobals(): array {
		global $wgDBname, $wgConf;
		$confCacheFileName = "config-$wgDBname.php";

		$localSettingsMTime = filemtime( __DIR__ . '/../LocalSettings.php' );
		$manageWikiExtMTime = filemtime( __DIR__ . '/../ManageWikiExtensions.php' );
		$manageWikiNSMTime = filemtime( __DIR__ . '/../ManageWikiNamespaces.php' );
		$manageWikiSettingsMTime = filemtime( __DIR__ . '/../ManageWikiSettings.php' );
		$definesMTime = filemtime( MW_INSTALL_PATH . '/includes/Defines.php' );
		$cacheFileMTime = @filemtime( self::CACHE_DIRECTORY . '/' . $wgDBname . '.php' ) ?: 0;
		$confActualMTime = max( $localSettingsMTime, $manageWikiExtMTime, $manageWikiNSMTime, $manageWikiSettingsMTime, $definesMTime, $cacheFileMTime );

		static $globals = null;
		$globals ??= self::readFromCache( self::CACHE_DIRECTORY . '/' . $confCacheFileName, $confActualMTime );
		if ( !$globals ) {
			$wgConf->settings = array_merge( $wgConf->settings, self::getManageWikiConfigCache() );
			self::$activeExtensions ??= self::getActiveExtensions();
			$globals = self::getConfigForCaching();
			$confCacheObject = [
				'mtime' => $confActualMTime,
				'globals' => $globals,
				'extensions' => self::$activeExtensions
			];
			$minTime = $confActualMTime + intval( ini_get( 'opcache.revalidate_freq' ) );
			if ( time() > $minTime ) {
				self::writeToCache( $confCacheFileName, $confCacheObject );
			}
		}

		return $globals;
	}

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
		$wikiTags = array_merge(
			preg_filter( '/^/', 'ext-', str_replace( ' ', '', self::$activeExtensions ) ),
			$wikiTags
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

	public static function writeToCache(
		string $cacheShard,
		array $configObject
	): void {
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

	public static function readFromCache(
		string $confCacheFile,
		string $confActualMtime,
		string $type = 'globals'
	): ?array {
		$cacheRecord = @include $confCacheFile;
		if ( $cacheRecord !== false ) {
			if ( ( $cacheRecord['mtime'] ?? null ) == $confActualMtime ) {
				return $cacheRecord[ $type ] ?? null;
			}
		}

		return null;
	}

	public static function getManageWikiConfigCache(): array {
		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();
		if ( !$cacheArray ) {
			return [];
		}
		$settings = [];
		$settings['wgLanguageCode']['default'] = $cacheArray['core']['wgLanguageCode'];
		$settings['cwPrivate']['default'] = (bool)$cacheArray['states']['private'];
		$settings['cwClosed']['default'] = (bool)$cacheArray['states']['closed'];
		$settings['cwLocked']['default'] = (bool)$cacheArray['states']['locked'] ?? false;
		$settings['cwDeleted']['default'] = (bool)$cacheArray['states']['deleted'] ?? false;
		$settings['cwInactive']['default'] = ( $cacheArray['states']['inactive'] === 'exempt' ) ? 'exempt' : (bool)$cacheArray['states']['inactive'];
		$settings['cwExperimental']['default'] = (bool)( $cacheArray['states']['experimental'] ?? false );

		if ( isset( $cacheArray['settings'] ) ) {
			foreach ( $cacheArray['settings'] as $var => $val ) {
				$settings[ $var ]['default'] = $val;
			}
		}

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

					$settings[ $promoteVar ]['default'][$group] = $perm['autopromote'];
				}
			}
		}

		return $settings;
	}

	public function getSettingValue(
		string $setting,
		string $wiki = 'default'
	): mixed {
		global $wgConf;
		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();
		if ( !$cacheArray ) {
			return $wgConf->get( $setting, $wiki );
		}

		return $cacheArray['settings'][ $setting ] ?? $wgConf->get( $setting, $wiki );
	}

	public static function getActiveExtensions(): array {
		global $wgDBname, $wgManageWikiExtensions;
		$confCacheFileName = "config-$wgDBname.php";
		$localSettingsMTime = filemtime( __DIR__ . '/../LocalSettings.php' );
		$manageWikiExtMTime = filemtime( __DIR__ . '/../ManageWikiExtensions.php' );
		$definesMTime = filemtime( MW_INSTALL_PATH . '/includes/Defines.php' );
		$cacheFileMTime	= @filemtime( self::CACHE_DIRECTORY . '/' . $wgDBname . '.php' ) ?: 0;
		$confActualMTime = max( $localSettingsMTime, $manageWikiExtMTime, $definesMTime, $cacheFileMTime );

		static $extensions = null;
		$extensions ??= self::readFromCache( self::CACHE_DIRECTORY . '/' . $confCacheFileName, $confActualMTime, 'extensions' );
		if ( $extensions ) {
			return $extensions;
		}

		static $cacheArray = null;
		$cacheArray ??= self::getCacheArray();
		if ( !$cacheArray ) {
			return [];
		}

		$allExtensions = array_filter( array_combine(
			array_column( $wgManageWikiExtensions, 'name' ),
			array_keys( $wgManageWikiExtensions )
		) );

		$enabledExtensions = array_keys( array_diff( $allExtensions, array_keys( static::$disabledExtensions ) ) );

		return array_values( array_intersect(
			$cacheArray['extensions'] ?? [],
			$enabledExtensions
		) );
	}

	public static function handleDisabledExtensions(): void {
		global $wgManageWikiExtensions;
		foreach ( static::$disabledExtensions as $name => $reason ) {
			$wgManageWikiExtensions[ $name ]['help'] = '<b>Note</b>: This extension has been globally disabled. The following reason was given: ' . $reason;
			$wgManageWikiExtensions[ $name ]['requires'] = [
				'permissions' => [
					'managewiki-restricted',
				],
			];
		}
	}

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

	public function loadExtensions(): void {
		global $wgDBname, $wgConf;
		$cacheFile = self::CACHE_DIRECTORY . '/' . $wgDBname . '.php';
		if ( !file_exists( $cacheFile ) ) {
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

		$extCacheDir = self::CACHE_DIRECTORY . '/' . $this->version;
		$extCacheFile = $extCacheDir . '/extension-list.php';
		if ( !file_exists( $extCacheFile ) ) {
			if ( !is_dir( $extCacheDir ) ) {
				mkdir( $extCacheDir );
			}
			$queue = array_fill_keys(
				array_merge(
					glob( self::MEDIAWIKI_DIRECTORY . $this->version . '/extensions/*/extension*.json' ),
					glob( self::MEDIAWIKI_DIRECTORY . $this->version . '/skins/*/skin.json' )
				),
				true
			);
			$processor = new ExtensionProcessor();
			foreach ( $queue as $path => $mtime ) {
				$json = file_get_contents( $path );
				$info = json_decode( $json, true );
				$version = $info['manifest_version'] ?? 2;
				$processor->extractInfo( $path, $info, $version );
			}
			$data = $processor->getExtractedInfo();
			$list = array_column( $data['credits'], 'path', 'name' );
			$phpContent = "<?php\n\n" .
				"/**\n * Auto-generated extension list cache.\n */\n\n" .
				'return ' . var_export( $list, true ) . ";\n";
			file_put_contents( $extCacheFile, $phpContent, LOCK_EX );
		} else {
			$list = include $extCacheFile;
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
			$versions[ $version ] = [];
		}
		foreach ( $allWikis as $wiki ) {
			if ( (int)$wiki->wiki_deleted === 1 ) {
				$deletedList[ $wiki->wiki_dbname ] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];
			} else {
				if ( (int)$wiki->wiki_closed === 0 && (int)$wiki->wiki_inactive === 0 ) {
					$activeList[ $wiki->wiki_dbname ] = [
						's' => $wiki->wiki_sitename,
						'c' => $wiki->wiki_dbcluster,
					];
				}
				$primaryDomain = ( $wiki->wiki_primary_domain ?? null ) ?: self::DEFAULT_SERVER[ self::getRealm( $wiki->wiki_dbname ) ];
				$wikiVersion = ( $wiki->wiki_version ?? null ) ?: self::MEDIAWIKI_VERSIONS[ self::getDefaultMediaWikiVersion() ];
				$combiList[ $wiki->wiki_dbname ] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
					'd' => $primaryDomain,
					'v' => $wikiVersion,
				];
				if ( $wiki->wiki_url !== null ) {
					$combiList[ $wiki->wiki_dbname ]['u'] = $wiki->wiki_url;
				}
				if ( isset( $versions[ $wikiVersion ] ) ) {
					$versions[ $wikiVersion ][ $wiki->wiki_dbname ] = $combiList[ $wiki->wiki_dbname ];
				}
			}
			if ( (int)$wiki->wiki_private === 1 ) {
				$privateList[ $wiki->wiki_dbname ] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];
			} else {
				$publicList[ $wiki->wiki_dbname ] = [
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

	public static function onGenerateDatabaseLists( array &$databaseLists ): void {
		$isBeta = self::getHostname() === self::BETA_HOSTNAME;
		$databases = self::generateDatabaseLists( self::GLOBAL_DATABASE[ $isBeta ? 'beta' : 'default' ] );
		$databaseLists = [
			'active' => $databases['active'],
			'databases' => $databases['databases'],
			'deleted' => $databases['deleted'],
			'public' => $databases['public'],
			'private' => $databases['private'],
		];
		foreach ( self::MEDIAWIKI_VERSIONS as $name => $version ) {
			$databaseLists += [
				$name . '-wikis' => $databases['versions'][ $version ],
			];
		}
	}

	public static function onCreateWikiDataFactoryBuilder(
		string $wiki,
		IReadableDatabase $dbr,
		array &$cacheArray
	): void {
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
		$cacheArray['states']['locked']  = (bool)$row->wiki_locked;
	}

	public static function onManageWikiCoreAddFormFields(
		bool $ceMW,
		IContextSource $context,
		string $dbName,
		array &$formDescriptor
	): void {
		$permissionManager = MediaWikiServices::getInstance()->getPermissionManager();
		$mwVersion = self::getMediaWikiVersion( $dbName );
		$versions = array_unique( array_filter( self::MEDIAWIKI_VERSIONS, static function ( $version ) use ( $mwVersion ): bool {
			return $mwVersion === $version || is_dir( self::MEDIAWIKI_DIRECTORY . $version );
		} ) );
		asort( $versions );
		$formDescriptor['primary-domain'] = [
			'label-message' => 'miraheze-label-managewiki-primary-domain',
			'type' => 'select',
			'options' => array_combine(
				self::ALLOWED_DOMAINS[ self::getRealm( $dbName ) ],
				self::ALLOWED_DOMAINS[ self::getRealm( $dbName ) ]
			),
			'default' => self::getPrimaryDomain( $dbName ),
			'disabled' => !$permissionManager->userHasRight( $context->getUser(), 'managewiki-restricted' ),
			'cssclass' => 'managewiki-infuse',
			'section' => 'main',
		];
		$mwSettings = new ManageWikiSettings( $dbName );
		$setList = $mwSettings->list();
		$formDescriptor['article-path'] = [
			'label-message'	=> 'miraheze-label-managewiki-article-path',
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

	public static function onManageWikiCoreFormSubmission(
		IContextSource $context,
		string $dbName,
		IDatabase $dbw,
		array $formData,
		RemoteWikiFactory &$remoteWiki
	): void {
		$version = self::getMediaWikiVersion( $dbName );
		if ( $formData['mediawiki-version'] !== $version && is_dir( self::MEDIAWIKI_DIRECTORY . $formData['mediawiki-version'] ) ) {
			$remoteWiki->addNewRow( 'wiki_version', $formData['mediawiki-version'] );
			$remoteWiki->trackChange( 'mediawiki-version', $version, $formData['mediawiki-version'] );
		}
		if ( $formData['primary-domain'] !== self::getPrimaryDomain( $dbName ) ) {
			$remoteWiki->addNewRow( 'wiki_primary_domain', $formData['primary-domain'] );
			$remoteWiki->trackChange( 'primary-domain', self::getPrimaryDomain( $dbName ), $formData['primary-domain'] );
		}
		$mwSettings = new ManageWikiSettings( $dbName );
		$articlePath = $mwSettings->list()['wgArticlePath'] ?? '';
		if ( $formData['article-path'] !== $articlePath ) {
			$mwSettings->modify( [ 'wgArticlePath' => $formData['article-path'] ] );
			$mwSettings->commit();
			$remoteWiki->trackChange( 'article-path', $articlePath, $formData['article-path'] );
			$server = self::getServer();
			$jobQueueGroupFactory = MediaWikiServices::getInstance()->getJobQueueGroupFactory();
			$jobQueueGroupFactory->makeJobQueueGroup( $dbName )->push( new CdnPurgeJob( [
				'urls' => [
					$server . '/wiki/',
					$server . '/wiki',
					$server . '/',
					$server,
				],
			] ) );
		}
		$mainPageIsDomainRoot = $mwSettings->list()['wgMainPageIsDomainRoot'] ?? false;
		if ( $formData['mainpage-is-domain-root'] !== $mainPageIsDomainRoot ) {
			$mwSettings->modify( [ 'wgMainPageIsDomainRoot' => $formData['mainpage-is-domain-root'] ] );
			$mwSettings->commit();
			$remoteWiki->trackChange( 'mainpage-is-domain-root', $mainPageIsDomainRoot, $formData['mainpage-is-domain-root'] );
		}
	}

	public static function onMediaWikiServices(): void {
		if ( isset( $GLOBALS['globals'] ) ) {
			foreach ( $GLOBALS['globals'] as $global => $value ) {
				if ( !isset( $GLOBALS['wgConf']->settings["+$global"] ) &&
					$global !== 'wgManageWikiPermissionsAdditionalRights'
				) {
					$GLOBALS[ $global ] = $value;
				}
			}
			unset( $GLOBALS['globals'] );
		}
	}
}
