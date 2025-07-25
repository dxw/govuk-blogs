<?php

// Iguana theme setup
$registrar->addInstance(new \Dxw\Iguana\Theme\Helpers());
$registrar->addInstance(new \Dxw\Iguana\Theme\LayoutRegister(
	$registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));

// Blocks
$registrar->addInstance(new \GovUKBlogs\Blocks\BlockCategory());
$registrar->addInstance(new \GovUKBlogs\Blocks\AllowedBlocks());
$registrar->addInstance(new \GovUKBlogs\Blocks\Details\Block());
$registrar->addInstance(new \GovUKBlogs\Blocks\InsetText\Block());
$registrar->addInstance(new \GovUKBlogs\Blocks\Accordion\Block());
$registrar->addInstance(new \GovUKBlogs\Blocks\AccordionRow\Block());

// Theme
$registrar->addInstance(new \GovUKBlogs\Theme\ThemeSupports());
$registrar->addInstance(new \GovUKBlogs\WidgetCategoriesDropdownWithSubmit\Register());
$registrar->addInstance(new \GovUKBlogs\WidgetArchiveDropdownWithSubmit\Register());
$registrar->addInstance(new \GovUKBlogs\OpenGraphImage());
$registrar->addInstance(new \GovUKBlogs\Embed\YouTube());
$registrar->addInstance(new \GovUKBlogs\Theme\CSSManifest(dirname(__FILE__, 2) . '/build/fingerprint.json'));
$registrar->addInstance(new \GovUKBlogs\Theme\ImageLicensing());
$registrar->addInstance(new \GovUKBlogs\Theme\Scripts(
	$registrar->getInstance(\GovUKBlogs\Theme\CSSManifest::class)
));
$registrar->addInstance(new \GovUKBlogs\Theme\ThemeSetup());
$registrar->addInstance(new \GovUKBlogs\Theme\OldRootsCleanup());
$registrar->addInstance(new \GovUKBlogs\Theme\FixNonExistentAuthors());
