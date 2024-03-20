<?php

describe(GovUKBlogs\Blocks\AccordionRow\Block::class, function () {
	beforeEach(function () {
		$this->accordionRowBlock = new GovUKBlogs\Blocks\AccordionRow\Block();
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->times(1);
			expect('add_action')->toBeCalled()->once()->with('init', [$this->accordionRowBlock, 'registerBlock']);

			$this->accordionRowBlock->register();
		});
	});

	describe('->registerBlock()', function () {
		it('registers the block', function () {
			allow('register_block_type')->toBeCalled();
			expect('register_block_type')->toBeCalled()->once()->with(\Kahlan\Arg::toBeA('string'));

			$this->accordionRowBlock->registerBlock();
		});
	});
});
