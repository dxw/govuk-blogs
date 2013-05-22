<?php
// Roots uses locate_template() to import /lib/activation.php, so this doesn't need to be included by functions.php

/**
 * Enable theme features
 */
# add_theme_support('root-relative-urls');    // Enable relative URLs
# add_theme_support('rewrites');              // Enable URL rewrites
# add_theme_support('h5bp-htaccess');         // Enable HTML5 Boilerplate's .htaccess
# add_theme_support('bootstrap-top-navbar');  // Enable Bootstrap's top navbar
# add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
# add_theme_support('nice-search');           // Enable /?s= to /search/ redirect
# add_theme_support('jquery-cdn');            // Enable to load jQuery from the Google CDN

/**
 * Configuration values
 */

# Note: GDS can't use this because of special embed code for Analytics. See lib/scripts.php.
define('GOOGLE_ANALYTICS_ID', ''); // UA-XXXXX-Y

define('POST_EXCERPT_LENGTH', 40);

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 940px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 620; }
