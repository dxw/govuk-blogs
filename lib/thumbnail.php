<?php

function gds_post_thumbnail($featured=false) {
  if (has_post_thumbnail()) {
    if ($featured) {
      ?>
      <a href="<?php echo esc_attr(get_permalink()) ?>"><?php the_post_thumbnail('large') ?></a>
      <?php
    } else {
      the_post_thumbnail('large');
    }
  } elseif ($video_url = get_post_meta(get_the_ID(), 'video_url', true)) {
    echo $GLOBALS['wp_embed']->shortcode([], $video_url);
  }
}
