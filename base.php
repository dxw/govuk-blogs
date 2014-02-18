<?php

$m = new Mustache_Engine([
  'loader' => new Mustache_Loader_FilesystemLoader(__DIR__.'/build/govuk_template/views/layouts', [
    'extension' => '.html',
  ]),
]);

$template = $m->loadTemplate('govuk_template');

echo $template->render([
  'pageTitle' => \Missing\String::get_output(function () { wp_title('|', true, 'right'); }),
  'assetPath' => get_template_directory_uri().'/build/govuk_template/assets/',
  'head' => \Missing\String::get_output('wp_head'),
  'bodyClasses' => \Missing\String::get_output('body_class'),
  'content' => \Missing\String::get_output(function () { get_template_part('templates/base'); }),
  'footerSupportLinks' => \Missing\String::get_output(function () { get_template_part('templates/footer'); }),
  'bodyEnd' => \Missing\String::get_output('wp_footer'),
]);
