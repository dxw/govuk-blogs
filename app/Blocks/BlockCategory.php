<?php

namespace GovUKBlogs\Blocks;

class BlockCategory implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_filter('block_categories_all', [$this, 'addCustomCategory']);
	}

	public function addCustomCategory(array $categories): array
	{
		array_unshift($categories, [
			'slug' => 'govuk-components',
			'title' => 'GOV.UK components'
		]);

		return $categories;
	}
}
