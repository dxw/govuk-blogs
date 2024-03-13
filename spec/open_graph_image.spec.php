<?php

namespace GovUKBlogs;

describe(OpenGraphImage::class, function () {
	beforeEach(function () {
		$this->openGraphImage = new OpenGraphImage();
	});

	it('is registerable', function () {
		expect($this->openGraphImage)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds action', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->with('wp_head', [$this->openGraphImage, 'wpHead'])->once();

			$this->openGraphImage->register();
		});
	});

	describe('->wpHead()', function () {
		context('when not on a post/page', function () {
			beforeEach(function () {
				allow('is_single')->toBeCalled()->andReturn(false);
			});

			it('does nothing', function () {
				ob_start();
				$this->openGraphImage->wpHead();
				$output = ob_get_clean();
				expect($output)->toEqual('');
			});
		});

		context('when on a post', function () {
			beforeEach(function () {
				allow('is_single')->toBeCalled()->andReturn(true);
			});

			context('when there is no featured image', function () {
				beforeEach(function () {
					allow('has_post_thumbnail')->toBeCalled()->andReturn(false);
				});

				it('does nothing', function () {
					ob_start();
					$this->openGraphImage->wpHead();
					$output = ob_get_clean();
					expect($output)->toEqual('');
				});
			});

			context('there is a featured image', function () {
				beforeEach(function () {
					allow('has_post_thumbnail')->toBeCalled()->andReturn(true);
					allow('get_the_post_thumbnail_url')->toBeCalled()->andReturn('https://govuk-blog.invalid/wp-content/uploads/my-image.png');
				});

				it('outputs an og:image tag', function () {
					ob_start();
					$this->openGraphImage->wpHead();
					$output = ob_get_clean();
					expect($output)->toEqual('<meta property="og:image" content="https://govuk-blog.invalid/wp-content/uploads/my-image.png">'."\n");
				});
			});
		});
	});
});
