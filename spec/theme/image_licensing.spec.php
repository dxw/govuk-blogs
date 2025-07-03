<?php

use GovUKBlogs\Theme\ImageLicensing;

describe(\GovUKBlogs\Theme\ImageLicensing::class, function () {
	beforeEach(function () {
		$this->imageLicensing = new \GovUKBlogs\Theme\ImageLicensing();

		ImageLicensing::$imageLicenses = [
			'cc-by' => [
				'display' => true,
				'name' => 'Creative Commons Attribution',
				'link' => 'https://creativecommons.org/licenses/by/4.0/'
			],
			'ogl' => [
				'display' => false,
				'name' => 'OGL',
				'link' => 'http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/'
			]
		];

		allow('esc_attr')->toBeCalled()->andRun(function ($text) {
			return $text;
		});

		allow('esc_html')->toBeCalled()->andRun(function ($text) {
			return $text;
		});

		$this->mockGetPostMeta = function ($metadata) {
			allow('get_post_meta')->toBeCalled()->andRun(function ($attachmentId, $key, $single) use ($metadata) {
				return $metadata[$key];
			});
		};
	});

	it('implements the Registerable interface', function () {
		expect($this->imageLicensing)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the filters', function () {
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->once()->with('render_block', [$this->imageLicensing, 'renderBlock']);

			$this->imageLicensing->register();
		});
	});

	describe('->generateLicenseCaption()', function () {
		it('returns license with copyright holder linked to source when both are provided', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$result = $this->imageLicensing->generateLicenseCaption(123);
			expect($result)->toBe(
				'Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">John Doe</a>'
			);
		});

		it('returns license with copyright holder when only copyright holder is provided', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => ''
			]);

			$result = $this->imageLicensing->generateLicenseCaption(124);
			expect($result)->toBe(
				'Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a> John Doe'
			);
		});

		it('returns license with source link when only link to source is provided', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => '',
				'link_to_source' => 'https://example.com/source'
			]);

			$result = $this->imageLicensing->generateLicenseCaption(125);
			expect($result)->toBe(
				'Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">Source</a>'
			);
		});

		it('returns only license when neither copyright holder nor link to source is provided', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => '',
				'link_to_source' => ''
			]);

			$result = $this->imageLicensing->generateLicenseCaption(126);
			expect($result)->toBe(
				'Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a>'
			);
		});

		it('returns null for a non-displayable license', function () {
			$this->mockGetPostMeta([
				'licence' => 'ogl',
				'copyright_holder' => 'Jane Doe',
				'link_to_source' => 'https://example.com/source2'
			]);

			$result = $this->imageLicensing->generateLicenseCaption(127);
			expect($result)->toBe(null);
		});
	});
	describe('->renderBlock()', function () {
		it('returns unchanged content for non-image blocks', function () {
			$blockContent = '<p>Some content</p>';
			$block = ['blockName' => 'core/paragraph', 'attrs' => ['id' => 123]];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toBe($blockContent);
		});

		it('adds license caption to image block with valid license', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = ['blockName' => 'core/image', 'attrs' => ['id' => 123]];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toContain($blockContent);
			expect($result)->toContain('<figcaption class="caption" data-license-caption="true">');
			expect($result)->toContain('Creative Commons Attribution');
			expect($result)->toContain('https://example.com/source');
			expect($result)->toContain('John Doe');
		});
	});

});
