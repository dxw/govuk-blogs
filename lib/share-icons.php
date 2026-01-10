<?php

function share_icons_admin()
{
	add_submenu_page('settings.php', 'Sharing links', 'Sharing links', 'manage_network', 'sharing-links', function () {

		if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'sharing_links')) {
			if (isset($_POST['share_twitter'])) {
				update_site_option('sharing_links_twitter', 1);
			} else {
				update_site_option('sharing_links_twitter', 0);
			}
			if (isset($_POST['share_facebook'])) {
				update_site_option('sharing_links_facebook', 1);
			} else {
				update_site_option('sharing_links_facebook', 0);
			}
			if (isset($_POST['share_linkedin'])) {
				update_site_option('sharing_links_linkedin', 1);
			} else {
				update_site_option('sharing_links_linkedin', 0);
			}
			if (isset($_POST['share_email'])) {
				update_site_option('sharing_links_email', 1);
			} else {
				update_site_option('sharing_links_email', 0);
			}
		}
		?>
<div class="wrap">
	<h2>Sharing links</h2>

		<form method="POST">
			<?php wp_nonce_field('sharing_links') ?>

			<p>
				Control which sharing options are displayed at the bottom of the article.
			</p>
			<p>
				This does not affect profile links shown elsewhere.
			</p>

			<input type="checkbox" id="share_twitter" name="share_twitter" value="1"<?= checked(get_site_option('sharing_links_twitter'), 1) ?>>
			<label for="share_twitter">Twitter</label><br>

			<input type="checkbox" id="share_facebook" name="share_facebook" value="1"<?= checked(get_site_option('sharing_links_facebook'), 1) ?>>
			<label for="share_facebook">Facebook</label><br>

			<input type="checkbox" id="share_linkedin" name="share_linkedin" value="1"<?= checked(get_site_option('sharing_links_linkedin'), 1) ?>>
			<label for="share_linkedin">LinkedIn</label><br>

			<input type="checkbox" id="share_email" name="share_email" value="1"<?= checked(get_site_option('sharing_links_email'), 1) ?>>
			<label for="share_email">Email</label><br>

			<?php submit_button() ?>
	</form>
</div>
<?php
	});
}

add_action('network_admin_menu', 'share_icons_admin');

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
	<h3><?php _e("Share this page", "govuk-blogs"); ?></h3>
	<ul>

		<?php if (get_site_option('sharing_links_twitter')) { ?>
		<li>
			<a target="_blank" rel="noopener noreferrer external" class="govuk-link govuk-link--no-underline twitter" href="<?= esc_attr($twitter_url) ?>">
				<span class="govuk-visually-hidden"><?php _e("Share on", "govuk-blogs"); ?></span>
				Twitter
				<span class="govuk-visually-hidden">(<?php _e("opens in new tab", "govuk-blogs"); ?>)</span>
			</a>
		</li>
		<?php } ?>
		<?php if (get_site_option('sharing_links_facebook')) { ?>
		<li>
			<a target="_blank" rel="noopener noreferrer external" class="govuk-link govuk-link--no-underline facebook" href="<?= esc_attr($facebook_url) ?>">
				<span class="govuk-visually-hidden"><?php _e("Share on", "govuk-blogs"); ?></span>
				Facebook
				<span class="govuk-visually-hidden">(<?php _e("opens in new tab", "govuk-blogs"); ?>)</span>
			</a>
		</li>
		<?php } ?>
		<?php if (get_site_option('sharing_links_linkedin')) { ?>
		<li>
			<a target="_blank" rel="noopener noreferrer external" class="govuk-link govuk-link--no-underline linkedin" href="<?= esc_attr($linkedin_url) ?>">
				<span class="govuk-visually-hidden"><?php _e("Share on", "govuk-blogs"); ?></span>
				LinkedIn
				<span class="govuk-visually-hidden">(<?php _e("opens in new tab", "govuk-blogs"); ?>)</span>
			</a>
		</li>
		<?php } ?>
		<?php if (get_site_option('sharing_links_email')) { ?>
		<li>
			<a target="_blank" rel="noopener noreferrer external" class="govuk-link govuk-link--no-underline email" href="<?= esc_attr($mailto_url) ?>">
				<span class="govuk-visually-hidden"><?php _e("Share on", "govuk-blogs"); ?></span>
				<?php _e("Email", "govuk-blogs"); ?>
				<span class="govuk-visually-hidden">(<?php _e("opens in new tab", "govuk-blogs"); ?>)</span>
			</a>
		</li>
		<?php } ?>
	</ul>
	<div class="govuk-clearfix"></div>
</div>
<?php
}
