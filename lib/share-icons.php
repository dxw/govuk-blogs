<?php

function share_icons($id)
{
	$url = get_permalink($id);
	$title = html_entity_decode(get_the_title($id)); // decode entities so we can UTF-8 escape URLs properly
	$thumbnail_id = get_post_thumbnail_id($id);

	$twitter_url = add_query_arg([
	'url' => urlencode($url),
	'text' => urlencode($title),
	], 'https://twitter.com/intent/tweet?original_referer=');

	$facebook_url = add_query_arg([
	'u' => urlencode($url),
	], 'https://www.facebook.com/sharer/sharer.php');

	$linkedin_url = add_query_arg([
	'url' => urlencode($url),
	], 'https://www.linkedin.com/shareArticle');

	$mailto_url = "mailto:?subject=" . rawurlencode(__("I wanted to share this post with you from"). " " . get_bloginfo('name')) ."&body=". rawurlencode($title . " " . $url);

	?>

  <div class="icons-buttons">
    <h3><?php echo __("Share this page"); ?></h3>
    <ul>
      <li>
        <a target="_blank" href="<?php echo esc_attr($twitter_url) ?>" class="twitter">X (formerly Twitter)</a>
      </li>
      <li>
        <a target="_blank" href="<?php echo esc_attr($facebook_url) ?>" class="facebook">Facebook</a>
      </li>
      <li>
        <a target="_blank" href="<?php echo esc_attr($linkedin_url) ?>" class="linkedin">LinkedIn</a>
      </li>
      <li>
        <a href="<?php echo esc_attr($mailto_url); ?>" class="email">Email</a>
      </li>
    </ul>
    <div class="govuk-clearfix"></div>
  </div>

  <?php
}
