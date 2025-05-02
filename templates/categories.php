<nav class="categories-dropdown">
  <h2><?php _e("Categories", "govuk-blogs"); ?></h2>
  <?php wp_dropdown_categories(['show_option_all' => 'All categories', 'class' => 'js-categories-dropdown']) ?>
</nav>
