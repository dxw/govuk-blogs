<?php

namespace GovUKBlogs\Blocks\InsetText;

class Block implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('init', [$this, 'registerBlock']);
	}

	public function registerBlock()
	{
		register_block_type(__DIR__ . '/build');
	}
}
