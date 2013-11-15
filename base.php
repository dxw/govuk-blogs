<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lte-ie8 lte-ie7 lte-ie6" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lte-ie8 lte-ie7" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lte-ie8" <?php language_attributes() ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('|', true, 'right') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <?php wp_head() ?>
    
  </head>
  <body <?php body_class() ?>>

    <?php get_template_part('templates/govuk') ?>

    <section class="container">
      <?php do_action('get_header') ?>
      <?php get_template_part('templates/header') ?>
      <?php if (is_home()) : ?>
        <?php get_template_part('templates/featured') ?>
      <?php endif ?>

      <div class="row">
        <div class="span8 main-content">
          <?php include roots_template_path() ?>
          <?php if(!is_single() || !is_page()) {
            get_template_part('templates/paging');
            } ?>
        </div>
        <div class="span4 sidebar-contain">
          <?php get_template_part('templates/sidebar') ?>
        </div>
      </div>
    </section>

    <?php get_template_part('templates/footer') ?>
    <?php wp_footer() ?>

  </body>
</html>
