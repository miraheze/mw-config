<?php
// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 22;
$snImportant = true; // Set to true if the sitenotice should be show regardless of if wikis want it to be shown

// Write your SiteNotice below.  Comment out this section to disable.
/*$wg gHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
        global $wmgSiteNoticeOptOut, $snImportant;
         if ( !$wmgSiteNoticeOptOut || $snImportant ) {
                $siteNotice .= <<<EOF
                <table class="wikitable" style="text-align:center;"><tbody><tr>
                <td>At <a href="https://www.timeanddate.com/worldclock/fixedtime.html?msg=Miraheze+upgrades+to+MW+1.31%21&iso=20180617T22&p1=1440">22:00 UTC</a> Miraheze will upgrade its wikis to MediaWiki 1.31. We will set all wikis into read-only mode by 21:30 UTC, so be sure to save your edits before then.</td>
                </tr></tbody></table>
EOF;
         }
        return true;
}
*/
