<?php

namespace GovUKBlogs;

class OpenGraphImage implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('wp_head', [$this, 'wpHead'], 10, 0);
	}

	public function wpHead(): void
	{
		if (!is_single()) {
			return;
		}

		if (!has_post_thumbnail()) {
			return;
		}

		$thumbnail = get_the_post_thumbnail_url();
		if ($thumbnail == false) {
			return;
		}

		echo sprintf('<meta property="og:image" content="%s">' . "\n", $thumbnail);
	}
}
