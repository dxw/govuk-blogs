<?php

global $gds_image_licences;

$gds_image_licences = [
  'ogl' => 'OGL',
  'cc-by' => 'Attribution',
  'cc-by-sa' => 'Attribution-ShareAlike',
  'cc-by-nd' => 'Attribution-NoDerivs',
  'cc-by-nc' => 'Attribution-NonCommercial',
  'cc-by-nc-sa' => 'Attribution-NonCommercial-ShareAlike',
  'cc-by-nc-nd' => 'Attribution-NonCommercial-NoDerivs',
  'other' => 'Other',
];

add_filter('image_send_to_editor', function ($html, $id, $caption, $title, $align, $url, $size, $alt) {
  global $gds_image_licences;

  $_licence = get_post_meta($id, 'licence', true);
  $licence = $gds_image_licences[$_licence];
  $copyright_holder = get_post_meta($id, 'copyright_holder', true);
  $link_to_source = get_post_meta($id, 'link_to_source', true);

  $caption = 'Licence: '.esc_html($licence).' <a href="'.esc_attr($link_to_source).'">'.esc_html($copyright_holder).'</a>';

  return '<figure>'.$html.'<figcaption>'.$caption.'</figcaption></figure>';
}, 10, 8);
