<?php

add_action('init', function () {
	remove_action('wp_enqueue_scripts', 'roots_scripts', 100);
});

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('main', get_template_directory_uri().'/build/main.min.js', ['jquery']);
	wp_enqueue_script('govuk-frontend', get_template_directory_uri().'/build/govuk-frontend-load.js');
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

add_filter('wp_script_attributes', 'addScriptTypeToJs', 10, 1);

function addScriptTypeToJs($attr)
{
	if (empty($attr['id']) || empty($attr['src'])) {
		return $attr;
	}

	if ($attr['id'] === 'govuk-frontend-js') {
		$attr['type'] = 'module';
	}

	return $attr;
}
