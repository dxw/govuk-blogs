<?php

namespace GovUKBlogs\WidgetCategoriesDropdownWithSubmit;

class Register implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('widgets_init', [$this, 'widgetsInit']);
	}

	public function widgetsInit(): void
	{
		register_widget(Widget::class);
	}
}
