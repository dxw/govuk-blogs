<?php

function gds_post_thumbnail() {
  if (has_post_thumbnail()) {
    the_post_thumbnail('large');
  } elseif ($video_url = get_post_meta(get_the_ID(), 'video_url', true)) {
    echo $GLOBALS['wp_embed']->autoembed($video_url);
  }
}
