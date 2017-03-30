<?php
add_filter('jm_tc_get_excerpt', function ($text) {
    global $post;
    $excerpt = get_the_excerpt($post);
    if (!empty($excerpt)) {
        return $excerpt;
    }
    return $text;
}
);
