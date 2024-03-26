<?php

namespace GovUKBlogs\Blocks\Variations;

class Scripts implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('enqueue_block_editor_assets', [$this, 'enqueueBlocksVariations']);
	}

	public function enqueueBlocksVariations()
	{
		wp_enqueue_script('blocks-variations', get_theme_file_uri('/app/Blocks/Variations/variations.js'), [
			'wp-blocks',
			'wp-dom',
			'wp-edit-post',
		], '', true);
	}
}
