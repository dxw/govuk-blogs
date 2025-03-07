<div class="sidebar">
  <h2 class="govuk-heading-m govuk-visually-hidden"><?php _e("Related content and links", "govuk-blogs"); ?></h2>
  <?php dynamic_sidebar('sidebar') ?>
  <?php if (!is_home()) {
  	dynamic_sidebar('page-sidebar');
  } else {
  	dynamic_sidebar('home-sidebar');
  } ?>
</div>
