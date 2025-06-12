<?php

namespace GovUKBlogs\Theme;

class ThemeSupports implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('after_setup_theme', [$this, 'addThemeSupport']);
	}

	public function addThemeSupport()
	{
		add_theme_support('editor-styles');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('html5', ['script', 'style', 'meta', 'navigation-widgets']);
	}
}
