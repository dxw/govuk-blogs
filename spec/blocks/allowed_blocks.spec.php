<?php

use Kahlan\Plugin\Double;

describe(GovUKBlogs\Blocks\AllowedBlocks::class, function () {
	beforeEach(function () {
		$this->allowedBlocks = new GovUKBlogs\Blocks\AllowedBlocks();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->allowedBlocks)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the filter', function () {
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->once()->with('allowed_block_types_all', [$this->allowedBlocks, 'limitAllowedBlocks']);

			$this->allowedBlocks->register();
		});
	});

	describe('->limitAllowedBlocks)', function () {
		it('limits the blocks allowed in the block editor', function () {
			$arg1 = [
				'core/post',
				'core/list'
			];
			$arg2 = Double::instance([
				'class' => '\WP_Block_Editor_Context'
			]);
			$result = $this->allowedBlocks->limitAllowedBlocks($arg1, $arg2);
			expect($result)->toBeA('array');
			$this->allowedBlocks->limitAllowedBlocks($arg1, $arg2);
		});
	});
});
