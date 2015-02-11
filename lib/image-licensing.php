<?php

global $gds_image_licences;

$gds_image_licences = [
  'ogl' => [
    'name' => 'OGL',
    'link' => 'http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/',
    'display' => false,
  ],
  'cc-by' => [
    'name' => 'Creative Commons Attribution',
    'link' => 'http://creativecommons.org/licenses/by/4.0',
    'display' => true,
  ],
  'cc-by-sa' => [
    'name' => 'Creative Commons Attribution-ShareAlike',
    'link' => 'http://creativecommons.org/licenses/by-sa/4.0',
    'display' => true,
  ],
  'cc-by-nd' => [
    'name' => 'Creative Commons Attribution-NoDerivs',
    'link' => 'http://creativecommons.org/licenses/by-nd/4.0',
    'display' => true,
  ],
  'cc-by-nc' => [
    'name' => 'Creative Commons Attribution-NonCommercial',
    'link' => 'http://creativecommons.org/licenses/by-nc/4.0',
    'display' => true,
  ],
  'cc-by-nc-sa' => [
    'name' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
    'link' => 'http://creativecommons.org/licenses/by-nc-sa/4.0',
    'display' => true,
  ],
  'cc-by-nc-nd' => [
    'name' => 'Creative Commons Attribution-NonCommercial-NoDerivs',
    'link' => 'http://creativecommons.org/licenses/by-nc-nd/4.0',
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

  $_licence = get_post_meta($id, 'licence', true);
  $licence = $gds_image_licences[$_licence];
  $copyright_holder = get_post_meta($id, 'copyright_holder', true);
  $link_to_source = get_post_meta($id, 'link_to_source', true);

  $caption = 'Licence: ';
  if ($licence['display'] === true) {
    $caption .= '<a href="'.esc_attr($licence['link']).'">'.esc_html($licence['name']).'</a>';
  } else {
    return $html;
  }
  $caption .= ' <a href="'.esc_attr($link_to_source).'">'.esc_html($copyright_holder).'</a>';

  return '<figure class="thumbnail">'.$html.'<figcaption class="caption">'.$caption.'</figcaption></figure>';
}, 999, 8);
