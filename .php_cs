<?php

$finder = \PhpCsFixer\Finder::create()
->exclude('vendor')
->in(__DIR__);

return \Dxw\PhpCsFixerConfig\Config::create()
->setFinder($finder);
