<?php

describe(GovUKBlogs\Blocks\Variations\Scripts::class, function () {
	beforeEach(function () {
		$this->scripts = new GovUKBlogs\Blocks\Variations\Scripts();
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->times(1);
			expect('add_action')->toBeCalled()->once()->with('enqueue_block_editor_assets', [$this->scripts, 'enqueueBlocksVariations']);

			$this->scripts->register();
		});
	});

	describe('->enqueueBlocksVariations()', function () {
		it('enqueues block variations script', function () {
			allow('wp_enqueue_script')->toBeCalled();
			allow('get_theme_file_uri')->toBeCalled()->andReturn('/wp-content/themes/govuk-blogs/app/Blocks/Variations/variations.js');
			expect('wp_enqueue_script')->toBeCalled()->once()->with('blocks-variations', '/wp-content/themes/govuk-blogs/app/Blocks/Variations/variations.js', [
				'wp-blocks',
				'wp-dom',
				'wp-edit-post',
			], '', true);

			$this->scripts->enqueueBlocksVariations();
		});
	});
});
