<?php

namespace GovUKBlogs\Theme;

class OldRootsCleanup implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_filter('excerpt_length', [$this, 'excerptLength']);
		add_filter('excerpt_more', [$this, 'excerptMore']);
		add_filter('get_bloginfo_rss', [$this, 'removeDefaultDescription']);
	}

	/**
	 * Clean up the_excerpt()
	 */
	public function excerptLength($length)
	{
		return POST_EXCERPT_LENGTH;
	}

	public function excerptMore($more)
	{
		return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
	}

	/**
	* Don't return the default description in the RSS feed if it hasn't been changed
	*/
	public function removeDefaultDescription($bloginfo)
	{
		$default_tagline = 'Just another WordPress site';
		return ($bloginfo === $default_tagline) ? '' : $bloginfo;
	}
}
