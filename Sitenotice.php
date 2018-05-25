<?php
// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 21;
$snImportant = true; // Set to true if the sitenotice should be show regardless of if wikis want it to be shown

// Write your SiteNotice below.  Comment out this section to disable.
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
        global $wmgSiteNoticeOptOut, $snImportant;
         if ( !$wmgSiteNoticeOptOut || $snImportant ) {
                $siteNotice .= <<<EOF
                <table class="wikitable" style="text-align:center;"><tbody><tr>
                <td>CookieWarning is now enabled to comply with the General Data Protection Regulation (GDPR). If you are having issues logging into your wiki, and it has a custom domain, then please try clearing your cookies/cache. If the issue persists, then please contact us on <a href="https://phabricator.miraheze.org">phabricator</a>.<br/>
                Due to the General Data Protection Regulation (GDPR), Miraheze has a new <a href="https://meta.miraheze.org/wiki/Privacy_Policy">Privacy Policy</a> effective as of today.</td>
                </tr></tbody></table>
EOF;
         }
        return true;
}
