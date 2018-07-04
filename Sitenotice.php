<?php
// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 24;
$snImportant = true; // Set to true if the sitenotice should be show regardless of if wikis want it to be shown

// Write your SiteNotice below.  Comment out this section to disable.
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
        global $wmgSiteNoticeOptOut, $snImportant;
         if ( !$wmgSiteNoticeOptOut || $snImportant ) {
                $siteNotice .= <<<EOF
                <table class="wikitable" style="text-align:center;"><tbody><tr>
                <td>We have switched back to nfs due to complications with swift, which we are fixing. We are running low on disk space which is why we are moving to swift. We appologize for any inconvenience.</td>
                </tr></tbody></table>
EOF;
         }
        return true;
}
