<?php

namespace GovUKBlogs\Blocks\StyleVariations;

class Scripts implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockStyleVariations']);
	}

	public function enqueueBlockStyleVariations()
	{
		wp_enqueue_script(
			'block-style-variations',
			get_theme_file_uri('/app/Blocks/StyleVariations/variations.js'),
			[
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post'
			]
		);
	}
}
