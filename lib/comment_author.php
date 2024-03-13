<?php

function comment_author_page()
{
	global $comment;

	if ($comment->user_id == '0') {
		echo get_comment_author();
	} else {
		$url = get_author_posts_url($comment->user_id);
		echo "<a href=\"" . $url . "\">" .get_comment_author() . "</a>";
	}
}
