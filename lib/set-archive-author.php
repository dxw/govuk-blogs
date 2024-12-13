<?php

// Set the post_author to be "2"

function set_archive_author($data, $postarr)
{
	$fix_types = ["page", "post", "attachment"];

	if (!in_array($data['post_type'], $fix_types)) {
		return $data;
	}

	$data['post_author'] = 2;

	return $data;
}
