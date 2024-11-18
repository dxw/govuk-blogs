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
			expect('add_filter')->toBeCalled()->times(4);
			expect('add_filter')->toBeCalled()->with('excerpt_length', [$this->oldRootsCleanup, 'excerptLength']);
			expect('add_filter')->toBeCalled()->with('excerpt_more', [$this->oldRootsCleanup, 'excerptMore']);
			expect('add_filter')->toBeCalled()->with('get_bloginfo_rss', [$this->oldRootsCleanup, 'removeDefaultDescription']);
			expect('add_filter')->toBeCalled()->with('img_caption_shortcode', [$this->oldRootsCleanup, 'gdsCaption']);

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

	describe('->gdsCaption()', function () {
		beforeEach(function () {
			$this->output = 'a string';
			$this->attr = [
				'id' => '0',
				'align' => 'none',
				'width'   => 0,
				'caption' => ''
			];
			$this->content = 'the content';
		});
		context('the page is a feed', function () {
			it('returns the original string', function () {
				allow('is_feed')->toBeCalled()->andReturn(true);
				$result = $this->oldRootsCleanup->gdsCaption($this->output, $this->attr, $this->content);
				expect($result)->toEqual('a string');
			});
		});
		context('there is no caption and image width', function () {
			it('returns the content', function () {
				allow('is_feed')->toBeCalled()->andReturn(false);
				allow('shortcode_atts')->toBeCalled()->andReturn($this->attr);
				$result = $this->oldRootsCleanup->gdsCaption($this->output, $this->attr, $this->content);
				expect($result)->toEqual('the content');
			});
		});
		context('there is an image with a caption', function () {
			it('returns a custom string', function () {
				$this->attr = [
					'id' => '0',
					'align' => 'none',
					'width'   => '10',
					'caption' => 'a caption'
				];
				allow('is_feed')->toBeCalled()->andReturn(false);
				allow('shortcode_atts')->toBeCalled()->andReturn($this->attr);
				allow('esc_attr')->toBeCalled()->andReturn('0');
				allow('esc_attr')->toBeCalled()->andReturn('none');
				allow('esc_attr')->toBeCalled()->andReturn('10');
				allow('do_shortcode')->toBeCalled()->with('the content')->andReturn('the content');
				$result = $this->oldRootsCleanup->gdsCaption($this->output, $this->attr, $this->content);
				expect($result)->toEqual('<figure class="thumbnail wp-caption 10" style="width: 10px">the content<figcaption class="caption wp-caption-text">a caption</figcaption></figure>');
			});
		});
	});
});
