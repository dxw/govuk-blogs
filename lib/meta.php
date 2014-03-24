<?php

function get_the_content_please($id) {
  global $post;
  $old_post = $post;
  setup_postdata(get_post($id));
  $return = get_the_content();
  $post = $old_post;
  return $return;
}

function limit_words($s, $n) {
  $a = explode(' ', str_replace("\n", ' ', $s));
  return implode(' ', array_splice($a, 0, $n));
}

add_action('wp_head', function () {
  $p = get_post();
  if ($p === null) {
    return;
  }

  $content = limit_words(strip_tags(get_the_content_please($p->ID)), 40);

  ?>

  <meta name="description" content="<?php bloginfo('description'); ?>" />

  <?php
});
