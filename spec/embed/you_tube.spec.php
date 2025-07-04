<?php

namespace GovUKBlogs\Embed;

describe(YouTube::class, function () {
	beforeEach(function () {
		$this->youTube = new YouTube();

		allow('esc_attr')->toBeCalled()->andRun(function ($a) {
			return "_{$a}_";
		});
	});

	it('is registerable', function () {
		expect($this->youTube)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('registers hooks', function () {
			allow('add_filter')->toBeCalled();

			expect('add_filter')->toBeCalled()->with('oembed_dataparse', [$this->youTube, 'hideRelated'])->once();
			expect('add_filter')->toBeCalled()->with('oembed_dataparse', [$this->youTube, 'useNocookie'])->once();

			$this->youTube->register();
		});
	});

	describe('->hideRelated()', function () {
		context('with no youtube link', function () {
			it('does nothing', function () {
				$output = $this->youTube->hideRelated('abc http://foo.bar.invalid/');
				expect($output)->toEqual('abc http://foo.bar.invalid/');
			});
		});

		context('with youtube link', function () {
			it('modifies link', function () {
				$output = $this->youTube->hideRelated('abc https://youtube.com/xyz?feature=oembed&xyz');
				expect($output)->toEqual('abc https://youtube.com/xyz?wmode=transparent&amp;rel=0&xyz');
			});
		});

		context('when there are extra parameters', function () {
			it('does nothing', function () {
				$output = $this->youTube->hideRelated('foo', 'http://xyz.invalid/', [1, 2, 3]);
				expect($output)->toEqual('foo');
			});
		});
	});

	describe('->useNocookie()', function () {
		context('when it does not contain youtube links', function () {
			it('does nothing', function () {
				$output = $this->youTube->useNocookie('abc http://foo.bar.invalid/');
				expect($output)->toEqual('abc http://foo.bar.invalid/');
			});
		});

		context('when it contains youtube links (1)', function () {
			it('replaces www.youtube.com with www.youtube-nocookie.com', function () {
				$output = $this->youTube->useNocookie('abc https://www.youtube.com/');
				expect($output)->toEqual('abc https://www.youtube-nocookie.com/');
			});
		});

		context('when it contains youtube links (2)', function () {
			it('replaces youtube.com with www.youtube-nocookie.com', function () {
				$output = $this->youTube->useNocookie('abc https://youtube.com/');
				expect($output)->toEqual('abc https://www.youtube-nocookie.com/');
			});
		});

		context('when there are extra parameters', function () {
			it('does nothing', function () {
				$output = $this->youTube->useNocookie('foo', 'http://xyz.invalid/', 'bar', 123);
				expect($output)->toEqual('foo');
			});
		});
	});
});
