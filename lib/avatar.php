<?php

function gds_avatar() {
  global $coauthors_plus;

  if (function_exists('get_coauthors')) {
    $author_id = (int)get_the_author_meta('ID');
    $author_name = get_the_author_meta('display_name');

    $guest_authors = get_posts([
      'post_type' => 'guest-author',
      'post_status' => 'any',
      'posts_per_page' => -1,
    ]);

    foreach ($guest_authors as $guest_author) {
      // We can't just match on ID because there could be a WP user with the same ID
      if ((int)$guest_author->ID === $author_id && $guest_author->post_title === $author_name) {
        $author_object = $coauthors_plus->get_coauthor_by('id', $author_id);
        echo coauthors_get_avatar($author_object, 140);
        return;
      }
    }
  }

  echo get_avatar( get_the_author_meta('email'), 140 );
}
