<?php

namespace GovUKBlogs\Theme;

class ThemeSupports implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_theme_support('title-tag');
	}
}