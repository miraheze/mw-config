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
                <td>Please note that there is currently <a href="https://meta.miraheze.org/wiki/Requests_for_Comment/Future_of_Wikicreators">a Request for Comment</a> regarding the future of wiki creators. All users are invited to comment.</td>
                </tr></tbody></table>
EOF;
         }
        return true;
}

