<?php
/*
 * This script is intended to function as a standalone utility. It is therefore
 * unaware of MediaWiki and performs its functions accordingly.
 */

class Cleanup {
    /**
     * Static list of all known wikis, used to perform {@see Cleanup::WikiExists()}
     * lookups without performing multiple requests.
     */
    private static array $wikiList;

    /**
     * Simple Curl wrapper solely intended for use by {@see Cleanup::GetWikiList()}.
     */
    private static function CurlGet(array $get): string {
        $ch = curl_init();
        curl_setopt_array( $ch, [
            CURLOPT_URL => 'https://meta.miraheze.org/w/api.php?' . http_build_query($get),
            CURLOPT_USERAGENT => 'Wiki List Generator for mw-config',
            CURLOPT_RETURNTRANSFER => true,
        ] );
        $result = curl_exec($ch);
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
     * @see Cleanup::WikiExists()
     */
    private static function GetWikiList(): array {
        $query = [
            'action' => 'query',
            'format' => 'json',
            'list' => 'wikidiscover',
            'wdlimit' => 'max',
        ];
        $wikis = [];
        $count = 0;

        do {
            $res = json_decode( self::CurlGet( $query ), true );

            if ( $res['query']['wikidiscover']['count'] === 0 ) {
                break;
            }

            $wikis = array_merge( $wikis,  array_keys( $res['query']['wikidiscover']['wikis'] ) );
            $count += $res['query']['wikidiscover']['count'];
            $query['wdoffset'] = $count;
        } while ( true );

        return $wikis;
    }

    /**
     * Returns true if the wiki is known to exist.
     */
    public static function WikiExists( string $dbname ): bool {
        self::$wikiList ??= self::GetWikiList();
        return in_array( $dbname, self::$wikiList, true );
    }

    /**
     * Indicator for whether you are going 'deeper' into a multiline array or function definition.
     * 
     * @todo Curly brackets are broken due to inconsistencies with string interpolation. E.g.
     * The opening bracket of `"{$this->variable}"` is a string token consisting of `"{`,
     * while the closing bracket is a plain string of `}`.
     */
    private static function TokenDepthChange( string|array $token ): int {
        switch ( $token ) {
            //case '{':
            case '[':
                return 1;
            //case '}':
            case ']':
                return -1;
            default:
                return 0;
        }
    }

    /**
     * For the purposes of {@see Cleanup::SeekTokenBlock()} we consider a block to end on a
     * whitespace token containing a newline.
     */
    private static function IsEndingToken( string|array $token ): bool {
        return is_array( $token ) && $token[0] === T_WHITESPACE && str_contains( $token[1], "\n" );
    }

    /**
     * Searches a list of PHP lanugage tokens for a 'block' associated with the search token.
     * A valid block could be `'somewiki' => [ 'someconfig' ],`
     * 
     * @param array $tokens List of PHP language tokens to search through.
     * @param array|string $searchToken Array of format [ T_*CONST, $value ] to search for,
     * an ommitted value will match all valid tokens.
     * @param int $offset Integer offset in array to start search from
     * @return array May be empty.
     */
    private static function SeekTokenBlock( array $tokens, array|string $searchToken, int $offset = 0 ): array {
        $block = [];
        $blockStart = array_find_key( $tokens, function( mixed $token, int $key ) use ( $searchToken, $offset ) {
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
                $depth += self::TokenDepthChange($token);
                if ( $index != 0 && $depth === 0 && self::IsEndingToken( $token ) ) {
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
    private static function ProcessLocalSettings(): void {
        $tokens = token_get_all( file_get_contents( __DIR__ . '/../LocalSettings.php' ) );
        // Narrow our search down explicitly to $wgConf.
        $confTokens = self::SeekTokenBlock( $tokens, [ T_VARIABLE, '$wgConf' ] );
        $conf = [];
        $offsetConf = array_key_first( $confTokens ) + 2; // First item is whitespace, second item is $wgConf.
        // Search through each config option sequentially.
        while ( !empty( $conf = self::SeekTokenBlock( $confTokens, [ T_CONSTANT_ENCAPSED_STRING ], $offsetConf ) ) ) {
            $block = [];
            $offsetBlock = array_key_first( $conf ) + 2; // First item is whitespace, second item is our conf.
            $offsetConf = array_key_last( $conf ) + 1; // Don't repeat on the last item.
            // Search through each wiki identifier in the config.
            while ( !empty( $block = self::SeekTokenBlock( $conf, [ T_CONSTANT_ENCAPSED_STRING ], $offsetBlock ) ) ) {
                // Don't select any whitespace that may be before the wiki identifier.
                $wiki = $block[array_key_first( $block )][0] === T_WHITESPACE ? $block[array_key_first( $block ) + 1][1] : array_first( $block )[1];
                // Wikis will be wrapped in single quotes and may be prepended with a `+`.
                $wiki = trim( $wiki, "'+");
                $offsetBlock = array_key_last( $block ) + 1; // Don't repeat on last item.
                // Only search for wikis, beta not included.
                if ( !str_ends_with( $wiki, 'wiki' ) ) {
                    continue;
                }
                // Delete tokens for any block where the wiki does not exist.
                if ( !self::WikiExists( $wiki ) ) {
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
     * Expected entry point.
     */
    public static function Process(): void {
        self::ProcessLocalSettings();
    }
}

Cleanup::Process();
