<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lte-ie8 lte-ie7 lte-ie6" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lte-ie8 lte-ie7" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lte-ie8" <?php language_attributes() ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('|', true, 'right') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
    <!--[if IE 8]>
    <script type="text/javascript">
      (function(){if(window.opera){return;}
      setTimeout(function(){var a=document,g,b={families:(g=
      ["nta"]),urls:["https://assets.digital.cabinet-office.gov.uk/static/fonts-ie8-beb10cbc00c9b7dcdbdee824962bc5f6.css"]},
      c="https://assets.digital.cabinet-office.gov.uk/static/libs/goog/webfont-debug-96870cf9f159ed811fd43c39bdf4656b.js",d="script",
      e=a.createElement(d),f=a.getElementsByTagName(d)[0],h=g.length;WebFontConfig
      ={custom:b},e.src=c,f.parentNode.insertBefore(e,f);for(;h=h-1;a.documentElement
      .className+=' wf-'+g[h].replace(/\s/g,'').toLowerCase()+'-n4-loading');},0)
      })()
    </script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
      <link href="https://assets.digital.cabinet-office.gov.uk/static/fonts-0fb6b917e34e45c93a44eec72dcc21de.css" media="all" rel="stylesheet" type="text/css" />
    <!--<![endif]-->
  </head>
  <body <?php body_class() ?>>

    <?php get_template_part('templates/govuk') ?>
    <div class="js-cookies-banner"></div>

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
