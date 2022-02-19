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

	private const CACHE_DIRECTORY = [
		'default' => '/srv/mediawiki/cache',
	];

	private const REALMS = [
		'betaheze.org' => 'betaheze',
	];

	private const TAGS = [
		'default' => 'default',
		'beta' => 'betaheze',
	];

	public const SUFFIXES = [
		'wiki' => 'miraheze.org',
		'wikibeta' => 'betaheze.org',
	];

	public function initialise() {
		$this->hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';
		$this->dbname = $this->getCurrentDatabase();
		$this->wikiDBClusters = $this->getDatabaseClusters();

		$this->server = $this->getServer();
		$this->sitename = $this->getSitename();
		$this->missing = $this->isMissing();

		$this->setDatabase();
		$this->setServers();
	}

	public static function getLocalDatabases() {
		$allDatabases = self::evalDbListExpression( 'all + beta' );
		$productionDatabases = self::readDbListFile( 'all' );

		return [
			self::TAGS['default'] => $productionDatabases,
			self::TAGS['beta'] => $allDatabases,
		];
	}

	public static function evalDbListExpression( $expr, $type = 'json' ) {
		$expr = trim( strtok( $expr, "#\n" ), "% " );
		$tokens = preg_split( '/ +([-+&]) +/m', $expr, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );
		$result = self::readDbListFile( basename( $tokens[0], ".$type" ) );
		while ( ( $op = next( $tokens ) ) && ( $term = next( $tokens ) ) ) {
			$dbs = self::readDbListFile( basename( $term, ".$type" ) );
			if ( $op === '+' ) {
				$result = array_unique( array_merge( $result, $dbs ) );
			} elseif ( $op === '-' ) {
				$result = array_diff( $result, $dbs );
			} elseif ( $op === '&' ) {
				$result = array_intersect( $result, $dbs );
			}
		}

		sort( $result );

		return $result;
	}

	public static function readDbListFile( $dblist, $onlyDBs = true, $type = 'json' ) {
		if ( $type === 'json' ) {
			if ( $dblist === 'all' ) {
				$dblist = 'databases';
			}

			if ( !file_exists( self::getCacheDirectory() . "/{$dblist}.json" ) ) {
				$databases = [];

				return $databases;
			} else {
				$databasesArray = json_decode( file_get_contents( self::getCacheDirectory() . "/{$dblist}.json" ), true );
			}

			$databases = $databasesArray['combi'] ?? $databasesArray['databases'];
		} else {
			$fileName = dirname( __DIR__, 2 ) . '/dblists/' . $dblist . '.dblist';
			$lines = @file( $fileName, FILE_IGNORE_NEW_LINES );
			if ( !$lines ) {
				throw new Exception( __METHOD__ . ": unable to read $dblist." );
			}

			$databases = [];
			foreach ( $lines as $line ) {
				// Ignore empty lines and lines that are comments
				if ( $line !== '' && $line[0] !== '#' ) {
					$explode = explode( '|', $line, 4 );

					$databases[ $explode[0] ] = [
						'c' => $explode[1] ?? 'c1',
						'u' => $explode[2] ?? $explode[0] . '.' . ( $_SERVER['HTTP_HOST'] ?? 'miraheze.org' ),
						's' => $explode[3] ?? 'No sitename set.',
					];
				}
			}
		}

		if ( $onlyDBs ) {
			return array_keys( $databases );
		}

		return $databases;
	}

	public static function getRealm() {
		$domain = explode( '.', $_SERVER['SERVER_NAME'], 2 )[1];

		return self::REALMS[$domain] ?? 'default';
	}

	public static function getCacheDirectory() {
		return self::CACHE_DIRECTORY[self::getRealm()] ?? self::CACHE_DIRECTORY['default'];
	}

	public static function getServers() {
		$servers = [];
		$databases = self::readDbListFile( 'all', false );

		$servers['default'] = 'https://' . self::SUFFIXES[ array_key_first( self::SUFFIXES ) ];

		foreach ( $databases as $db => $data ) {
			foreach ( self::SUFFIXES as $suffix ) {
				if ( substr( $db, -strlen( $suffix ) ) == $suffix ) {
					$servers[$db] = $data['u'] ?? 'https://' . substr( $db, 0, -strlen( $suffix ) ) . '.' . self::SUFFIXES[$suffix];
				}
			}
		}

		return $servers;
	}

	public function getCurrentDatabase() {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
		}

		if ( isset( array_flip( self::getServers() )['https://' . $this->hostname] ) ) {
			return array_flip( self::getServers() )['https://' . $this->hostname];
		}

		$explode = explode( '.', $this->hostname, 2 );

		if ( $explode[0] == 'www' ) {
			$explode = explode( '.', $explode[1], 2 );
		}

		foreach ( self::SUFFIXES as $suffix => $site ) {
			if ( $explode[1] == $site ) {
				return $explode[0] . $suffix;
			}
		}
	}

	public function setDatabase() {
		global $wgConf;

		$wgConf->settings['wgDBname'][$this->dbname] = $this->dbname;
	}

	public function getDatabaseClusters() {
		$allDatabases = self::readDbListFile( 'all', false );
		$deletedDatabases = self::readDbListFile( 'deleted', false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$clusters = array_column( $databases, 'c' );

		return array_combine( array_keys( $databases ), $clusters );
	}

	public function getServer() {
		return self::getServers()[$this->getCurrentDatabase()] ??
			self::getServers()['default'];
	}

	public function setServers() {
		global $wgConf;

		$wgConf->settings['wgServer'] = self::getServers();
	}

	public function getSitename() {
		global $wgConf;

		$allDatabases = self::readDbListFile( 'all', false );
		$deletedDatabases = self::readDbListFile( 'deleted', false );

		$databases = array_merge( $allDatabases, $deletedDatabases );

		$siteNameColumn = array_column( $databases, 's' );

		$siteNames = array_combine( array_keys( $databases ), $siteNameColumn );
		$siteNames['default'] = 'No sitename set.';

		$wgConf->settings['wgSitename'] = $siteNames;

		return $siteNames[$this->dbname];
	}

	public function isMissing() {
		global $wgConf;

		return !in_array( $this->getCurrentDatabase(), $wgConf->wikis );
	}

	public function getCacheArray() {
		// If we don't have a cache file, let us exit here
		if ( !file_exists( self::getCacheDirectory() . '/' . $this->dbname . '.json' ) ) {
			return false;
		}

		$this->cacheArray = (array)json_decode( file_get_contents( self::getCacheDirectory() . '/' . $this->dbname . '.json' ), true );

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
		$wgConf->settings['cwInactive'][$this->dbname] = ( $this->cacheArray['states']['inactive'] == 'exempt' ) ? 'exempt' : (bool)$this->cacheArray['states']['inactive'];
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
			extract( $this->cacheArray['settings'] );
		}

		// Assign extensions variables now
		if ( isset( $this->cacheArray['extensions'] ) ) {
			extract( array_fill_keys( $this->cacheArray['extensions'], true ) );
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
			$wgManageWikiExtensions;

		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return;
		}

		if ( !file_exists( self::getCacheDirectory() . '/extension-list.json' ) ) {
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

			file_put_contents( self::getCacheDirectory() . '/extension-list.json', json_encode( $list ), LOCK_EX );
		} else {
			$list = json_decode( file_get_contents( self::getCacheDirectory() . '/extension-list.json' ), true );
		}

		if ( isset( $this->cacheArray['extensions'] ) ) {
			foreach ( $wgManageWikiExtensions as $name => $ext ) {
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
}
