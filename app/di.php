<?php

$registrar->addInstance(new \GovUKBlogs\WidgetCategoriesDropdownWithSubmit\Widget());
$registrar->addInstance(new \GovUKBlogs\WidgetCategoriesDropdownWithSubmit\Register(
    $registrar->getInstance(\GovUKBlogs\WidgetCategoriesDropdownWithSubmit\Widget::class)
));
