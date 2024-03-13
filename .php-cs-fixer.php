<?php

$finder = \PhpCsFixer\Finder::create()
->exclude('vendor')
->exclude('node_modules')
->exclude('local')
->in(__DIR__);

return \Dxw\PhpCsFixerConfig\Config::create()
->setFinder($finder);
