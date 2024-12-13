<div class="govuk-body-s"><?php

// If the post is owned by a deleted user, set it to the archive user
$tmp_author_id = get_post_field('post_author', $post->ID);
if ($tmp_author_id > 2) {
	$tmp_user = get_user_by('id', $tmp_author_id);
	if (empty($tmp_user->user_login)) {
		error_log("post {$post->ID} has deleted user $tmp_author_id", 0);
		add_filter('wp_insert_post_data', 'set_archive_author', '99', 2);
		wp_update_post($post);
	}
}

gds_byline();
?>, <span class="govuk-visually-hidden">Posted on: </span><time class="updated" datetime="<?php echo get_the_time('c') ?>"><?php echo get_the_date('j F Y') ?></time>
  -
  <span class="govuk-visually-hidden">Categories: </span>
  <?php echo get_the_category_list(', ') ?>
</div>
