<?php

require(__DIR__.'/vendor.phar');

roots_require('lib/utils.php');
roots_require('lib/init.php');
roots_require('lib/wrapper.php');
roots_require('lib/sidebar.php');
require(__DIR__.'/lib/config.php');
require(__DIR__.'/lib/activation.php');
roots_require('lib/titles.php');
roots_require('lib/cleanup.php');
roots_require('lib/nav.php');
roots_require('lib/comments.php');
require(__DIR__.'/lib/widgets.php');
require(__DIR__.'/lib/scripts.php');
require(__DIR__.'/lib/custom.php');

require(__DIR__.'/lib/image-licensing.php');
require(__DIR__.'/lib/feeds.php');
require(__DIR__.'/lib/options.php');
require(__DIR__.'/lib/assets.php');
require(__DIR__.'/lib/menus.php');
require(__DIR__.'/lib/excerpt.php');
require(__DIR__.'/lib/featured.php');
require(__DIR__.'/lib/embed.php');
require(__DIR__.'/lib/byline.php');
require(__DIR__.'/lib/sanitise_comments.php');
require(__DIR__.'/lib/icon.php');
require(__DIR__.'/lib/feed-email-widget.php');
require(__DIR__.'/lib/share-icons.php');
require(__DIR__.'/lib/meta.php');
require(__DIR__.'/lib/organisations.php');
require(__DIR__.'/lib/acf.php');
require(__DIR__.'/lib/avatar.php');
require(__DIR__.'/lib/thumbnail.php');
require(__DIR__.'/lib/pagination.php');
require(__DIR__.'/lib/footnotes.php');
require(__DIR__.'/lib/about-widget.php');
require(__DIR__.'/lib/google-maps.php');
require(__DIR__.'/lib/tableau-shortcode.php');
require(__DIR__.'/lib/disable-wptexturize.php');
require(__DIR__.'/lib/co-authors-plus.php');

(new \Dxw\Iguana\Extras\UseAtom())->register();
