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
	}
}
