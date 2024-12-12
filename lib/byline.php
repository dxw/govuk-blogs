<?php

# Display the author for a post, using coauthors if available and falling back to the WordPress user if not.
function gds_byline()
{
	?>
	<span class="govuk-visually-hidden">Posted by: </span><?php
	$tmp_author_id = get_post_field('post_author', $post->ID);
	$tmp_user =  get_user_by('id', $author_id);
	if (empty($tmp_user->user_login)) {
		echo "Deleted user $tmp_author_id";
		error_log("{$post->ID} has deleted user $tmp_author_id", 0);
	} else {
		if (function_exists('coauthors_posts_links')) {
			coauthors_posts_links(', ');
		} else {
			?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" rel="author" class="govuk-link"><?php echo get_the_author() ?></a> <?php
		}
	}
}
