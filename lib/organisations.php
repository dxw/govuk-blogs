<?php

function gds_organisations() {
  if (function_exists('govuk_organisations') && function_exists('get_field')) {
    $orgs = govuk_organisations();

    $output = [];
    $field = get_field('organisations', 'option');

    if (count($field) > 0) {
      foreach ($field as $f) {
        $output[] = '<a href="'.esc_attr($orgs[$f['organisation']]['web_url']).'">'.esc_html($orgs[$f['organisation']]['title']).'</a>';
      }
      echo implode(', ', $output);
      return;
    }
  }

  echo get_option('gds_organisations');
}
