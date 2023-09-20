<?php

add_action('init', function () {
    remove_action('wp_enqueue_scripts', 'roots_scripts', 100);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('main', get_template_directory_uri().'/build/main.min.js');
    wp_enqueue_style('main', get_template_directory_uri().'/build/main.min.css');
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin', get_template_directory_uri().'/build/admin.min.css');
});

add_action('wp_head', function () {
    ?>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
  <?php
});

function disable_wp_emojicons()
{

    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');

function disable_emojicons_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, [ 'wpemoji' ]);
    } else {
        return [];
    }
}
