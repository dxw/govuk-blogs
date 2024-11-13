<?php

namespace GovUKBlogs\Theme;

class ThemeSetup implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('after_setup_theme', [$this, 'loadTextDomain']);
	}

	public function loadTextDomain()
	{
		load_theme_textdomain('roots', get_template_directory() . '/lang');
	}
}
