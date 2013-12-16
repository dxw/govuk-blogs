<?php

function share_icons($id) {
  # TODO - remove this when this functionality is ready to deploy.
  return;

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

  <div class="social-buttons">
    <ul>
      <li><a target="_blank" href="<?php echo esc_attr($twitter_url) ?>"><img src="<?php echo esc_attr(get_template_directory_uri()) ?>/assets/img/social/tweet.png" alt="Tweet"></a></li>
      <li><a target="_blank" href="<?php echo esc_attr($facebook_url) ?>"><img src="<?php echo esc_attr(get_template_directory_uri()) ?>/assets/img/social/fb-share.png" alt="Share via Facebook"></a></li>
      <?php if ($thumbnail_id) : ?>
        <li><a target="_blank" href="<?php echo esc_attr($pinterest_url) ?>"><img src="<?php echo esc_attr(get_template_directory_uri()) ?>/assets/img/social/pin_it_button.png" alt="Pin it"></a></li>
      <?php endif ?>
    </ul>
    <div class="clearfix"></div>
  </div>

  <?php
}
