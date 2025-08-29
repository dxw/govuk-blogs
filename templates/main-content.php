<div class="govuk-width-container">
  <?php do_action('get_header') ?>
  <?php get_template_part('templates/header') ?>
  <?php if (get_post_status() === 'private') : ?>
      <div class="private-notice">
          <p><strong><?php _e("This content is private.", "govuk-blogs"); ?></strong>
          <?php _e("It cannot be viewed by anybody except logged in users of this site.", "govuk-blogs"); ?></p>
      </div>
  <?php endif ?>
  <?php if (is_home()) : ?>
    <?php get_template_part('templates/featured') ?>
  <?php endif ?>
  <main id="content" class="govuk-grid-row">
    <div class="govuk-grid-column-two-thirds main-content">
		<?php h()->w_requested_template() ?>
      <?php if (!is_single() || !is_page()) {
      	get_template_part('templates/paging');
      } ?>
    </div>
    <div class="govuk-grid-column-one-third sidebar-contain">
      <?php get_template_part('templates/sidebar') ?>
    </div>
</main>
</div>
