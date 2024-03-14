<?php

describe(GovUKBlogs\Theme\ThemeSupports::class, function () {
	beforeEach(function () {
		$this->themeSupports = new GovUKBlogs\Theme\ThemeSupports();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->themeSupports)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds theme support for specified features', function () {
			allow('add_theme_support')->toBeCalled();
			expect('add_theme_support')->toBeCalled()->once();
			expect('add_theme_support')->toBeCalled()->with('title-tag');

			$this->themeSupports->register();
		});
	});
});
