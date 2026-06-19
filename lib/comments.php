<?php

function disable_comments_on_type($open, $post_id)
{
	$tmp_post = get_post($post_id);
	if ($tmp_post->post_type == 'attachment') {
		return false;
	}
	return $open;
}
add_filter('comments_open', 'disable_comments_on_type', 10, 2);
