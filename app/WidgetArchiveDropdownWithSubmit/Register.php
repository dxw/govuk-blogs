<?php

namespace GovUKBlogs\WidgetArchiveDropdownWithSubmit;

class Register implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('widgets_init', [$this, 'widgetsInit'], 10, 0);
	}

	public function widgetsInit(): void
	{
		register_widget(Widget::class);
	}
}
