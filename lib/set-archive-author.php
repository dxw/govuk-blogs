<?php

// Find a username specified in the option "archive_author"
// Set the post_author (in $data) to be the id corresponding to the user

function set_archive_author($data, $postarr)
{
	$fix_types = ["page", "post", "attachment"];

	if (!in_array($data['post_type'], $fix_types)) {
		return $data;
	}

	$archive_author = get_option('archive_author');

	if (!empty($archive_author)) {
		if ((string)(int)$archive_author == (string)$archive_author) {
			$archive_author_id = $archive_author;
		} else {
			$archive_author_id = get_user_by('id', $archive_author);
		}
		if (!empty($archive_author_id)) {
			$data['post_author'] = $archive_author_id;
		}
	}

	return $data;
}
