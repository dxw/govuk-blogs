<?php

// this would add the nonce to the comment form
// but only if it is generated using comment_form()
function govukblogs_add_comment_nonce()
{
	wp_nonce_field('comment_verify');
}
add_action('comment_form_after_fields', 'govukblogs_add_custom_nonce');

function govukblogs_verify_comment_nonce()
{
	check_admin_referer('comment_verify');
}
add_action('pre_comment_on_post', 'govukblogs_verify_comment_nonce');
