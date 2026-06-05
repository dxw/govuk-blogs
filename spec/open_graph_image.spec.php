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
		it('adds action and sets default image', function () {
			allow('get_template_directory_uri')->toBeCalled()->andReturn('https://govuk-blog.invalid/wp-content/themes/gds-blogs');
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->with('wp_head', [$this->openGraphImage, 'wpHead'])->once();

			$this->openGraphImage->register();
		});
	});

	describe('->wpHead()', function () {
		context('when not on a post/page', function () {
			beforeEach(function () {
				allow('is_single')->toBeCalled()->andReturn(false);
				allow('esc_url')->toBeCalled()->andReturn('https://govuk-blog.invalid/wp-content/themes/gds-blogs/build/govuk-assets/images/govuk-opengraph-image.png');
			});

			it('outputs the default og:image tag', function () {
				ob_start();
				$this->openGraphImage->wpHead();
				$output = ob_get_clean();
				expect($output)->toEqual('<meta property="og:image" content="https://govuk-blog.invalid/wp-content/themes/gds-blogs/build/govuk-assets/images/govuk-opengraph-image.png">'."\n");
			});
		});

		context('when on a post', function () {
			beforeEach(function () {
				allow('is_single')->toBeCalled()->andReturn(true);
			});

			context('when there is no featured image', function () {
				beforeEach(function () {
					allow('has_post_thumbnail')->toBeCalled()->andReturn(false);
					allow('esc_url')->toBeCalled()->andReturn('https://govuk-blog.invalid/wp-content/themes/gds-blogs/build/govuk-assets/images/govuk-opengraph-image.png');
				});

				it('outputs the default og:image tag', function () {
					ob_start();
					$this->openGraphImage->wpHead();
					$output = ob_get_clean();
					expect($output)->toEqual('<meta property="og:image" content="https://govuk-blog.invalid/wp-content/themes/gds-blogs/build/govuk-assets/images/govuk-opengraph-image.png">'."\n");
				});
			});

			context('there is a featured image', function () {
				beforeEach(function () {
					allow('has_post_thumbnail')->toBeCalled()->andReturn(true);
					allow('get_the_post_thumbnail_url')->toBeCalled()->andReturn('https://govuk-blog.invalid/wp-content/uploads/my-image.png');
					allow('esc_url')->toBeCalled()->andReturn('https://govuk-blog.invalid/wp-content/uploads/my-image.png');
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
