<?php

// Keep this at a bare minimum because we don't need to use MW's default configurations
$wgCSPHeader = [
	'useNonces' => false,
];

/**
 * Domains that are essential to the operation of the farm and are therefore
 * always present in the CSP of every wiki. Cannot be removed via ManageWiki.
 */
$wgMirahezeMagicCSPHeaderEssential = [
	'default-src' => [
		"'self'",
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
	],
	'script-src' => [
		'blob:',
		"'self'",
		"'unsafe-inline'",
		"'unsafe-eval'",
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
		'hcaptcha.com',
		'*.hcaptcha.com',
	],
	'style-src' => [
		"'self'",
		'data:',
		"'unsafe-inline'",
		'miraheze.org',
		'wikitide.org',
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
		'hcaptcha.com',
		'*.hcaptcha.com',
	],
	'img-src' => [
		'blob:',
		"'self'",
		'data:',
		'miraheze.org',
		'wikitide.org',
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
	],
	'font-src' => [
		"'self'",
		'data:',
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
	],
	'media-src' => [
		"'self'",
		'blob:',
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
	],
	'frame-src' => [
		"'self'",
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
		'hcaptcha.com',
		'*.hcaptcha.com',
	],
	'connect-src' => [
		"'self'",
		'blob:',
		'*.miraheze.org',
		'*.wikitide.org',
		'*.wikitide.net',
		'hcaptcha.com',
		'*.hcaptcha.com',
	],
];

/**
 * Third party services a wiki can allow content from.
 *
 * The key must be stable. The label is what gets shown on ManageWiki
 */
$wgMirahezeMagicCSPServices = [
	'adobe-fonts' => [
		'label' => 'Adobe Fonts (use.typekit.net)',
		'sources' => [
			'style-src' => [
				'use.typekit.net',
			],
			'font-src' => [
				'use.typekit.net',
			],
		],
	],
	'bandcamp' => [
		'label' => 'Bandcamp',
		'sources' => [
			'script-src' => [
				'bandcamp.com',
			],
			'media-src' => [
				'bandcamp.com',
			],
			'frame-src' => [
				'bandcamp.com',
			],
		],
	],
	'bing' => [
		'label' => 'Bing',
		'sources' => [
			'frame-src' => [
				'www.bing.com',
			],
		],
	],
	'blender' => [
		'label' => 'Blender (docs.blender.org)',
		'sources' => [
			'img-src' => [
				'docs.blender.org',
			],
		],
	],
	'bootstrapcdn' => [
		'label' => 'Bootstrap (maxcdn.bootstrapcdn.com)',
		'sources' => [
			'img-src' => [
				'maxcdn.bootstrapcdn.com',
			],
		],
	],
	'cloudflare' => [
		'label' => 'Cloudflare',
		'sources' => [
			'script-src' => [
				'ajax.cloudflare.com',
				'cdnjs.cloudflare.com',
			],
			'style-src' => [
				'cdnjs.cloudflare.com',
			],
			'font-src' => [
				'cdnjs.cloudflare.com',
			],
			'connect-src' => [
				'1.1.1.1',
			],
		],
	],
	'cloudflare-turnstile' => [
		'label' => 'Cloudflare Turnstile',
		'sources' => [
			'script-src' => [
				'challenges.cloudflare.com',
			],
			'frame-src' => [
				'challenges.cloudflare.com',
			],
		],
	],
	'creative-commons' => [
		'label' => 'Creative Commons (mirrors.creativecommons.org)',
		'sources' => [
			'img-src' => [
				'mirrors.creativecommons.org',
			],
		],
	],
	'discord' => [
		'label' => 'Discord',
		'sources' => [
			'img-src' => [
				'cdn.discordapp.com',
				'discordapp.com',
			],
			'frame-src' => [
				'discord.com',
				'discordapp.com',
			],
			'connect-src' => [
				'discord.com',
				'discordapp.com',
			],
		],
	],
	'dropbox' => [
		'label' => 'Dropbox (image embeds from dropboxstatic.com)',
		'sources' => [
			'img-src' => [
				'*.dropboxstatic.com',
			],
		],
	],
	'facebook' => [
		'label' => 'Facebook (image embeds from fbcdn.net)',
		'sources' => [
			'img-src' => [
				'*.fbcdn.net',
			],
		],
	],
	'fastly' => [
		'label' => 'Fastly',
		'sources' => [
			'img-src' => [
				'*.fastly.net',
			],
		],
	],
	'font-awesome' => [
		'label' => 'Font Awesome',
		'sources' => [
			'img-src' => [
				'*.fontawesome.com',
			],
		],
	],
	'geogebra' => [
		'label' => 'GeoGebra (image embeds from cdn.geogebra.org)',
		'sources' => [
			'img-src' => [
				'cdn.geogebra.org',
			],
		],
	],
	'gnu' => [
		'label' => 'GNU (image embeds from www.gnu.org)',
		'sources' => [
			'img-src' => [
				'www.gnu.org',
			],
		],
	],
	'gofundme' => [
		'label' => 'GoFundMe (iframe embeds from www.gofundme.com)',
		'sources' => [
			'frame-src' => [
				'www.gofundme.com',
			],
		],
	],
	'google' => [
		'label' => 'Google (various Google services)',
		'sources' => [
			'script-src' => [
				'www.google.com',
				'www.gstatic.com',
				'apis.google.com',
			],
			'style-src' => [
				'www.gstatic.com',
			],
			'img-src' => [
				'maps.google.com',
				'www.gstatic.com',
				'*.googleusercontent.com',
				'storage.googleapis.com',
			],
			'media-src' => [
				'apis.google.com',
			],
			'frame-src' => [
				'www.google.com',
				'docs.google.com',
				'apis.google.com',
				'calendar.google.com',
				'drive.google.com',
			],
			'connect-src' => [
				'storage.googleapis.com',
				'translate.googleapis.com',
			],
		],
	],
	'google-fonts' => [
		'label' => 'Google Fonts',
		'sources' => [
			'style-src' => [
				'fonts.googleapis.com',
			],
			'font-src' => [
				'fonts.googleapis.com',
				'fonts.gstatic.com',
			],
		],
	],
	'imgbb' => [
		'label' => 'ImgBB',
		'sources' => [
			'img-src' => [
				'imgbb.com',
				'*.imgbb.com',
				'simgbb.com',
				'*.simgbb.com',
				'ibb.co',
				'*.ibb.co',
			],
		],
	],
	'imgbox' => [
		'label' => 'imgbox',
		'sources' => [
			'img-src' => [
				'*.imgbox.com',
			],
		],
	],
	'imgur' => [
		'label' => 'Imgur',
		'sources' => [
			'img-src' => [
				'i.imgur.com',
			],
		],
	],
	'instatus' => [
		'label' => 'Instatus',
		'sources' => [
			'frame-src' => [
				'*.instatus.com',
			],
			'connect-src' => [
				'*.instatus.com',
			],
		],
	],
	'internet-archive' => [
		'label' => 'Internet Archive',
		'sources' => [
			'frame-src' => [
				'archive.org',
			],
		],
	],
	'jsdelivr' => [
		'label' => 'jsDelivr',
		'sources' => [
			'script-src' => [
				'cdn.jsdelivr.net',
				'fastly.jsdelivr.net',
			],
			'style-src' => [
				'cdn.jsdelivr.net',
				'fastly.jsdelivr.net',
			],
			'img-src' => [
				'cdn.jsdelivr.net',
			],
			'font-src' => [
				'cdn.jsdelivr.net',
				'fastly.jsdelivr.net',
			],
			'media-src' => [
				'cdn.jsdelivr.net',
			],
			'connect-src' => [
				'cdn.jsdelivr.net',
				'fastly.jsdelivr.net',
			],
		],
	],
	'libera-chat' => [
		'label' => 'Libera Chat',
		'sources' => [
			'frame-src' => [
				'web.libera.chat',
			],
		],
	],
	'lucid' => [
		'label' => 'Lucid Chart (iframe embeds from lucid.app)',
		'sources' => [
			'frame-src' => [
				'lucid.app',
			],
		],
	],
	'minecraft-wiki' => [
		'label' => 'Minecraft Wiki (image embeds from minecraft.wiki)',
		'sources' => [
			'img-src' => [
				'minecraft.wiki',
			],
		],
	],
	'minotar' => [
		'label' => 'Minotar (image embeds from minotar.net)',
		'sources' => [
			'img-src' => [
				'minotar.net',
			],
		],
	],
	'mc-heads' => [
		'label' => 'MC Heads (image embeds from mc-heads.net)',
		'sources' => [
			'img-src' => [
				'mc-heads.net',
			],
		],
	],
	'newspapers-com' => [
		'label' => 'newspapers.com (image embeds)',
		'sources' => [
			'img-src' => [
				'img.newspapers.com',
			],
		],
	],
	'niconico' => [
		'label' => 'Niconico',
		'sources' => [
			'media-src' => [
				'embed.nicovideo.jp',
			],
			'frame-src' => [
				'embed.nicovideo.jp',
			],
		],
	],
	'onlinewebfonts' => [
		'label' => 'OnlineWebFonts',
		'sources' => [
			'img-src' => [
				'db.onlinewebfonts.com',
			],
			'font-src' => [
				'db.onlinewebfonts.com',
			],
		],
	],
	'openlayers' => [
		'label' => 'OpenLayers',
		'sources' => [
			'script-src' => [
				'openlayers.org',
			],
			'img-src' => [
				'openlayers.org',
			],
		],
	],
	'openstreetmap' => [
		'label' => 'OpenStreetMap',
		'sources' => [
			'img-src' => [
				'tile.openstreetmap.org',
				'*.tile.openstreetmap.org',
			],
		],
	],
	'pixabay' => [
		'label' => 'Pixabay (cdn.pixabay.com)',
		'sources' => [
			'img-src' => [
				'cdn.pixabay.com',
			],
		],
	],
	'postimage' => [
		'label' => 'PostImage',
		'sources' => [
			'img-src' => [
				'postimages.org',
				'*.postimages.org',
				'postimgs.org',
				'*.postimgs.org',
				'postimg.cc',
				'*.postimg.cc',
			],
		],
	],
	'reddit' => [
		'label' => 'Reddit (image embeds)',
		'sources' => [
			'img-src' => [
				'*.redd.it',
				'*.redditmedia.com',
			],
		],
	],
	'roblox' => [
		'label' => 'Roblox',
		'sources' => [
			'img-src' => [
				'*.rbxcdn.com',
			],
			'connect-src' => [
				'games.roblox.com',
				'economy.roblox.com',
			],
		],
	],
	'scratch' => [
		'label' => 'Scratch (scratch.mit.edu)',
		'sources' => [
			'frame-src' => [
				'scratch.mit.edu',
			],
		],
	],
	'snap' => [
		'label' => 'Snap! (snap.berkeley.edu)',
		'sources' => [
			'frame-src' => [
				'snap.berkeley.edu',
			],
		],
	],
	'soundcloud' => [
		'label' => 'SoundCloud (iframe embeds from w.soundcloud.com)',
		'sources' => [
			'frame-src' => [
				'w.soundcloud.com',
			],
		],
	],
	'spotify' => [
		'label' => 'Spotify (iframe embeds from open.spotify.com)',
		'sources' => [
			'frame-src' => [
				'open.spotify.com',
			],
		],
	],
	'steam' => [
		'label' => 'Steam',
		'sources' => [
			'frame-src' => [
				'video.fastly.steamstatic.com',
				'shared.fastly.steamstatic.com',
			],
			'connect-src' => [
				'api.steampowered.com',
			],
		],
	],
	'tally' => [
		'label' => 'tally.so',
		'sources' => [
			'script-src' => [
				'tally.so',
			],
			'frame-src' => [
				'tally.so',
			],
		],
	],
	'the-movie-database' => [
		'label' => 'The Movie Database (image embeds from image.tmdb.org)',
		'sources' => [
			'img-src' => [
				'image.tmdb.org',
			],
		],
	],
	'twitch' => [
		'label' => 'Twitch',
		'sources' => [
			'media-src' => [
				'player.twitch.tv',
				'clips.twitch.tv',
			],
			'frame-src' => [
				'player.twitch.tv',
				'clips.twitch.tv',
			],
		],
	],
	'twitter' => [
		'label' => 'Twitter',
		'sources' => [
			'script-src' => [
				'platform.twitter.com',
				'cdn.syndication.twimg.com',
			],
			'style-src' => [
				'platform.twitter.com',
				'ton.twimg.com',
			],
			'img-src' => [
				'*.twimg.com',
				'platform.twitter.com',
				'syndication.twitter.com',
			],
			'frame-src' => [
				'platform.twitter.com',
				'syndication.twitter.com',
			],
		],
	],
	'vimeo' => [
		'label' => 'Vimeo',
		'sources' => [
			'media-src' => [
				'player.vimeo.com',
			],
			'frame-src' => [
				'player.vimeo.com',
			],
		],
	],
	'wikimedia-base' => [
		'label' => 'Wikimedia Meta, Wikimedia Commons, Wikipedia, and MediaWiki.org',
		'sources' => [
			'script-src' => [
				'*.wikimedia.org',
				'*.wikipedia.org',
				'mediawiki.org',
				'*.mediawiki.org',
			],
			'style-src' => [
				'*.wikimedia.org',
				'*.wikipedia.org',
				'mediawiki.org',
				'*.mediawiki.org',
			],
			'img-src' => [
				'wikimedia.org',
				'upload.wikimedia.org',
				'thumb.wikimedia.org',
			],
			'font-src' => [
				'upload.wikimedia.org',
			],
			'media-src' => [
				'upload.wikimedia.org',
			],
			'connect-src' => [
				'*.wikimedia.org',
				'*.wikipedia.org',
				'www.mediawiki.org',
			],
		],
	],
	'wikimedia-full' => [
		'label' => 'Wikimedia wikis (full range of wikis)',
		'sources' => [
			'script-src' => [
				'*.wikimedia.org',
				'*.wikipedia.org',
				'*.wikibooks.org',
				'*.wiktionary.org',
				'*.wikiquote.org',
				'*.wikisource.org',
				'*.wikiversity.org',
				'*.wikinews.org',
				'*.wikivoyage.org',
				'mediawiki.org',
				'*.mediawiki.org',
				'wikidata.org',
			],
			'style-src' => [
				'*.wikimedia.org',
				'*.wikipedia.org',
				'*.wikibooks.org',
				'*.wiktionary.org',
				'*.wikiquote.org',
				'*.wikisource.org',
				'*.wikiversity.org',
				'*.wikinews.org',
				'*.wikivoyage.org',
				'mediawiki.org',
				'*.mediawiki.org',
				'wikidata.org',
			],
			'img-src' => [
				'wikimedia.org',
				'upload.wikimedia.org',
				'thumb.wikimedia.org',
			],
			'font-src' => [
				'upload.wikimedia.org',
			],
			'media-src' => [
				'upload.wikimedia.org',
			],
			'frame-src' => [
				'query.wikidata.org',
			],
			'connect-src' => [
				'*.wikimedia.org',
				'*.wikipedia.org',
				'*.wikinews.org',
				'*.wiktionary.org',
				'www.mediawiki.org',
				'www.wikidata.org',
			],
		],
	],
	'youtube' => [
		'label' => 'YouTube',
		'sources' => [
			'script-src' => [
				'www.youtube.com',
			],
			'img-src' => [
				'i.ytimg.com',
			],
			'media-src' => [
				'*.youtube.com',
				'*.youtube-nocookie.com',
			],
			'frame-src' => [
				'www.youtube.com',
				'*.youtube-nocookie.com',
			],
			'connect-src' => [
				'*.youtube-nocookie.com',
			],
		],
	],
];

/**
 * Services that an extension cannot work without.
 */
$wgMirahezeMagicCSPHeaderExtensionServices = [
	'EmbedSpotify' => [
		'spotify',
	],
	// We don't know which sites a wiki wants to embed videos from, so enable all of them?
	'EmbedVideo' => [
		'bandcamp',
		'internet-archive',
		'niconico',
		'soundcloud',
		'spotify',
		'twitch',
		'vimeo',
		'youtube',
	],
	'GeoGebra' => [
		'geogebra',
	],
	'GoogleDocs4MW' => [
		'google',
	],
	'GoogleForms' => [
		'google',
	],
	'Kartographer' => [
		'openstreetmap',
	],
	'Maps' => [
		'openstreetmap',
		// Google Maps is blocked by the current CSP
	],
	// For image embeds. connect-src not required for the extension.
	'RobloxAPI' => [
		'roblox',
	],
	'Snap! Project Embed' => [
		'snap',
	],
	'WebChat' => [
		'libera-chat',
	],
];

/**
 * Services enabled by default on new wikis that never touched ManageWiki settings.
 */
$wgMirahezeMagicCSPEnabledServicesDefault = [
	'cloudflare',
	'discord',
	'font-awesome',
	'google-fonts',
	'jsdelivr',
	'wikimedia-base',
];

// Add mirabeta.org and nexttide.org to beta
if ( $wi->isBeta() ) {
	foreach ( $wgMirahezeMagicCSPHeaderEssential as $key => $value ) {
		$wgMirahezeMagicCSPHeaderEssential[$key][] = '*.nexttide.org';
		$wgMirahezeMagicCSPHeaderEssential[$key][] = '*.mirabeta.org';
	}
}

// This is the old, hard-coded CSP header. Kept here for compatibility purposes.
// It simply adds all possible services into the CSP to reobtain the full CSP.
$wgMirahezeMagicCSPHeaderDefault = $wgMirahezeMagicCSPHeaderEssential;
foreach ( $wgMirahezeMagicCSPServices as $service ) {
	foreach ( $service['sources'] as $directive => $domains ) {
		$wgMirahezeMagicCSPHeaderDefault[$directive] = array_values( array_unique(
			array_merge( $wgMirahezeMagicCSPHeaderDefault[$directive] ?? [], $domains )
		) );
	}
}

// Per-wiki Content Security Policy additions
switch ( $wgDBname ) {
	case 'exttestwikibeta':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'script-src' => [
				'example.com',
			],
		];
		break;
	case 'actewiki':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'script-src' => [
				'flo.uri.sh',
			],
		];
		break;
	case 'cloudstreamwiki':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'img-src' => [
				'hosted.weblate.org',
			],
		];
		break;
	case 'jwikiwiki':
	case 'jwmeetingwiki':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'img-src' => [
				'cms-imgp.jw-cdn.org',
			],
		];
		break;
	case 'smutstonewiki':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'img-src' => [
				'cdn.smutstone.com',
			],
		];
		break;
	case 'ss14uawiki':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'connect-src' => [
				'ss14.com.ua',
			],
		];
		break;
	case 'wowlibrarywiki':
		$wgMirahezeMagicCSPHeaderOverrides = [
			'script-src' => [
				'www.wowhead.com',
			],
			'connect-src' => [
				'www.wowhead.com',
			],
		];
		break;
	default:
		break;
}
