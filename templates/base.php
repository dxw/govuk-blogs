<div class="container bar"></div>
<div class="container">
  <?php do_action('get_header') ?>
  <?php get_template_part('templates/header') ?>
  <?php if (is_home()) : ?>
    <?php get_template_part('templates/featured') ?>
  <?php endif ?>
  <main id="content" class="grid-row" role="main">
    <div class="column-two-thirds main-content">
      <?php include roots_template_path() ?>
      <?php if(!is_single() || !is_page()) { get_template_part('templates/paging'); } ?>
    </div>
    <div class="column-one-third sidebar-contain">
      <?php get_template_part('templates/sidebar') ?>
    </div>
</main>
</div>
