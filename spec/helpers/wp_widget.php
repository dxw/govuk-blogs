<?php

class WP_Widget
{
	public $__constructorArguments;
	public $id_base;
	public $number;

	public function __construct()
	{
		$this->__constructorArguments = func_get_args();
	}
}
