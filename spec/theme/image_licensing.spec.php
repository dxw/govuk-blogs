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
			expect('add_filter')->toBeCalled()->once()->with('wp_prepare_attachment_for_js', [$this->imageLicensing, 'appendLicenseToCaption'], 10, 2);
			expect('add_filter')->toBeCalled()->once()->with('render_block_core/image', [$this->imageLicensing, 'renderBlock'], 10, 2);

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

	describe('->appendLicenseToCaption()', function () {
		it('appends license caption to empty caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$response = ['caption' => ''];
			$attachment = (object) ['ID' => 123];

			$result = $this->imageLicensing->appendLicenseToCaption($response, $attachment);
			expect($result['caption'])->toBe(
				'Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">John Doe</a>'
			);
		});

		it('appends license caption while preserving existing caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$response = ['caption' => 'Existing caption'];
			$attachment = (object) ['ID' => 123];
			$meta = [];

			$result = $this->imageLicensing->appendLicenseToCaption($response, $attachment, $meta);
			expect($result['caption'])->toBe(
				"Existing caption\n<br>" .
				'Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">John Doe</a>'
			);
		});

		it('returns unchanged response for non-displayable license', function () {
			$this->mockGetPostMeta([
				'licence' => 'ogl',
				'copyright_holder' => 'Jane Doe',
				'link_to_source' => 'https://example.com/source2'
			]);

			$response = ['caption' => 'Existing caption'];
			$attachment = (object) ['ID' => 127];
			$meta = [];

			$result = $this->imageLicensing->appendLicenseToCaption($response, $attachment, $meta);
			expect($result['caption'])->toBe('Existing caption');
		});
	});

	describe('->renderBlock()', function () {
		it('returns unchanged content when image already has existing license caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = [
				'blockName' => 'core/image',
				'attrs' => ['id' => 123],
				'innerHTML' => '<figure class="wp-block-image"><img src="image.jpg" alt="Test image"><figcaption class="wp-element-caption">Licence: <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution</a></figcaption></figure>'
			];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toBe($blockContent);
		});

		it('returns unchanged content for non-displayable license', function () {
			$this->mockGetPostMeta([
				'licence' => 'ogl',
				'copyright_holder' => 'Jane Doe',
				'link_to_source' => 'https://example.com/source2'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = ['blockName' => 'core/image', 'attrs' => ['id' => 127]];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toBe($blockContent);
		});

		it('adds license caption to image block with valid license and no existing caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = ['blockName' => 'core/image', 'attrs' => ['id' => 123]];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toContain('<figure class="wp-block-image">');
			expect($result)->toContain($blockContent);
			expect($result)->toContain('<figcaption class="caption" data-license-caption="true">');
			expect($result)->toContain('Creative Commons Attribution');
			expect($result)->toContain('https://example.com/source');
			expect($result)->toContain('John Doe');
		});
	});
});
