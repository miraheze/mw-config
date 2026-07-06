<?php
/*
 * This script is intended to function as a standalone utility. It is therefore
 * unaware of MediaWiki and performs its functions accordingly.
 */

class CleanupMissingWikis {
	/**
	 * Static list of all known wikis, used to perform {@see CleanupMissingWikis::wikiExists()}
	 * lookups without performing multiple requests.
	 */
	private static array $wikiList;

	/**
	 * Simple Curl wrapper solely intended for use by {@see CleanupMissingWikis::getWikiList()}.
	 */
	private static function curlGet( array $get ): string {
		$ch = curl_init();
		curl_setopt_array( $ch, [
			CURLOPT_URL => 'https://meta.miraheze.org/w/api.php?' . http_build_query( $get ),
			CURLOPT_USERAGENT => 'Wiki List Generator for mw-config',
			CURLOPT_RETURNTRANSFER => true,
		] );
		$result = curl_exec( $ch );
		if ( !$result ) {
			trigger_error( curl_error( $ch ) );
		}
		return $result;
	}

	/**
	 * Fetches a list of all Miraheze wikis from the WikiDiscover API.
	 * Should not be called directly.
	 *
	 * Deleted wikis are included in the list, on the chance they might be undeleted.
	 *
	 * @see CleanupMissingWikis::wikiExists()
	 */
	private static function getWikiList(): array {
		$query = [
			'action' => 'query',
			'format' => 'json',
			'list' => 'wikidiscover',
			'wdlimit' => 'max',
		];
		$wikis = [];
		$count = 0;

		do {
			$res = json_decode( self::curlGet( $query ), true );

			if ( $res['query']['wikidiscover']['count'] === 0 ) {
				break;
			}

			$wikis = array_merge( $wikis, array_keys( $res['query']['wikidiscover']['wikis'] ) );
			$count += $res['query']['wikidiscover']['count'];
			$query['wdoffset'] = $count;
		} while ( true );

		return $wikis;
	}

	/**
	 * Returns true if the wiki is known to exist.
	 */
	public static function wikiExists( string $dbname ): bool {
		self::$wikiList ??= self::getWikiList();
		return in_array( $dbname, self::$wikiList, true );
	}

	/**
	 * Indicator for whether you are going 'deeper' into a multiline array or function definition.
	 *
	 * @todo Curly brackets are broken due to inconsistencies with string interpolation. E.g.
	 * The opening bracket of `"{$this->variable}"` is a string token consisting of `"{`,
	 * while the closing bracket is a plain string of `}`.
	 */
	private static function tokenDepthChange( string|array $token ): int {
		switch ( $token ) {
			// case '{':
			case '[':
				return 1;
			// case '}':
			case ']':
				return -1;
			default:
				return 0;
		}
	}

	/**
	 * For the purposes of {@see CleanupMissingWikis::SeekTokenBlock()} we consider a block to end on a
	 * whitespace token containing a newline.
	 */
	private static function isEndingToken( string|array $token ): bool {
		return is_array( $token ) && $token[0] === T_WHITESPACE && str_contains( $token[1], "\n" );
	}

	/**
	 * Contains logic for using `array_find_key` on an array of tokens.
	 * 
	 * @param mixed $token PHP lanugage token to compare.
	 * @param int $key Integer offset of $token in the array being searched.
	 * @param array|string $searchToken An array or exact string to match against the token.
	 * @param int $offset Integer offset to being searching from.
	 * @return bool True if $token and $searchToken are both exactly matching strings or if
	 * the defined components of $searchToken match the $token.
	 */
	private static function tokenSearch( mixed $token, int $key, array|string $searchToken, int $offset = 0 ): bool {
		if ( $key < $offset ) {
			return false;
		}
		// Match strings exactly.
		if ( is_string( $searchToken ) ) {
			return $token === $searchToken;
		}
		if ( is_array( $searchToken ) && is_array( $token ) ) {
			// All empty arrays are a match, in order to grab the next immediate block.
			// Note: we will have skipped all non-array tokens, but this is expected!
			if ( empty( $searchToken ) ) {
				return true;
			}
			return $token[0] === $searchToken[0] && ( !isset( $searchToken[1] ) || $token[1] === $searchToken[1] );
		}
		return false;
	}

	/**
	 * Searches a list of PHP lanugage tokens for a 'block' associated with the search token.
	 * 
	 * A valid block could be `'somewiki' => [ 'someconfig' ],`.
	 *
	 * @param array $tokens List of PHP language tokens to search through.
	 * @param array|string $searchToken Array of format [ T_*CONST, $value ] to search for,
	 * an ommitted value will match all valid tokens.
	 * @param int $offset Integer offset in array to start search from
	 * @return array May be empty.
	 */
	private static function seekTokenBlock( array $tokens, array|string $searchToken, int $offset = 0 ): array {
		$block = [];
		$blockStart = array_find_key( $tokens, static function ( mixed $token, int $key ) use ( $searchToken, $offset ) {
			return self::tokenSearch( $token, $key, $searchToken, $offset );
		} );
		$blockEnd = 0;

		// The only keys we care about are integers, anything else is unexpected,
		// or indicates we didn't find anything.
		if ( is_int( $blockStart ) ) {
			// We want to grab the proceeding whitespace token so we can delete blocks cleanly.
			if (
				$blockStart > array_key_first( $tokens )
				&& is_array( $tokens[$blockStart - 1] )
				&& $tokens[$blockStart - 1][0] === T_WHITESPACE
			) {
				$blockStart -= 1;
			}
			// array_slice works on pure numerical index, ignoring any special keys.
			$blockStart = $blockStart - array_key_first( $tokens );
			$depth = 0;
			// The array slice here loses the keys, meaning our array is now indexed from zero.
			// This allows us to use the ending index ($blockEnd) as a count.
			foreach ( array_slice( $tokens, $blockStart ) as $index => $token ) {
				$depth += self::TokenDepthChange( $token );
				if ( $index != 0 && $depth === 0 && self::isEndingToken( $token ) ) {
					$blockEnd = $index;
					break;
				}
			}
			// By not incrementing $blockEnd by one, we don't include the ending token (whitespace with a newline)
			$block = array_slice( $tokens, $blockStart, $blockEnd, true );
		}
		return $block;
	}

	/**
	 * Processes cleanup for LocalSettings.php.
	 */
	private static function processLocalSettings(): void {
		$tokens = token_get_all( file_get_contents( __DIR__ . '/../LocalSettings.php' ) );
		// Narrow our search down explicitly to $wgConf.
		$confTokens = self::seekTokenBlock( $tokens, [ T_VARIABLE, '$wgConf' ] );
		$conf = [];
		// First item is whitespace, second item is $wgConf.
		$offsetConf = array_key_first( $confTokens ) + 2;
		// Search through each config option sequentially.
        // phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
		while ( !empty( $conf = self::seekTokenBlock( $confTokens, [ T_CONSTANT_ENCAPSED_STRING ], $offsetConf ) ) ) {
			$block = [];
			// First item is whitespace, second item is our conf.
			$offsetBlock = array_key_first( $conf ) + 2;
			// Don't repeat on the last item.
			$offsetConf = array_key_last( $conf ) + 1;
			// Search through each wiki identifier in the config.
            // phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
			while ( !empty( $block = self::seekTokenBlock( $conf, [ T_CONSTANT_ENCAPSED_STRING ], $offsetBlock ) ) ) {
				// Don't select any whitespace that may be before the wiki identifier.
				$wiki = $block[array_key_first( $block )][0] === T_WHITESPACE ? $block[array_key_first( $block ) + 1][1] : array_first( $block )[1];
				// Wikis will be wrapped in single quotes and may be prepended with a `+`.
				$wiki = trim( $wiki, "'+" );
				// Don't repeat on last item.
				$offsetBlock = array_key_last( $block ) + 1;
				// Only search for wikis, beta not included.
				if ( !str_ends_with( $wiki, 'wiki' ) ) {
					continue;
				}
				// Delete tokens for any block where the wiki does not exist.
				if ( !self::wikiExists( $wiki ) ) {
					foreach ( $block as $index => $_ ) {
						$tokens[$index] = '';
					}
				}
			}
		}
		// Convert tokens back into source code.
		$content = "";
		foreach ( $tokens as $token ) {
			if ( is_array( $token ) ) {
				$content .= $token[1];
			} else {
				$content .= $token;
			}
		}
		file_put_contents( __DIR__ . '/../LocalSettings.php', $content );
	}

	/**
	 * Seeks a block of tokens explicitly defined by T_CASE and T_BREAK as the start and end of the block.
	 * 
	 * It is important to note that the logic for this function and {@see CleanupMissingWikis::seekTokenBlock()}
	 * are not interchangable.
	 * 
	 * @param array $tokens Array of PHP language tokens to search.
	 * @param int $offset Integer offset to begin searching from.
	 * @return array May be empty if no block is found.
	 */
	private static function seekCaseBlock( array $tokens, int $offset = 0 ): array {
		$block = [];
		$blockStart = array_find_key( $tokens, static function ( mixed $token, int $key ) use ( $offset ) {
			return self::tokenSearch( $token, $key, [ T_CASE ], $offset );
		} );
		$blockEnd = 0;

		// The only keys we care about are integers, anything else is unexpected,
		// or indicates we didn't find anything.
		if ( is_int( $blockStart ) ) {
			// We want to grab the proceeding whitespace token so we can delete blocks cleanly.
			if (
				$blockStart > array_key_first( $tokens )
				&& is_array( $tokens[$blockStart - 1] )
				&& $tokens[$blockStart - 1][0] === T_WHITESPACE
			) {
				$blockStart -= 1;
			}
			$blockEnd = array_find_key( $tokens, static function ( mixed $token, int $key ) use ( $blockStart ) {
				return self::tokenSearch( $token, $key, [ T_BREAK ], $blockStart + 2 ) || self::tokenSearch( $token, $key, [ T_CASE ], $blockStart + 2 );
			} ) ?? 0;
			if ( $blockEnd > 0 ) {
				// If we end on another case, don't include it (or the newline). If we end on a break, include the semicolon.
				$blockEnd += $tokens[$blockEnd][0] === T_CASE ? -2 : 1;
				// array_slice works on pure numerical index, ignoring any special keys.
				$blockEnd = $blockEnd - array_key_first( $tokens );
			}
			// array_slice works on pure numerical index, ignoring any special keys.
			$blockStart = $blockStart - array_key_first( $tokens );
			$block = array_slice( $tokens, $blockStart, $blockEnd - $blockStart + 1, true );
		}
		return $block;
	}

	/**
	 * Perform cleanup for LocalWiki.php.
	 */
	private static function processLocalWiki(): void{
		$tokens = token_get_all( file_get_contents( __DIR__ . '/../LocalWiki.php' ) );
		$case = [];
		$offset = 0;
		// phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
		while( !empty( $case = self::seekCaseBlock( $tokens, $offset ) ) ) {
			// Case statements are T_WHITESPACE T_CASE T_WHITESPACE 'wiki':
			$wiki = $case[array_key_first( $case ) + 3][1];
			$wiki = trim( $wiki, '\'"');
			$offset += count( $case );
			// Only search for wikis, beta not included.
			if ( !str_ends_with( $wiki, 'wiki' ) ) {
				continue;
			}
			// Delete tokens for any block where the wiki does not exist.
			if ( !self::wikiExists( $wiki ) ) {
				foreach ( $case as $index => $_ ) {
					$tokens[$index] = '';
				}
			}
		}
		// Convert tokens back into source code.
		$content = "";
		foreach ( $tokens as $token ) {
			if ( is_array( $token ) ) {
				$content .= $token[1];
			} else {
				$content .= $token;
			}
		}
		file_put_contents( __DIR__ . '/../LocalWiki.php', $content );
	}

	/**
	 * Expected entry point.
	 */
	public static function process(): void {
		self::processLocalSettings();
		self::processLocalWiki();
	}
}

CleanupMissingWikis::process();
