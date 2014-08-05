<?php

if (function_exists('acf_add_options_sub_page')) {
  acf_add_options_sub_page([
    'title' => 'Theme Options',
    'parent' => 'themes.php',
  ]);
}
