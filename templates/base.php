<div class="container bar"></div>
<section class="container">
  <?php do_action('get_header') ?>
  <?php get_template_part('templates/header') ?>
  <?php if (is_home()) : ?>
    <?php get_template_part('templates/featured') ?>
  <?php endif ?>
  <div id="content" class="row">
    <div class="span8 main-content">
      <?php include roots_template_path() ?>
      <?php if(!is_single() || !is_page()) { get_template_part('templates/paging'); } ?>
    </div>
    <div class="span4 sidebar-contain">
      <?php get_template_part('templates/sidebar') ?>
    </div>
  </div>
</section>
