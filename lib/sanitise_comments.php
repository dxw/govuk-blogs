<?php

add_filter('preprocess_comment', function($comment_data) { 
    $comment_data['comment_content'] = esc_html($comment_data['comment_content']);

    return $comment_data;
}, 10, 1);
