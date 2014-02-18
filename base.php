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
  'content' => \Missing\String::get_output(function () {
    ?>
    <section class="container">
      <?php do_action('get_header') ?>
      <?php get_template_part('templates/header') ?>
      <?php if (is_home()) : ?>
        <?php get_template_part('templates/featured') ?>
      <?php endif ?>
      <div class="row">
        <div class="span8 main-content">
          <?php include roots_template_path() ?>
          <?php if(!is_single() || !is_page()) { get_template_part('templates/paging'); } ?>
        </div>
        <div class="span4 sidebar-contain">
          <?php get_template_part('templates/sidebar') ?>
        </div>
      </div>
    </section>
    <?php
  }),
  'bodyEnd' => \Missing\String::get_output('wp_footer'),
]);
