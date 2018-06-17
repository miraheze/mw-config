<?php
// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 22;
$snImportant = true; // Set to true if the sitenotice should be show regardless of if wikis want it to be shown

// Write your SiteNotice below.  Comment out this section to disable.
/*$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
        global $wmgSiteNoticeOptOut, $snImportant;
         if ( !$wmgSiteNoticeOptOut || $snImportant ) {
                $siteNotice .= <<<EOF
                <table class="wikitable" style="text-align:center;"><tbody><tr>
                <td>In order to apply security patches to our database server, wikis will be read-only after 20:00 UTC and wikis will be unavailable for a few minutes after this time. Apologies in advance for the inconvenience.</td>
                </tr></tbody></table>
EOF;
         }
        return true;
}*/


function onSiteNoticeAfter( &$siteNotice, $skin ) {
        global $wmgSiteNoticeOptOut, $snImportant;
         if ( !$wmgSiteNoticeOptOut || $snImportant ) {
                $siteNotice .= <<<EOF
<style>

@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  src: local('Montserrat'), local('Montserrat'), url(https://upload.wikimedia.org/wikipedia/donate/c/cd/Montserrat.woff2) format('woff2');}

/* Main banner container. Banner: background gradient, border colour and width and adding a margin between banner and article header*/
/* Important -- background gradient -- If you change one you must change all*/
.cnotice {
    position: relative;
    overflow: hidden;
    background: #FCFCFC;
    border: 1px solid #999999;
    border-radius: 2px;
    margin-bottom: 1em;
    cursor: pointer;
    color: #222;
    font-weight: 500;
}

/* Sets the minimum banner height. If img + logo-container margins > height. Banner will be larger*/
#cnotice-main {
    display: table;
    width: 100%;
    height: 80px; /* need to set height for height 100% to work on elements within it */
}

/*MOBILE - Adjust mobile height of banner*/
body.skin-minerva #cnotice-main {
    height: 100px;
}

/*IMPORTANT - don't touch*/
.cnotice-message-container,
.cnotice-logo-container,
.cnotice-misc-container {
    display: table-cell;
    height: 100%;
    vertical-align: middle;
}

/* --- Main message --- */
.cnotice-message {
    position: relative;
    margin: 0;
    line-height: 1.2;
    padding: 5px 5px 5px 5px;
}

@media (min-width: 1200px) {
    .cnotice-message {
         padding: 15px 0px 11px 30px;
    }
}

body.rtl .cnotice-message {
    padding: 5px 5px 5px 5px;
}

.cnotice-message p {
    margin: 0;
    color: #4D4D4D;
    font-family: Arial, sans-serif;
    font-weight: bold;
    font-size: 100%;
    opacity: 1;
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
}

@media (min-width: 1200px) {
    .cnotice-message p { font-size: 120%; }
}


/* --- Logo Image text --- */
.cnotice-logo-container {
    width: 10%;
}

body.rtl .cnotice-logo-container {
    padding: 0.0em .25em 0.0em .9em;
}

.cnotice-logo-container img {
    opacity: 1;
    display: block;
    margin-left: 15%;
    margin-top: 2px;
    margin-bottom: 1px;
    height: 55px;
}

/*Misc containter stuff starts here*/
.cnotice-misc-container {
    width: 10%;
    padding-right: 40px;
}

/*Adjusts for screen size */
@media (min-width: 1200px) {
    .cnotice-misc-container {
         padding-right: 40px;
    }
}

/*Detects and adjusts for mobile skin */
body.skin-minerva .cnotice-misc-container {
    padding-right: 10px;
}


/* --- Close Options --- */

#cnotice-toggle-box-options {
    display: table-cell;
    font-size: .8em;
    text-transform: uppercase;
    width: 38px;
    height: 38px;

    background: #eee;
    -moz-border-radius: 19px;
    -webkit-border-radius: 19px;
    border-radius: 19px;
    vertical-align: middle;
}

#cnotice-toggle-box {
    cursor: pointer;
    position: absolute;
    top: 2px;
    right: 3px;
    z-index: 1;
}

body.rtl #cnotice-toggle-box {
    left: 3px;
    right: unset;
}

#cnotice-toggle-box:hover { 
    opacity: 1;
}

/* --- Full Banner Link --- */
.cnotice a.cnotice-full-banner-click {
    display: block;
    height: 100%;
    width: 100%;
    cursor: pointer;
    text-decoration: none;
}

.cnotice a.cnotice-full-banner-click:hover {
    text-decoration: underline;
}

.cnotice-button {
    border: none;
    display: inline-block;
    border: solid 2px #36c;
    border-radius: 4px;
    color: #fff;
    padding: 5px 5px;
    text-align: center;
    font-weight: bold;
    text-decoration: none;
    font-size: 14px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
    z-index: 1;
    min-width: 80px;
}

@media (min-width: 1100px) {
    .cnotice-button {
        display: inline-block;
        min-width: 110px;
        width: 25%;
        margin: auto;
    }
}

/* --- Buttons --- */
.cnotice a.cnotice-buttonlink {
    cursor: pointer;
    text-decoration: none;
    color: #000;
}

.cnotice a.cnotice-buttonlink:hover {
    color: #fff;
}

.cnotice-button1 {
    background-color: #36c;
    color: #fff;
}

.rtl .cnotice-button1 {
    left: 23px;
    right: auto;
    margin-left: 20px;
}

.cnotice-button1:hover {
    background-color: #447ff5;
}

.cnotice-button1:active {
    background-color: #2a4b8d;
}

#cnotice-translation-link {
    position: absolute;
    right: 50px;
    bottom: 0px;
    font-size: 0.8em;
    white-space: nowrap;
}

#cnotice-translation-link:hover {
    text-decoration: underline;
}

.rtl #cnotice-translation-link {
    text-align: left;
    left: 95px;
}
</style>

<div class="cnotice" id="{{{banner}}}">
        <div id="cnotice-main">
            <div class="cnotice-logo-container">
                <img src="//static.miraheze.org/metawiki/3/35/Miraheze_Logo.svg" alt="Banner logo">
            </div>
            <div class="cnotice-message-container">
                <div class="cnotice-message">
                    <p>At 22:00 UTC Miraheze will upgrade its wikis to MediaWiki 1.31. During this time all wikis will be put into read-only mode, so be sure to save your edits before 20:30 UTC when the read-only will be set.</p>
                </div>
            </div>
        </div>
    <div id="cnotice-toggle-box">
        <a href="#" title="Hide" onclick="mw.centralNotice.hideBanner();return false;"><img border="0" src="//upload.wikimedia.org/wikipedia/donate/a/ac/Close_oojs.png" alt="Hide" /></a>
    </div>
</div>
EOF;
         }
        return true;
}
