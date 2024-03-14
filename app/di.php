<?php

$registrar->addInstance(new \GovUKBlogs\WidgetCategoriesDropdownWithSubmit\Register());
$registrar->addInstance(new \GovUKBlogs\WidgetArchiveDropdownWithSubmit\Register());
$registrar->addInstance(new \GovUKBlogs\FixRoots());
$registrar->addInstance(new \GovUKBlogs\OpenGraphImage());
$registrar->addInstance(new \GovUKBlogs\Embed\YouTube());
$registrar->addInstance(new \GovUKBlogs\Theme\CSSManifest(dirname(__FILE__, 2) . '/build/fingerprint.json'));
$registrar->addInstance(new \GovUKBlogs\Theme\Scripts(
	$registrar->getInstance(\GovUKBlogs\Theme\CSSManifest::class)
));
