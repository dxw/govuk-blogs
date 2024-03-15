<?php

use Kahlan\Arg;
use Kahlan\Plugin\Double;

describe(GovUKBlogs\Theme\Scripts::class, function () {
	beforeEach(function () {
		$this->cssManifest = Double::instance([
			'extends' => GovUKBlogs\Theme\CSSManifest::class,
			'magicMethods' => true
		]);
		$this->scripts = new GovUKBlogs\Theme\Scripts($this->cssManifest);
	});

	it('implements registerable', function () {
		expect($this->scripts)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the action', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->times(3);
			expect('add_action')->toBeCalled()->with('wp_enqueue_scripts', [$this->scripts, 'wpEnqueueScripts']);
			expect('add_action')->toBeCalled()->with('after_setup_theme', [$this->scripts, 'wpEnqueueEditorStyles']);
			expect('add_action')->toBeCalled()->with('init', [$this->scripts, 'removeRootsScript']);
			allow('get_template_directory_uri')->toBeCalled()->andReturn('/wp-content/themes/theme/templates');
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->with('wp_script_attributes', [$this->scripts, 'addScriptTypeToJs'], 10, 1);
			$this->scripts->register();
		});
	});

	describe('->wpEnqueueScripts()', function () {
		it('enqueues the main stylesheet and JS', function () {
			allow('get_template_directory_uri')->toBeCalled()->andReturn('/wp-content/themes/govuk-blogs');
			allow('wp_enqueue_style')->toBeCalled();
			allow($this->cssManifest)->toReceive('get')->andReturn('build/main.min.1234.js', 'build/main.min.1234.css');
			expect($this->cssManifest)->toReceive('get')->once()->with('build/main.min.js');
			expect($this->cssManifest)->toReceive('get')->once()->with('build/main.min.css');
			allow('wp_enqueue_script')->toBeCalled();
			expect('wp_enqueue_script')->toBeCalled()->times(2);
			expect('wp_enqueue_script')->toBeCalled()->with('main', '/wp-content/themes/govuk-blogs/build/main.min.1234.js', ['jquery']);
			expect('wp_enqueue_script')->toBeCalled()->with('govuk-frontend', '/wp-content/themes/govuk-blogs/build/govuk-frontend-load.js');
			expect($this->cssManifest)->toReceive('get')->with('build/main.min.css');
			expect('wp_enqueue_style')->toBeCalled()->with('main', '/wp-content/themes/govuk-blogs/build/main.min.1234.css');

			$this->scripts->wpEnqueueScripts();
		});
	});

	describe('->wpEnqueueEditorStyles()', function () {
		it('enqueues the editor stylesheet', function () {
			allow('add_editor_style')->toBeCalled();
			allow($this->cssManifest)->toReceive('get')->andReturn('build/admin.min.1234.css');
			expect($this->cssManifest)->toReceive('get')->once()->with('build/admin.min.css');
			expect('add_editor_style')->toBeCalled()->with('build/admin.min.1234.css');

			$this->scripts->wpEnqueueEditorStyles();
		});
	});
});
