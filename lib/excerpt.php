<?php

# Remove the default Roots excerpt handler...
add_action('init', function () {
	remove_filter('excerpt_more', 'roots_excerpt_more');
});

# ...and add a nicer one
add_filter('excerpt_more', function ($more) {
	return ' …';
});

# Ensure manual excerpts are trimmed to the default 55 words
add_filter('get_the_excerpt', function ($excerpt) {
	return wp_trim_words($excerpt, 55, ' …');
});
