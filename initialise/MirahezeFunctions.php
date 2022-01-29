<?php
class MirahezeFunctions {
	public $hostname;
	public $dbname;
	public $server;
	public $sitename;
	public $missing;
	public $wikiDBClusters;
	public $disabledExtensions = [];

	public const TAGS = [
		'default' => 'default',
		'beta' => 'betaheze',
	];

	public const REALMS = [
		'betaheze.org' => 'betaheze',
	];

	public const SUFFIXES = [
		'wiki' => 'miraheze.org',
		'wikibeta' => 'betaheze.org',
	];

	public function initialise() {
		$this->hostname = $_SERVER['HTTP_HOST'] ?? 'undefined';
		$this->dbname = $this->getCurrentDatabase();
		$this->wikiDBClusters = $this->getDatabaseClusters();
		$this->setDatabase();

		$this->server = $this->getServer();
		$this->sitename = $this->getSitename();
		$this->missing = $this->isMissing();
	}

	public static function getLocalDatabases() {
		$allDatabases = self::evalDbListExpression( 'all + beta' );
		$productionDatabases = self::readDbListFile( 'all' );

		return [
			self::TAGS['default'] => $productionDatabases,
			self::TAGS['beta'] => $allDatabases,
		];
	}

	public static function evalDbListExpression( $expr ) {
		$expr = trim( strtok( $expr, "#\n" ), "% " );
		$tokens = preg_split( '/ +([-+&]) +/m', $expr, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );
		$result = self::readDbListFile( basename( $tokens[0], '.dblist' ) );
		while ( ( $op = next( $tokens ) ) && ( $term = next( $tokens ) ) ) {
			$dbs = self::readDbListFile( basename( $term, '.dblist' ) );
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

	public static function readDbListFile( $dblist, $onlyDBs = true ) {
		$fileName = dirname( __DIR__, 2 ) . '/dblists/' . $dblist . '.dblist';
		$lines = @file( $fileName, FILE_IGNORE_NEW_LINES );
		if ( !$lines ) {
			throw new Exception( __METHOD__ . ": unable to read $dblist." );
		}

		$dbs = [];
		foreach ( $lines as $line ) {
			// Ignore empty lines and lines that are comments
			if ( $line !== '' && $line[0] !== '#' ) {
				$explode = explode( '|', $line );

				$dbs[ $explode[0] ] = [
					'dbcluster' => $explode[1] ?? 'c1',
					'server' => $explode[2] ?? $explode[0] . '.' . ( $_SERVER['HTTP_HOST'] ?? 'miraheze.org' ),
					'sitename' => $explode[3] ?? 'No sitename set.',
				];
			}
		}

		if ( $onlyDBs ) {
			return array_keys( $dbs );
		}

		return $dbs;
	}

	public static function getRealm() {
		$domain = explode( '.', $_SERVER['SERVER_NAME'], 2 )[1];

		return self::REALMS[$domain] ?? 'default';
	}

	public function getCurrentDatabase() {
		if ( defined( 'MW_DB' ) ) {
			return MW_DB;
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
		$databases = self::readDbListFile( 'all', false );
		$clusters = array_column( $databases, 'dbcluster' );

		return array_combine( array_keys( $databases ), $clusters );
	}

	public function getServer() {
		global $wgConf;

		$this->cacheArray ??= $this->getCacheArray();

		$explode = explode( '.', $this->hostname, 2 );

		if ( $explode[0] == 'www' ) {
			$explode = explode( '.', $explode[1], 2 );
		}

		$domain = explode( '.', $_SERVER['SERVER_NAME'], 2 )[1];
		$subdomain = $explode[0] . '.' . $domain;

		$server = $this->cacheArray['url'] ?: ( 'https://' . $subdomain . '.' . $domain );
		$wgConf->settings['wgServer'][$this->dbname] = $server;

		return $server;
	}

	public function getSitename() {
		global $wgConf;

		$this->cacheArray ??= $this->getCacheArray();

		$siteName = $this->cacheArray['core']['wgSitename'];

		$wgConf->settings['wgSitename'][$this->dbname] = $siteName;

		return $siteName;
	}

	public function isMissing() {
		global $wgConf;

		return !in_array( $this->getCurrentDatabase(), $wgConf->wikis );
	}

	public function getCacheArray() {
		global $wgCreateWikiCacheDirectory;

		// If we don't have a cache file, let us exit here
		if ( !file_exists( $wgCreateWikiCacheDirectory . '/' . $this->dbname . '.json' ) ) {
			return false;
		}

		$this->cacheArray = (array)json_decode( file_get_contents( $wgCreateWikiCacheDirectory . '/' . $this->dbname . '.json' ), true );

		return (array)$this->cacheArray;
	}

	public function readCache() {
		global $wgConf;

		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return;
		}

		// Assign top level variables first
		$wgConf->settings['wgLanguageCode'][$this->dbname] = $this->cacheArray['core']['wgLanguageCode'];
		if ( $this->cacheArray['url'] ) {
			$wgConf->settings['wgServer'][$this->dbname] = $this->cacheArray['url'];
		}

		// Assign states
		$wgConf->settings['cwPrivate'][$this->dbname] = (bool)$this->cacheArray['states']['private'];
		$wgConf->settings['cwClosed'][$this->dbname] = (bool)$this->cacheArray['states']['closed'];
		$wgConf->settings['cwInactive'][$this->dbname] = ( $this->cacheArray['states']['inactive'] == 'exempt' ) ? 'exempt' : (bool)$this->cacheArray['states']['inactive'];
		$wgConf->settings['cwExperimental'][$this->dbname] = (bool)( $this->cacheArray['states']['experimental'] ?? false );

		$server = $wgConf->settings['wgServer'][$this->dbname] ?? $wgConf->settings['wgServer']['default'];
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
		global $wgCreateWikiCacheDirectory,
			$wgExtensionDirectory, $wgStyleDirectory,
			$wgManageWikiExtensions;

		$this->cacheArray ??= $this->getCacheArray();

		if ( !$this->cacheArray ) {
			return;
		}

		if ( !file_exists( "{$wgCreateWikiCacheDirectory}/extension-list.json" ) ) {
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

			file_put_contents( "{$wgCreateWikiCacheDirectory}/extension-list.json", json_encode( $list ), LOCK_EX );
		} else {
			$list = json_decode( file_get_contents( "{$wgCreateWikiCacheDirectory}/extension-list.json" ), true );
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
