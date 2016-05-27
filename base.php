<?php

$engine = new Mustache_Engine([
  'loader' => new Mustache_Loader_FilesystemLoader(__DIR__.'/build/govuk_template/views/layouts', [
    'extension' => '.html',
  ]),
]);

$template = $engine->loadTemplate('govuk_template');

echo $template->render([
  'pageTitle' => html_entity_decode(wp_title('|', false, 'right'), ENT_HTML5 | ENT_QUOTES), // Apparently it doesn't unescape quotes by default for some reason
  'assetPath' => get_template_directory_uri().'/build/govuk_template/assets/',
  'head' => \Missing\Strings::getOutput('wp_head'),
  'bodyClasses' => implode(' ', array_map('esc_attr', get_body_class())),
  'cookieMessage' => \Missing\Strings::getOutput(function () { get_template_part('templates/cookies'); }),
  'content' => \Missing\Strings::getOutput(function () { get_template_part('templates/base'); }),
  'footerSupportLinks' => \Missing\Strings::getOutput(function () { get_template_part('templates/footer'); }),
  'bodyEnd' => \Missing\Strings::getOutput('wp_footer'),
]);
