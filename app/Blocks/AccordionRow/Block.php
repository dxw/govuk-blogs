<?php

namespace GovUKBlogs\Blocks\AccordionRow;

class Block implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('init', [$this, 'registerBlock']);
	}

	public function registerBlock(): void
	{
		register_block_type(__DIR__ . '/build');
	}
}
