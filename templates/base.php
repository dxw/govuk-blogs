<div class="govuk-width-container">
  <?php do_action('get_header') ?>
  <?php get_template_part('templates/header') ?>
  <?php if (get_post_status() === 'private') : ?>
      <div class="private-notice">
          <p><strong>This content is private.</strong> It cannot be viewed by anybody except logged in users of this site.</p>
      </div>
  <?php endif ?>
  <?php if (is_home()) : ?>
    <?php get_template_part('templates/featured') ?>
  <?php endif ?>
  <main id="content" class="govuk-grid-row" role="main">
    <div class="govuk-grid-column-two-thirds main-content">
      <?php include roots_template_path() ?>
      <?php if (!is_single() || !is_page()) {
      	get_template_part('templates/paging');
      } ?>
    </div>
    <div class="govuk-grid-column-one-third sidebar-contain">
      <?php get_template_part('templates/sidebar') ?>
    </div>
</main>
</div>
