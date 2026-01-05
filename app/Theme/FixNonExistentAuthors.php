<?php

namespace GovUKBlogs\Theme;

class FixNonExistentAuthors implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('gds_byline', [$this, 'replaceAbsentAuthor']);
	}

	public function replaceAbsentAuthor(): void
	{
		/** @var WP_Post $post */
		global $post;

		$post_id = (int) $post->ID;
		$post_author_id = (int) get_post_field('post_author', $post_id);
		if ($post_author_id > 1) {
			$post_author = get_user_by('id', $post_author_id);
			if (!($post_author)) {
				error_log("author of post {$post_id} is deleted user $post_author_id", 0);
				add_filter('wp_insert_post_data', [$this, 'setArchiveAuthor'], 99, 2);
				wp_update_post($post);
			}
		}
	}

	public function setArchiveAuthor(array $postData, array $postArray): array
	{
		$fix_types = ["page", "post", "attachment"];

		if (!in_array($postData['post_type'], $fix_types)) {
			return $postData;
		}

		/** @var int|string|false|null */
		$archive_user_option = get_network_option(null, 'archive_author');
		$archive_author_id = null;

		if ($archive_user_option === false || $archive_user_option === null) {
			return $postData;
		}

		if (is_int($archive_user_option)) {
			$archive_author_id = $archive_user_option;
		} elseif (ctype_digit($archive_user_option)) {
			/** @var numeric-string $archive_user_option */
			$archive_author_id = (int) $archive_user_option;
		}

		if ($archive_author_id !== null) {
			$postData['post_author'] = $archive_author_id;
		}

		return $postData;
	}
}
