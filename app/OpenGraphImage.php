<?php

namespace GovUKBlogs;

class OpenGraphImage implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('wp_head', [$this, 'wpHead']);
	}

	public function wpHead(): void
	{
		if (!is_single()) {
			return;
		}

		if (!has_post_thumbnail()) {
			return;
		}

		echo sprintf('<meta property="og:image" content="%s">'."\n", get_the_post_thumbnail_url());
	}
}
