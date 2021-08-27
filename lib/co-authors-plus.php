<?php

add_filter('coauthors_auto_apply_template_tags', function () {
    return true;
});

add_action('init', function () {
    remove_filter('the_author', [$GLOBALS['coauthors_plus_template_filters'], 'filter_the_author']);
}, 100);

add_filter('the_author', function ($author) {
    if (is_feed('atom')) {
        return esc_html($author);
    }
    return $author;
}, 20);
