<?php

namespace GovUKBlogs\WidgetCategoriesDropdownWithSubmit;

class Widget extends \WP_Widget
{
	public function __construct()
	{
		parent::__construct('categories-dropdown-with-submit', 'Categories Dropdown With Submit', [
			'classname' => 'widget_categories',
			'description' => 'The same as "Categories" but with a submit button',
		]);
	}

	public function widget($args, $instance): void
	{
		$title = 'Categories';

		echo $args['before_widget'];

		echo $args['before_title'] . $title . $args['after_title'];

		echo sprintf('<form action="%s" method="get">', esc_url(home_url()));
		$dropdown_id    = "{$this->id_base}-dropdown-with-submit-{$this->number}";

		echo '<label class="govuk-visually-hidden" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

		wp_dropdown_categories([
			'orderby'      => 'name',
			'show_count'   => '0',
			'hierarchical' => '0',
			'show_option_none' => 'Select Category',
			'id'               => $dropdown_id,
			'class' => 'govuk-select'
		]);

		echo '<button class="govuk-button" data-module="govuk-button">Go</button>';

		echo '</form>';

		echo $args['after_widget'];
	}
}
