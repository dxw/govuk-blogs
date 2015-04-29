<?php

add_action('after_setup_theme', function () {
  $filters = [
    // wp-includes/default-filters.php line 94
    'comment_author', 'term_name', 'link_name', 'link_description', 'link_notes', 'bloginfo', 'wp_title', 'widget_title',
    // wp-includes/default-filters.php line 106
    'single_post_title', 'single_cat_title', 'single_tag_title', 'single_month_title', 'nav_menu_attr_title', 'nav_menu_description',
    // wp-includes/default-filters.php line 112
    'term_description',
    // wp-includes/default-filters.php line 127
    'the_title',
    // wp-includes/default-filters.php line 131
    'the_content',
    // wp-includes/default-filters.php line 138
    'the_excerpt',
    // wp-includes/default-filters.php line 145
    'comment_text',
    // wp-includes/default-filters.php line 154
    'list_cats',
  ];

  foreach ($filters as $filter) {
    remove_filter($filter, 'wptexturize');
  }
});
