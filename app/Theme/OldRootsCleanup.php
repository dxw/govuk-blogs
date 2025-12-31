<?php

namespace GovUKBlogs\Theme;

class OldRootsCleanup implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_filter('excerpt_length', [$this, 'excerptLength']);
		add_filter('excerpt_more', [$this, 'excerptMore']);
		add_filter('get_bloginfo_rss', [$this, 'removeDefaultDescription']);
		add_filter('img_caption_shortcode', [$this, 'gdsCaption'], 10, 3);
	}

	/**
	 * Clean up the_excerpt()
	 */
	public function excerptLength($length): int
	{
		return POST_EXCERPT_LENGTH;
	}

	public function excerptMore($more): string
	{
		return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
	}

	/**
	* Don't return the default description in the RSS feed if it hasn't been changed
	*/
	public function removeDefaultDescription($bloginfo): string
	{
		$default_tagline = 'Just another WordPress site';
		return ($bloginfo === $default_tagline) ? '' : $bloginfo;
	}

	/**
	 * Add Bootstrap thumbnail styling to images with captions
	 * Use <figure> and <figcaption>
	 *
	 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
	 */
	public function gdsCaption($output, $attr, $content): string
	{
		if (is_feed()) {
			return $output;
		}

		$defaults = [
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
		];

		$attr = shortcode_atts($defaults, $attr);

		// // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
		if ($attr['width'] < 1 || empty($attr['caption'])) {
			return $content;
		}

		// Set up the attributes for the caption <figure>
		$attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '');
		$attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
		$attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

		$output  = '<figure' . $attributes .'>';
		$output .= do_shortcode($content);
		$output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
		$output .= '</figure>';

		return $output;
	}
}
