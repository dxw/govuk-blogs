<?php

describe(GovUKBlogs\Theme\OldRootsCleanup::class, function () {
	beforeEach(function () {
		$this->oldRootsCleanup = new GovUKBlogs\Theme\OldRootsCleanup();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->oldRootsCleanup)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the filters', function () {
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->times(3);
			expect('add_filter')->toBeCalled()->with('excerpt_length', [$this->oldRootsCleanup, 'excerptLength']);
			expect('add_filter')->toBeCalled()->with('excerpt_more', [$this->oldRootsCleanup, 'excerptMore']);
			expect('add_filter')->toBeCalled()->with('get_bloginfo_rss', [$this->oldRootsCleanup, 'removeDefaultDescription']);

			$this->oldRootsCleanup->register();
		});
	});

	describe('->excerptLength()', function () {
		it('returns the excerpt length constant', function () {
			define('POST_EXCERPT_LENGTH', 40);
			$length = 45;
			$value = $this->oldRootsCleanup->excerptLength($length);
			expect($value)->toEqual(40);
		});
	});

	describe('->excerptMore()', function () {
		it('returns a custom excerpt string', function () {
			allow('get_permalink')->toBeCalled()->andReturn('http://localhost.com');
			allow('__')->toBeCalled()->andReturn('Continued');
			$more = 'Read more';
			$value = $this->oldRootsCleanup->excerptMore($more);
			expect($value)->toEqual(' &hellip; <a href="' . 'http://localhost.com' . '">' . 'Continued' . '</a>');
		});
	});
});
