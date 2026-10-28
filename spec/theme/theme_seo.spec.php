<?php

describe(GovUKBlogs\Theme\SEO::class, function () {
	beforeEach(function () {
		$this->seo = new GovUKBlogs\Theme\SEO();
	});

	it('implements \Dxw\Iguana\Registerable', function () {
		expect($this->seo)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds a filter to wp_robots', function () {
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->once()->with('wp_robots', [$this->seo, 'noindex']);
			$this->seo->register();
		});
	});

	describe('->noindex()', function () {
		context('the post is password protected', function () {
			it('adds noindex to the robots array', function () {
				$post = (object) [
					"post_password" => "password"
				];
				allow('get_post')->toBeCalled()->andReturn($post);
				$robots = [];
				expect($this->seo->noindex($robots))->toEqual(['noindex' => true]);
			});
		});
		context('the post is not password protected', function () {
			it('does not add noindex to the robots array', function () {
				$post = (object) [
					"post_password" => ""
				];
				allow('get_post')->toBeCalled()->andReturn($post);
				$robots = [];
				expect($this->seo->noindex($robots))->toEqual([]);
			});
		});
	});
});
