<?php

function share_icons($id) {
  $url = get_permalink($id);
  $title = get_the_title($id);
  $thumbnail_id = get_post_thumbnail_id($id);

  $twitter_url = add_query_arg([
    'url' => $url,
    'text' => $title,
  ], 'https://twitter.com/intent/tweet');

  $facebook_url = add_query_arg([
    'u' => $url,
  ], 'https://www.facebook.com/sharer/sharer.php');

  if ($thumbnail_id) {
    $attachment_url = wp_get_attachment_url($thumbnail_id);
    $pinterest_url = add_query_arg([
      'url' => $url,
      'media' => $attachment_url,
      'description' => $title,
    ], 'http://www.pinterest.com/pin/create/button/');
  }

  ?>

  <ul>
    <li><a href="<?php echo esc_attr($twitter_url) ?>">Share by Twitter</a></li>
    <li><a href="<?php echo esc_attr($facebook_url) ?>">Share by Facebook</a></li>
    <?php if ($thumbnail_id) : ?>
      <li><a href="<?php echo esc_attr($pinterest_url) ?>">Share by Pinterest</a></li>
    <?php endif ?>
  </ul>

  <?php
}
