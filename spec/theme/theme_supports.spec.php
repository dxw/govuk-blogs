<?php

describe(GovUKBlogs\Theme\ThemeSupports::class, function () {
	beforeEach(function () {
		$this->themeSupports = new GovUKBlogs\Theme\ThemeSupports();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->themeSupports)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once()->with('after_setup_theme', [$this->themeSupports, 'addThemeSupport']);

			$this->themeSupports->register();
		});
	});

	describe('->addThemeSupport()', function () {
		it('adds theme support for specified features', function () {
			allow('add_theme_support')->toBeCalled();
			expect('add_theme_support')->toBeCalled()->times(2);
			expect('add_theme_support')->toBeCalled()->once()->with('editor-styles');
			expect('add_theme_support')->toBeCalled()->once()->with('title-tag');

			$this->themeSupports->addThemeSupport();
		});
	});
});
