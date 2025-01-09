<?php

namespace GovUKBlogs\Theme;

class FixNonExistentAuthors implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('gds_byline', [$this, 'replaceAbsentAuthor']);
	}

	public function replaceAbsentAuthor()
	{
		global $post;
		$post_author_id = get_post_field('post_author', $post->ID);
		if ($post_author_id > 1) {
			$post_author = get_user_by('id', $post_author_id);
			if (!($post_author)) {
				error_log("author of post {$post->ID} is deleted user $post_author_id", 0);
				add_filter('wp_insert_post_data', [$this, 'setArchiveAuthor'], 99, 2);
				wp_update_post($post);
			}
		}
	}

	public function setArchiveAuthor($postData, $postArray)
	{
		$fix_types = ["page", "post", "attachment"];

		if (!in_array($postData['post_type'], $fix_types)) {
			return $postData;
		}

		$archive_user_option = get_option('archive_author');

		if (!empty($archive_user_option)) {
			if (is_int($archive_user_option)) {
				$archive_author_id = $archive_user_option;
			} elseif (is_string($archive_user_option) && ctype_digit($archive_user_option)) {
				$archive_author_id = intval($archive_user_option);
			}
			if (!empty($archive_author_id)) {
				$postData['post_author'] = $archive_author_id;
				if (taxonomy_exists('author')) {
					wp_delete_object_term_relationships($postArray['ID'], 'author');
				}
			}
		}
		return $postData;
	}
}
