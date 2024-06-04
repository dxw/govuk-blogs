<?php

// Allow WordPress to add feeds in the header
add_theme_support('automatic-feed-links');

// lib/cleanup.php in Roots removes these actions
// Add them back so that the feeds will display in the header
add_action('init', function () {
	add_action('wp_head', 'feed_links', 2);
	add_action('wp_head', 'feed_links_extra', 3);
}, 11);

// Make Atom the default feed
add_filter('default_feed', function () {
	return 'atom';
});

// Do not display non-Atom feeds
add_action('init', function () {
	remove_action('do_feed_rdf', 'do_feed_rdf', 10, 1);
	remove_action('do_feed_rss', 'do_feed_rss', 10, 1);
	remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
});

// Redirect non-Atom feeds
add_action('template_redirect', function () {
	if (is_feed() && !is_feed('atom')) {
		wp_redirect(home_url('/feed/atom/'), 302, 'govuk-blogs theme');
		exit;
	}
});

// Do not display comments feed
add_filter('feed_links_show_comments_feed', function () {
	return false;
});
