<?php

function comment_author_page() {
    global $comment;

    if ($comment->user_id == '0') {
        if (!empty ($comment->comment_author_url)) {
            $url = $comment->comment_author_url;
        } else {
            $url = '#';
        }
    } else {
        $url = get_author_posts_url($comment->user_id);
    }

    echo "<a href=\"" . $url . "\">" .get_comment_author() . "</a>";
}
