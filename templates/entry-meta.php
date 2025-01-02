<div class="govuk-body-s"><?php

// If the post is owned by a deleted user, patch it to the archive user
$check_author_id = get_post_field('post_author', $post->ID);
if ($check_author_id > 1) {
	$check_user = get_user_by('id', $check_author_id);
	if (empty($check_user->user_login)) {
		error_log("author of post {$post->ID} is deleted user $check_author_id", 0);
		//add_filter('wp_insert_post_data', 'set_archive_author', 99, 2);
		//wp_update_post($post);
		add_filter('wp_footer', 'set_archive_author', 99, 2);
	}
}

gds_byline();
?>, <span class="govuk-visually-hidden">Posted on: </span><time class="updated" datetime="<?php echo get_the_time('c') ?>"><?php echo get_the_date('j F Y') ?></time>
  -
  <span class="govuk-visually-hidden">Categories: </span>
  <?php echo get_the_category_list(', ') ?>
</div>
