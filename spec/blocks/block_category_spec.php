<?php

describe(GovUKBlogs\Blocks\BlockCategory::class, function () {
	beforeEach(function () {
		$this->blockCategory = new GovUKBlogs\Blocks\BlockCategory();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->blockCategory)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the filter', function () {
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->once()->with('block_categories_all', [$this->blockCategory, 'addCustomCategory']);

			$this->blockCategory->register();
		});
	});

	describe('->addCustomCategory)', function () {
		it('adds a custom category to the block editor', function () {
			$categoriesArray = [
				[
					'slug' => 'abc',
					'title' => 'ABC'
				],
				[
					'slug' => 'def',
					'title' => 'DEF'
				]
			];
			$result = $this->blockCategory->addCustomCategory($categoriesArray);
			expect($result)->toReturn([
				[
					'slug' => 'govuk-components',
					'title' => 'GOV.UK components'
				],
				[
					'slug' => 'abc',
					'title' => 'ABC'
				],
				[
					'slug' => 'def',
					'title' => 'DEF'
				]
				]);
			$this->blockCategory->addCustomCategory;
		});
	});
});
