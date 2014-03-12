<?php

function gds_avatar() {
  if (function_exists('get_coauthors')) {
    $coauthors = get_coauthors();
    $author = array_pop($coauthors);

    if ($author->type === 'guest-author') {
      echo coauthors_get_avatar($author, 140);
      return;
    }
  }

  echo get_avatar( get_the_author_meta('email'), 140 );
}
