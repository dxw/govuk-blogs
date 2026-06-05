<?php

namespace GovUKBlogs;

class OpenGraphImage implements \Dxw\Iguana\Registerable
{
	private $govukDefaultImage;

	public function register(): void
	{
		$this->govukDefaultImage = get_template_directory_uri() . '/build/govuk-assets/images/govuk-opengraph-image.png';
		add_action('wp_head', [$this, 'wpHead']);
	}

	public function wpHead(): void
	{
		$ogImage = is_single() && has_post_thumbnail() ? get_the_post_thumbnail_url() : $this->govukDefaultImage;
		echo sprintf('<meta property="og:image" content="%s">'."\n", esc_url($ogImage));
	}
}
