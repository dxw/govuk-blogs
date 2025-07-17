<?php

use GovUKBlogs\Theme\ImageLicensing;

describe(\GovUKBlogs\Theme\ImageLicensing::class, function () {
	beforeEach(function () {
		$this->imageLicensing = new \GovUKBlogs\Theme\ImageLicensing();

		ImageLicensing::$imageLicences = [
			'cc-by' => [
				'display' => true,
				'name' => 'Creative Commons Attribution',
				'link' => 'https://creativecommons.org/licences/by/4.0/'
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
			expect('add_filter')->toBeCalled()->once()->with('wp_prepare_attachment_for_js', [$this->imageLicensing, 'appendLicenceToCaption'], 10, 2);
			expect('add_filter')->toBeCalled()->once()->with('render_block_core/image', [$this->imageLicensing, 'renderBlock'], 10, 2);

			$this->imageLicensing->register();
		});
	});

	describe('->appendLicenceToCaption()', function () {
		it('appends licence caption to empty caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$response = ['caption' => ''];
			$attachment = (object) ['ID' => 123];

			$result = $this->imageLicensing->appendLicenceToCaption($response, $attachment);
			expect($result['caption'])->toBe(
				'Licence: <a href="https://creativecommons.org/licences/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">John Doe</a>'
			);
		});

		it('appends licence with copyright holder only', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => ''
			]);

			$response = ['caption' => ''];
			$attachment = (object) ['ID' => 124];

			$result = $this->imageLicensing->appendLicenceToCaption($response, $attachment);

			expect($result['caption'])->toBe(
				'Licence: <a href="https://creativecommons.org/licences/by/4.0/">Creative Commons Attribution</a> John Doe'
			);
		});

		it('appends licence with source link only', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => '',
				'link_to_source' => 'https://example.com/source'
			]);

			$response = ['caption' => ''];
			$attachment = (object) ['ID' => 125];

			$result = $this->imageLicensing->appendLicenceToCaption($response, $attachment);

			expect($result['caption'])->toBe(
				'Licence: <a href="https://creativecommons.org/licences/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">Source</a>'
			);
		});

		it('appends licence with no attribution details provided', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => '',
				'link_to_source' => ''
			]);

			$response = ['caption' => ''];
			$attachment = (object) ['ID' => 126];

			$result = $this->imageLicensing->appendLicenceToCaption($response, $attachment);

			expect($result['caption'])->toBe(
				'Licence: <a href="https://creativecommons.org/licences/by/4.0/">Creative Commons Attribution</a>'
			);
		});

		it('appends licence caption while preserving existing caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$response = ['caption' => 'Existing caption'];
			$attachment = (object) ['ID' => 123];
			$meta = [];

			$result = $this->imageLicensing->appendLicenceToCaption($response, $attachment, $meta);
			expect($result['caption'])->toBe(
				"Existing caption\n<br>" .
				'Licence: <a href="https://creativecommons.org/licences/by/4.0/">Creative Commons Attribution</a> ' .
				'<a href="https://example.com/source">John Doe</a>'
			);
		});

		it('returns unchanged response for non-displayable licence', function () {
			$this->mockGetPostMeta([
				'licence' => 'ogl',
				'copyright_holder' => 'Jane Doe',
				'link_to_source' => 'https://example.com/source2'
			]);

			$response = ['caption' => 'Existing caption'];
			$attachment = (object) ['ID' => 127];
			$meta = [];

			$result = $this->imageLicensing->appendLicenceToCaption($response, $attachment, $meta);
			expect($result['caption'])->toBe('Existing caption');
		});
	});

	describe('->renderBlock()', function () {
		it('returns unchanged content when no licence is chosen', function () {
			$this->mockGetPostMeta([
				'licence' => '',
				'copyright_holder' => '',
				'link_to_source' => ''
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = [
				'blockName' => 'core/image',
				'attrs' => ['id' => 124],
				'innerHTML' => '<img>'
			];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toBe($blockContent);
		});

		it('returns unchanged content when image already has existing licence caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = [
				'blockName' => 'core/image',
				'attrs' => ['id' => 123],
				'innerHTML' => '<figure class="wp-block-image"><img src="image.jpg" alt="Test image"><figcaption class="wp-element-caption">Licence: <a href="https://creativecommons.org/licences/by/4.0/">Creative Commons Attribution</a></figcaption></figure>'
			];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toBe($blockContent);
		});

		it('returns unchanged content for non-displayable licence', function () {
			$this->mockGetPostMeta([
				'licence' => 'ogl',
				'copyright_holder' => 'Jane Doe',
				'link_to_source' => 'https://example.com/source2'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = [
				'blockName' => 'core/image',
				'attrs' => ['id' => 127],
				'innerHTML' => '<img>'
			];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toBe($blockContent);
		});

		it('adds licence caption to image block with valid licence and no existing caption', function () {
			$this->mockGetPostMeta([
				'licence' => 'cc-by',
				'copyright_holder' => 'John Doe',
				'link_to_source' => 'https://example.com/source'
			]);

			$blockContent = '<img src="image.jpg" alt="Test image">';
			$block = [
				'blockName' => 'core/image',
				'attrs' => ['id' => 123],
				'innerHTML' => '<img>'
			];

			$result = $this->imageLicensing->renderBlock($blockContent, $block);
			expect($result)->toContain('<figure class="wp-block-image">');
			expect($result)->toContain($blockContent);
			expect($result)->toContain('<figcaption class="caption">');
			expect($result)->toContain('Creative Commons Attribution');
			expect($result)->toContain('https://example.com/source');
			expect($result)->toContain('John Doe');
		});
	});
});
