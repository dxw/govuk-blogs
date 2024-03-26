<?php

describe(GovUKBlogs\Blocks\StyleVariations\Scripts::class, function () {
	beforeEach(function () {
		$this->scripts = new GovUKBlogs\Blocks\StyleVariations\Scripts();
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->times(1);
			expect('add_action')->toBeCalled()->once()->with('enqueue_block_editor_assets', [$this->scripts, 'enqueueBlockStyleVariations']);

			$this->scripts->register();
		});
	});

	describe('->enqueueBlockStyleVariations()', function () {
		it('enqueues block variations script', function () {
			allow('wp_enqueue_script')->toBeCalled();
			allow('get_theme_file_uri')->toBeCalled()->andReturn('/wp-content/themes/govuk-blogs/app/Blocks/StyleVariations/variations.js');
			expect('wp_enqueue_script')->toBeCalled()->once()->with('block-style-variations', '/wp-content/themes/govuk-blogs/app/Blocks/StyleVariations/variations.js', [
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post',
			]);

			$this->scripts->enqueueBlockStyleVariations();
		});
	});
});
