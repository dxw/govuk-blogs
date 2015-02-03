<?php

global $gds_image_licences;

$gds_image_licences = [
  'ogl' => [
    'name' => 'OGL',
    'link' => 'http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/',
  ],
  'cc-by' => [
    'name' => 'Creative Commons Attribution',
    'link' => 'http://creativecommons.org/licenses/by/4.0',
  ],
  'cc-by-sa' => [
    'name' => 'Creative Commons Attribution-ShareAlike',
    'link' => 'http://creativecommons.org/licenses/by-sa/4.0',
  ],
  'cc-by-nd' => [
    'name' => 'Creative Commons Attribution-NoDerivs',
    'link' => 'http://creativecommons.org/licenses/by-nd/4.0',
  ],
  'cc-by-nc' => [
    'name' => 'Creative Commons Attribution-NonCommercial',
    'link' => 'http://creativecommons.org/licenses/by-nc/4.0',
  ],
  'cc-by-nc-sa' => [
    'name' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
    'link' => 'http://creativecommons.org/licenses/by-nc-sa/4.0',
  ],
  'cc-by-nc-nd' => [
    'name' => 'Creative Commons Attribution-NonCommercial-NoDerivs',
    'link' => 'http://creativecommons.org/licenses/by-nc-nd/4.0',
  ],
  'other' => [
    'name' => 'Other',
    'link' => null,
  ],
];

add_filter('image_send_to_editor', function ($html, $id, $caption, $title, $align, $url, $size, $alt) {
  global $gds_image_licences;

  $_licence = get_post_meta($id, 'licence', true);
  $licence = $gds_image_licences[$_licence];
  $copyright_holder = get_post_meta($id, 'copyright_holder', true);
  $link_to_source = get_post_meta($id, 'link_to_source', true);

  $caption = 'Licence: ';
  if ($licence['link'] === null) {
    $caption .= esc_html($licence['name']);
  } else {
    $caption .= '<a href="'.esc_attr($licence['link']).'">'.esc_html($licence['name']).'</a>';
  }
  $caption .= ' <a href="'.esc_attr($link_to_source).'">'.esc_html($copyright_holder).'</a>';

  return '<figure>'.$html.'<figcaption>'.$caption.'</figcaption></figure>';
}, 999, 8);
