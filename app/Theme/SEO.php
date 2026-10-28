<?php

namespace GovUKBlogs\Theme;

class SEO implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_filter('wp_robots', [$this, "noindex"]);
	}

	public function noindex($robots)
	{
		$post = get_post();
		if (!empty($post->post_password)) {
			$robots['noindex'] = true;
		}
		return $robots;
	}
}
