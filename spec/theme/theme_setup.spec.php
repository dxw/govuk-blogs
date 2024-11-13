<?php

describe(GovUKBlogs\Theme\ThemeSetup::class, function () {
	beforeEach(function () {
		$this->themeSetup = new GovUKBlogs\Theme\ThemeSetup();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->themeSetup)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once()->with('after_setup_theme', [$this->themeSetup, 'loadTextDomain']);

			$this->themeSetup->register();
		});
	});

	describe('->loadTextDomain()', function () {
		it('loads the theme text domain', function () {
			allow('load_theme_textdomain')->toBeCalled();
			allow('get_template_directory')->toBeCalled()->andReturn('http://localhost.com');
			expect('load_theme_textdomain')->toBeCalled()->once()->with('roots', 'http://localhost.com' . '/lang');

			$this->themeSetup->loadTextDomain();
		});
	});

});
