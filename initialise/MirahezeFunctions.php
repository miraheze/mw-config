<?php
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

	public function initialise() {
		self::setupHooks();

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

	public static function getLocalDatabases() {
		$betaDatabases = self::readDbListFile( 'beta' );
		$productionDatabases = self::readDbListFile( 'production' );

		return [
			self::TAGS['default'] => $productionDatabases,
			self::TAGS['beta'] => $betaDatabases,
		];
	}

	public static function readDbListFile( $dblist, $onlyDBs = true, $database = null, $fromServer = false ) {
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
				$database = array_keys(
					array_filter(
						$databasesArray['combi'] ?? $databasesArray['databases'],
						static function( $data ) use ( $database ) {
							return $data['u'] === $database;
						}
					)
				)[0] ?? null;

				if ( $onlyDBs ) {
					return $database;
				}
			}

			if ( isset( $databasesArray['combi'][$database] ) || isset( $databasesArray['databases'][$database] ) ) {
				return $databasesArray['combi'][$database] ?? $databasesArray['databases'][$database];
			} else {
				return null;
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

	public static function getRealm() {
		return isset( self::readDbListFile( 'production' )[ self::getCurrentDatabase() ] ) ?
			self::TAGS['default'] : self::TAGS['beta'];
	}

	public static function getServers( $database = null ) {
		$servers = [];

		$list = isset( self::readDbListFile( 'production' )[ self::getCurrentDatabase() ] ) ? 'production' : 'beta';
                $databases = self::readDbListFile( $list, false, $database );

		$servers['default'] = 'https://' . self::SUFFIXES[ array_key_first( self::SUFFIXES ) ];

		if ( $database ) {
			foreach ( array_flip( self::SUFFIXES ) as $suffix ) {
				if ( substr( $database, -strlen( $suffix ) ) === $suffix ) {
					return $databases['u'] ?? 'https://' . substr( $database, 0, -strlen( $suffix ) ) . '.' . self::SUFFIXES[$suffix];
				}
			}

			return $servers['default'];
		}

		foreach ( $databases as $db => $data ) {
			foreach ( array_flip( self::SUFFIXES ) as $suffix ) {
				if ( substr( $db, -strlen( $suffix ) ) === $suffix ) {
					$servers[$db] = $data['u'] ?? 'https://' . substr( $db, 0, -strlen( $suffix ) ) . '.' . self::SUFFIXES[$suffix];
				}
			}
		}

		return $servers;
	}

	public static function getCurrentDatabase() {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
		}

		$hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';

		$database = self::readDbListFile( 'production', true, 'https://' . $hostname, true ) ?:
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

	public static function getDatabaseClusters() {
		$allDatabases = self::readDbListFile( self::LISTS[self::getRealm()], false );
		$deletedDatabases = self::readDbListFile( 'deleted-' . self::LISTS[self::getRealm()], false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$clusters = array_column( $databases, 'c' );

		return array_combine( array_keys( $databases ), $clusters );
	}

	public static function getServer() {
		return self::getServers( self::getCurrentDatabase() );
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
		$allDatabases = self::readDbListFile( self::LISTS[self::getRealm()], false );
		$deletedDatabases = self::readDbListFile( 'deleted-' . self::LISTS[self::getRealm()], false );

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

	public function getCacheArray() {
		// If we don't have a cache file, let us exit here
		if ( !file_exists( self::CACHE_DIRECTORY . '/' . $this->dbname . '.json' ) ) {
			return false;
		}

		$this->cacheArray = (array)json_decode( file_get_contents( self::CACHE_DIRECTORY . '/' . $this->dbname . '.json' ), true );

		return $this->cacheArray;
	}

	public function readCache() {
		global $wgConf;

		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return;
		}

		$wgConf->settings['wgLanguageCode'][$this->dbname] = $this->cacheArray['core']['wgLanguageCode'];

		// Assign states
		$wgConf->settings['cwPrivate'][$this->dbname] = (bool)$this->cacheArray['states']['private'];
		$wgConf->settings['cwClosed'][$this->dbname] = (bool)$this->cacheArray['states']['closed'];
		$wgConf->settings['cwInactive'][$this->dbname] = ( $this->cacheArray['states']['inactive'] === 'exempt' ) ? 'exempt' : (bool)$this->cacheArray['states']['inactive'];
		$wgConf->settings['cwExperimental'][$this->dbname] = (bool)( $this->cacheArray['states']['experimental'] ?? false );

		$tags = [];
		if ( self::getRealm() !== 'default' ) {
			$tags[] = self::getRealm();
		}

		foreach ( $this->cacheArray['states'] as $state => $value ) {
			if ( $value !== 'exempt' && (bool)$value ) {
				$tags[] = $state;
			}
		}

		$tags = array_merge( ( $this->cacheArray['extensions'] ?? [] ), $tags );
		$lang = $this->cacheArray['core']['wgLanguageCode'] ?? 'en';

		$wgConf->siteParamsCallback = static function () use ( $tags, $lang ) {
			return [
				'suffix' => null,
				'lang' => $lang,
				'tags' => $tags,
				'params' => [],
			];
		};

		// Assign settings
		if ( isset( $this->cacheArray['settings'] ) ) {
			foreach ( $this->cacheArray['settings'] as $var => $val ) {
				$wgConf->settings[$var][$this->dbname] = $val;
			}
		}

		// Assign extensions variables now
		if ( isset( $this->cacheArray['extensions'] ) ) {
			foreach ( $this->cacheArray['extensions'] as $var ) {
				$wgConf->settings[$var][$this->dbname] = true;
			}
		}

		// Handle namespaces - additional settings will be done in ManageWiki
		if ( isset( $this->cacheArray['namespaces'] ) ) {
			foreach ( $this->cacheArray['namespaces'] as $name => $ns ) {
				$wgConf->settings['wgExtraNamespaces'][$this->dbname][(int)$ns['id']] = $name;
				$wgConf->settings['wgNamespacesToBeSearchedDefault'][$this->dbname][(int)$ns['id']] = $ns['searchable'];
				$wgConf->settings['wgNamespacesWithSubpages'][$this->dbname][(int)$ns['id']] = $ns['subpages'];
				$wgConf->settings['wgNamespaceContentModels'][$this->dbname][(int)$ns['id']] = $ns['contentmodel'];

				if ( $ns['content'] ) {
					$wgConf->settings['wgContentNamespaces'][$this->dbname][] = (int)$ns['id'];
				}

				if ( $ns['protection'] ) {
					$wgConf->settings['wgNamespaceProtection'][$this->dbname][(int)$ns['id']] = [ $ns['protection'] ];
				}

				foreach ( (array)$ns['aliases'] as $alias ) {
					$wgConf->settings['wgNamespaceAliases'][$this->dbname][$alias] = (int)$ns['id'];
				}
			}
		}

		// Handle Permissions
		if ( isset( $this->cacheArray['permissions'] ) ) {
			foreach ( $this->cacheArray['permissions'] as $group => $perm ) {
				foreach ( (array)$perm['permissions'] as $id => $right ) {
					$wgConf->settings['wgGroupPermissions'][$this->dbname][$group][$right] = true;
				}

				foreach ( (array)$perm['addgroups'] as $name ) {
					$wgConf->settings['wgAddGroups'][$this->dbname][$group][] = $name;
				}

				foreach ( (array)$perm['removegroups'] as $name ) {
					$wgConf->settings['wgRemoveGroups'][$this->dbname][$group][] = $name;
				}

				foreach ( (array)$perm['addself'] as $name ) {
					$wgConf->settings['wgGroupsAddToSelf'][$this->dbname][$group][] = $name;
				}

				foreach ( (array)$perm['removeself'] as $name ) {
					$wgConf->settings['wgGroupsRemoveFromSelf'][$this->dbname][$group][] = $name;
				}

				if ( $perm['autopromote'] !== null ) {
					$onceId = array_search( 'once', $perm['autopromote'] );

					if ( !is_bool( $onceId ) ) {
						unset( $perm['autopromote'][$onceId] );
						$promoteVar = 'wgAutopromoteOnce';
					} else {
						$promoteVar = 'wgAutopromote';
					}

					$wgConf->settings[$promoteVar][$this->dbname][$group] = $perm['autopromote'];
				}
			}
		}
	}

	public function loadExtensions() {
		global $wgExtensionDirectory, $wgStyleDirectory,
			$wgManageWikiExtensions, $wgConf;

		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return;
		}

		if ( !file_exists( self::CACHE_DIRECTORY . '/extension-list.json' ) ) {
			$queue = array_fill_keys( array_merge(
					glob( $wgExtensionDirectory . '/*/extension*.json' ),
					glob( $wgStyleDirectory . '/*/skin.json' )
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

		if ( isset( $this->cacheArray['extensions'] ) ) {
			foreach ( $wgManageWikiExtensions as $name => $ext ) {
				$wgConf->settings[ $ext['var'] ]['default'] = false;

				if ( in_array( $ext['var'], $this->cacheArray['extensions'] ) &&
					!in_array( $name, $this->disabledExtensions )
				) {
					$path = $list[ $ext['name'] ] ?? false;

					$pathInfo = pathinfo( $path )['extension'] ?? false;
					if ( $path && $pathInfo === 'json' ) {
						ExtensionRegistry::getInstance()->queue( $path );
					}
				}
			}
		}
	}

	private static function getCombiList( $globalDatabase ) {
		$dbr = wfGetDB( DB_REPLICA, [], $globalDatabase );
		$allWikis = $dbr->select(
			'cw_wikis',
			[
				'wiki_dbcluster',
				'wiki_dbname',
				'wiki_deleted',
				'wiki_url',
				'wiki_sitename',
			]
		);

		$combiList = [];
		foreach ( $allWikis as $wiki ) {
			if ( $wiki->wiki_deleted == 1 ) {
				continue;
			} else {
				$combiList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];

				if ( $wiki->wiki_url !== null ) {
					$combiList[$wiki->wiki_dbname]['u'] = $wiki->wiki_url;
				}
			}
		}

		return $combiList;
	}

	private static function getDeletedList( $globalDatabase ) {
		$dbr = wfGetDB( DB_REPLICA, [], $globalDatabase );
		$allWikis = $dbr->select(
			'cw_wikis',
			[
				'wiki_dbcluster',
				'wiki_dbname',
				'wiki_deleted',
				'wiki_sitename',
			]
		);

		$deletedList = [];
		foreach ( $allWikis as $wiki ) {
			if ( $wiki->wiki_deleted == 1 ) {
				$deletedList[$wiki->wiki_dbname] = [
					's' => $wiki->wiki_sitename,
					'c' => $wiki->wiki_dbcluster,
				];
			}
		}

		return $deletedList;
	}

	public static function onGenerateDatabaseLists( &$databaseLists ) {
		$databaseLists = [
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
