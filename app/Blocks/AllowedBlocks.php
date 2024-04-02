<?php

namespace GovUKBlogs\Blocks;

class AllowedBlocks implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_filter('allowed_block_types_all', [$this, 'limitAllowedBlocks'], 10, 2);
	}

	public function limitAllowedBlocks($allowed_block_types, $block_editor_context)
	{
		if (! empty($block_editor_context->post)) {
			return [
				'core/archives',
				'core/audio',
				'core/avatar',
				'core/block',
				'core/button',
				'core/buttons',
				'core/calendar',
				'core/categories',
				'core/code',
				'core/column',
				'core/columns',
				'core/cover',
				'core/embed',
				'core/file',
				'core/footnotes',
				'core/freeform',
				'core/gallery',
				'core/group',
				'core/heading',
				'core/home-link',
				'core/html',
				'core/image',
				'core/latest-comments',
				'core/latest-posts',
				'core/list',
				'core/list-item',
				'core/media-text',
				'core/missing',
				'core/more',
				'core/navigation',
				'core/navigation-link',
				'core/navigation-submenu',
				'core/nextpage',
				'core/page-list',
				'core/page-list-item',
				'core/paragraph',
				'core/pattern',
				'core/post-author',
				'core/post-author-biography',
				'core/post-author-name',
				'core/post-comments-count',
				'core/post-comments-form',
				'core/post-comments-link',
				'core/post-content',
				'core/post-date',
				'core/post-excerpt',
				'core/post-featured-image',
				'core/post-navigation-link',
				'core/post-terms',
				'core/post-time-to-read',
				'core/post-title',
				'core/preformatted',
				'core/query',
				'core/query-no-results',
				'core/query-pagination',
				'core/query-pagination-next',
				'core/query-pagination-numbers',
				'core/query-pagination-previous',
				'core/query-title',
				'core/quote',
				'core/read-more',
				'core/rss',
				'core/search',
				'core/separator',
				'core/shortcode',
				'core/site-logo',
				'core/site-tagline',
				'core/site-title',
				'core/social-link',
				'core/social-links',
				'core/spacer',
				'core/table',
				'core/table-of-contents',
				'core/term-description',
				'core/video',
				'govukblogs/accordion',
				'govukblogs/accordion-row',
				'govukblogs/details',
				'govukblogs/inset-text',
				'govukblogs/buttons'
			];
		}

		return $block_editor_context;
	}
}
