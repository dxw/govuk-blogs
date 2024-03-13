<?php

namespace GovUKBlogs;

class FixRoots implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('init', [$this, 'fixRoots']);
	}

	public function fixRoots()
	{
		remove_filter('style_loader_tag', 'roots_clean_style_tag');
	}
}
