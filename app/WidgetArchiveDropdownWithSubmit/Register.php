<?php

namespace GovUKBlogs\WidgetArchiveDropdownWithSubmit;

class Register implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('widgets_init', [$this, 'widgetsInit']);
	}

	public function widgetsInit()
	{
		register_widget(Widget::class);
	}
}
