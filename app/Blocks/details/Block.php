<?php

namespace GovUKBlogs\Blocks\Details;

class Block implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action( 'init', [$this, 'detailsBlockInit'] );
	}

	public function detailsBlockInit() {
		register_block_type( __DIR__ . '/build' );
	}
}