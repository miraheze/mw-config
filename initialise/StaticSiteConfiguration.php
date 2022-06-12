<?php
/**
 * Copy of MediaWiki core's SiteConfiguration.php @ 15f6e986eb (3 Mar 2020),
 * slimmed down to remove dynamic things that depend on MediaWiki
 * (which we don't need for static configuration).
 *
 * Authors:
 * https://gerrit.wikimedia.org/g/mediawiki/core/+log/15f6e986eb/includes/SiteConfiguration.php
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

class StaticSiteConfiguration {

	/**
	 * @var array the array of suffixes, for self::siteFromDB()
	 */
	public $suffixes = [];

	/**
	 * @var array the array of wikis, should be the same as $wgLocalDatabases
	 */
	public $wikis = [];

	/**
	 * @var array the whole array of settings
	 */
	public $settings = [];

	/**
	 * Retrieves a configuration setting for a given wiki.
	 * @param string $settingName ID of the setting name to retrieve
	 * @param string $wiki Wiki ID of the wiki in question.
	 * @param string|null $suffix The suffix of the wiki in question.
	 * @param array $params List of parameters. $.'key' is replaced by $value in all returned data.
	 * @param array $wikiTags The tags assigned to the wiki.
	 * @return mixed The value of the setting requested.
	 */
	public function get( $settingName, $wiki, $suffix = null, $params = [],
		$wikiTags = []
	) {
		$params = $this->mergeParams( $wiki, $suffix, $params, $wikiTags );
		$overrides = $this->settings[$settingName] ?? null;
		return $overrides ? $this->processSetting( $overrides, $wiki, $params ) : null;
	}

	/**
	 * Retrieve the configuration setting for a given wiki, based on an overrides array.
	 *
	 * General order of precedence:
	 *
	 * 1. Wiki ID, an override specific to the given wiki.
	 * 2. Tag, an override specific to a group of wikis (e.g. wiki family, or db
	 *    shard). It is unsupported for the same setting to be set for multiple
	 *    tags of which the wiki groups overlap. In that case, whichever is
	 *    iterated and matched first wins, where the tag iteration order
	 *    is NOT guaranteed.
	 * 3. Default, the default value for all wikis in this wiki farm.
	 *
	 * If the "+" operator is used, with any of these, then the merges will follow the
	 * following order (earlier entries have precedence on clashing sub keys):
	 *
	 * 1. "+wiki"
	 * 2. "tag"
	 *    Only one may match here. And upon match, the merge cascade stops.
	 * 3. "+tag"
	 *    These are only considered if there was no "tag" match.
	 *    Multiple matches are allowed here, although the array values from
	 *    multiple tags that contain the same wiki must not overlap, as it is
	 *    undocumented how key conflicts among them would be handled.
	 * 4. "default"
	 *
	 * @param array $thisSetting An array of overrides for a given setting.
	 * @param string $wiki Wiki ID of the wiki in question.
	 * @param array $params Array of parameters.
	 * @return mixed The value of the setting requested.
	 */
	private function processSetting( array $thisSetting, $wiki, array $params ) {
		$retval = null;

		if ( array_key_exists( $wiki, $thisSetting ) ) {
			// Found override by Wiki ID.
			$retval = $thisSetting[$wiki];
		} else {
			if ( array_key_exists( "+$wiki", $thisSetting ) && is_array( $thisSetting["+$wiki"] ) ) {
				// Found mergable override by Wiki ID.
				// We continue to look for more merge candidates.
				$retval = $thisSetting["+$wiki"];
			}

			$done = false;
			foreach ( $params['tags'] as $tag ) {
				if ( array_key_exists( $tag, $thisSetting ) ) {
					if ( is_array( $retval ) && is_array( $thisSetting[$tag] ) ) {
						// Found a mergable override by Tag, without "+" operator.
						// Merge it with any "+wiki" match from before, and stop the cascade.
						$retval = self::arrayMerge( $retval, $thisSetting[$tag] );
					} else {
						// Found a non-mergable override by Tag.
						// This could in theory replace a "+wiki" match, but it should never happen
						// that a setting uses both mergable array values and non-array values.
						$retval = $thisSetting[$tag];
					}
					$done = true;
					break;
				} elseif ( array_key_exists( "+$tag", $thisSetting ) && is_array( $thisSetting["+$tag"] ) ) {
					// Found a mergable override by Tag with "+" operator.
					// Merge it with any "+wiki" or "+tag" matches from before,
					// and keep looking for more merge candidates.
					if ( $retval === null ) {
						$retval = [];
					}
					$retval = self::arrayMerge( $retval, $thisSetting["+$tag"] );
				}
			}

			if ( !$done && array_key_exists( 'default', $thisSetting ) ) {
				if ( is_array( $retval ) && is_array( $thisSetting['default'] ) ) {
					// Found a mergable default
					// Merge it with any "+wiki" or "+tag" matches from before.
					$retval = self::arrayMerge( $retval, $thisSetting['default'] );
				} else {
					// Found a default
					// If any array-based values were built up via "+wiki" or "+tag" matches,
					// these are thrown away here. We don't support merging array values into
					// non-array values, and the fallback here is to use the default.
					$retval = $thisSetting['default'];
				}
			}
		}

		// Type-safe string replacemens, don't do replacements on non-strings.
		if ( is_string( $retval ) ) {
			$retval = strtr( $retval, $params['replacements'] );
		} elseif ( is_array( $retval ) ) {
			foreach ( $retval as $key => $val ) {
				if ( is_string( $val ) ) {
					$retval[$key] = strtr( $val, $params['replacements'] );
				}
			}
		}

		return $retval;
	}

	/**
	 * Gets all settings for a wiki
	 * @param string $wiki Wiki ID of the wiki in question.
	 * @param string|null $suffix The suffix of the wiki in question.
	 * @param array $params List of parameters. $.'key' is replaced by $value in all returned data.
	 * @param array $wikiTags The tags assigned to the wiki.
	 * @return array Array of settings requested.
	 */
	public function getAll( $wiki, $suffix = null, $params = [], $wikiTags = [] ) {
		$params = $this->mergeParams( $wiki, $suffix, $params, $wikiTags );
		$localSettings = [];
		foreach ( $this->settings as $varname => $overrides ) {
			$append = false;
			$var = $varname;
			if ( substr( $varname, 0, 1 ) == '+' ) {
				$append = true;
				$var = substr( $varname, 1 );
			}

			$value = $this->processSetting( $overrides, $wiki, $params );
			if ( $append && is_array( $value ) && is_array( $GLOBALS[$var] ) ) {
				$value = self::arrayMerge( $value, $GLOBALS[$var] );
			}
			if ( $value !== null ) {
				$localSettings[$var] = $value;
			}
		}
		return $localSettings;
	}

	/**
	 * Return specific settings for $wiki
	 *
	 * @param string $wiki
	 * @return array
	 */
	protected function getWikiParams( $wiki ) {
		static $default = [
			'suffix' => null,
			'lang' => null,
			'tags' => [],
			'params' => [],
		];

		return $default;
	}

	/**
	 * Values returned by self::getWikiParams() have the priority.
	 *
	 * @param string $wiki Wiki ID of the wiki in question.
	 * @param string $suffix The suffix of the wiki in question.
	 * @param array $params List of parameters. $.'key' is replaced by $value in
	 *   all returned data.
	 * @param array $wikiTags The tags assigned to the wiki.
	 * @return array
	 */
	protected function mergeParams( $wiki, $suffix, array $params, array $wikiTags ) {
		$ret = $this->getWikiParams( $wiki );

		if ( $ret['suffix'] === null ) {
			$ret['suffix'] = $suffix;
		}

		// Make tags based on the db suffix (e.g. wiki family) automatically
		// available for use in wgConf. The user does not have to maintain
		// wiki tag lookups (e.g. dblists at WMF) for the wiki family.
		$wikiTags[] = $ret['suffix'];

		$ret['tags'] = array_unique( array_merge( $ret['tags'], $wikiTags ) );

		$ret['params'] += $params;

		// Make the $lang and $site parameters automatically available
		if ( !isset( $ret['params']['lang'] ) && $ret['lang'] !== null ) {
			$ret['params']['lang'] = $ret['lang'];
		}
		if ( !isset( $ret['params']['site'] ) && $ret['suffix'] !== null ) {
			$ret['params']['site'] = $ret['suffix'];
		}

		// Optimisation for getAll() and extractAllGlobals():
		// Precompute the replacements once when we process the params,
		// instead separately for each of the thousands of variables.
		$ret['replacements'] = [];
		foreach ( $ret['params'] as $key => $value ) {
			$ret['replacements'][ '$' . $key ] = $value;
		}

		return $ret;
	}

	/**
	 * Work out the site and language name from a database name
	 * @param string $wiki Wiki ID
	 *
	 * @return array
	 */
	public function siteFromDB( $wiki ) {
		// Allow override
		$def = $this->getWikiParams( $wiki );
		if ( $def['suffix'] !== null && $def['lang'] !== null ) {
			return [ $def['suffix'], $def['lang'] ];
		}

		$site = null;
		$lang = null;
		foreach ( $this->suffixes as $altSite => $suffix ) {
			if ( $suffix === '' ) {
				$site = '';
				$lang = $wiki;
				break;
			} elseif ( substr( $wiki, -strlen( $suffix ) ) == $suffix ) {
				$site = is_numeric( $altSite ) ? $suffix : $altSite;
				$lang = substr( $wiki, 0, strlen( $wiki ) - strlen( $suffix ) );
				break;
			}
		}
		$lang = str_replace( '_', '-', $lang );

		return [ $site, $lang ];
	}

	/**
	 * Merge multiple arrays together.
	 * On encountering duplicate keys, merge the two, but ONLY if they're arrays.
	 * PHP's array_merge_recursive() merges ANY duplicate values into arrays,
	 * which is not fun
	 *
	 * @param array $array1
	 * @param array $array2
	 * @return array
	 */
	private static function arrayMerge( array $array1, array $array2 ) {
		$out = $array1;
		foreach ( $array2 as $key => $value ) {
			if ( isset( $out[$key] ) ) {
				if ( is_array( $out[$key] ) && is_array( $value ) ) {
					// Merge the new array into the existing one
					$out[$key] = self::arrayMerge( $out[$key], $value );
				} elseif ( is_numeric( $key ) ) {
					// A numerical key is taken, append the value at the end instead.
					// It is important that we generally preserve numerical keys and only
					// fallback to appending values if there are conflicts. This is needed
					// by configuration variables that hold associative arrays with
					// meaningul numerical keys, such as $wgNamespacesWithSubpages,
					// $wgNamespaceProtection, $wgNamespacesToBeSearchedDefault, etc.
					$out[] = $value;
				} elseif ( $out[$key] === false ) {
					// A non-numerical key is taken and holds a false value,
					// allow it to be overridden always. This exists mainly for the purpose
					// merging permissions arrays, such as $wgGroupPermissions.
					$out[$key] = $value;
				}
				// Else: The key is already taken and we keep the current value

			} else {
				// Add a new key.
				$out[$key] = $value;
			}
		}

		return $out;
	}
}
