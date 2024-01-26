<?php

add_action('init', function () {
    remove_action('wp_enqueue_scripts', 'roots_scripts', 100);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('main', get_template_directory_uri().'/build/main.min.js');
    wp_enqueue_style('main', get_template_directory_uri().'/build/main.min.css');
});

function add_type_attribute($tag, $handle, $src)
{
    // if not your script, do nothing and return original $tag
    if ('main' !== $handle) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute', 10, 3);

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin', get_template_directory_uri().'/build/admin.min.css');
});

add_action('wp_head', function () {
    ?>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
  <?php
});
