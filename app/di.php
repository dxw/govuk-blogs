<?php

// Iguana theme setup
$registrar->addInstance(new \Dxw\Iguana\Theme\Helpers());
$registrar->addInstance(new \Dxw\Iguana\Theme\LayoutRegister(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));

$registrar->addInstance(new \GovUKBlogs\WidgetCategoriesDropdownWithSubmit\Register());
$registrar->addInstance(new \GovUKBlogs\WidgetArchiveDropdownWithSubmit\Register());
$registrar->addInstance(new \GovUKBlogs\FixRoots());
$registrar->addInstance(new \GovUKBlogs\OpenGraphImage());
$registrar->addInstance(new \GovUKBlogs\Embed\YouTube());
