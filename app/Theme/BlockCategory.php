<?php

namespace GovUKBlogs\Theme;

class BlockCategory implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_filter('block_categories_all', [$this, 'addCustomCategory']);
	}

	public function addCustomCategory($categories)
	{
		array_unshift($categories, [
			'slug' => 'govuk-components',
			'title' => 'GOV.UK components'
		]);

		return $categories;
	}
}
