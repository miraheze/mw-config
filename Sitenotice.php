<?php
// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 26;
$snImportant = false; // Set to true if the sitenotice should be show regardless of if wikis want it to be shown

// Write your SiteNotice below.  Comment out this section to disable.
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
        global $wmgSiteNoticeOptOut, $snImportant;
         if ( !$wmgSiteNoticeOptOut || $snImportant ) {
                $siteNotice .= <<<EOF
                <table class="wikitable" style="text-align:center;"><tbody><tr>
                <td>Please note that <a href="https://meta.miraheze.org/wiki/Requests_for_Comment/Interwiki_links_editing">a Request for Comment</a> regarding interwiki editing, as well as <a href="https://meta.miraheze.org/wiki/Requests for global rights">two requests for CVT</a>. All users are invited to comment.</td>
                </tr></tbody></table>
EOF;
         }
        return true;
}
