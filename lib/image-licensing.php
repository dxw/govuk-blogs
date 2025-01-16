<?php

global $gds_image_licences;

$gds_image_licences = [
	'ogl' => [
		'name' => 'OGL',
		'link' => 'https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/',
		'display' => false,
	],
	'cc-by' => [
		'name' => 'Creative Commons Attribution',
		'link' => 'https://creativecommons.org/licenses/by/4.0/',
		'display' => true,
	],
	'cc-by-sa' => [
		'name' => 'Creative Commons Attribution-ShareAlike',
		'link' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'display' => true,
	],
	'cc-by-nd' => [
		'name' => 'Creative Commons Attribution-NoDerivs',
		'link' => 'https://creativecommons.org/licenses/by-nd/4.0/',
		'display' => true,
	],
	'cc-by-nc' => [
		'name' => 'Creative Commons Attribution-NonCommercial',
		'link' => 'https://creativecommons.org/licenses/by-nc/4.0/',
		'display' => true,
	],
	'cc-by-nc-sa' => [
		'name' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'link' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'display' => true,
	],
	'cc-by-nc-nd' => [
		'name' => 'Creative Commons Attribution-NonCommercial-NoDerivs',
		'link' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/',
		'display' => true,
	],
	'other' => [
		'name' => 'Other',
		'link' => null,
		'display' => false,
	],
];

add_filter('image_send_to_editor', function ($html, $id, $caption, $title, $align, $url, $size, $alt) {
	global $gds_image_licences;
	$caption = '';

	$_licence = get_post_meta($id, 'licence', true);
	if (!empty($_licence)) {
		$licence = $gds_image_licences[$_licence];
	} else {
		$licence = $gds_image_licences['other'];
	}

	$copyright_holder = get_post_meta($id, 'copyright_holder', true);
	$link_to_source = get_post_meta($id, 'link_to_source', true);

	if ($licence['display'] === true || !empty($copyright_holder)) {
		if ($licence['display'] === true) {
			$caption .= __('Licence:');
			$caption .= ' <a rel="license" href="'.esc_attr($licence['link']).'">'.esc_html($licence['name']).'</a>';
			if (!empty($copyright_holder)) {
				$caption .= ', ';
			}
		}
		if (!empty($copyright_holder)) {
			$caption .= '<a href="'.esc_attr($link_to_source).'">'.esc_html($copyright_holder).'</a>';
		}
		$output_html = '<figure class="thumbnail">'.$html.'<figcaption class="caption">'.$caption.'</figcaption></figure>';
	} else {
		$output_html = $html;
	}

	return $output_html;
}, 999, 8);
