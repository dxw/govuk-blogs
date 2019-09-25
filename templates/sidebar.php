<aside class="sidebar" role="complementary">
  <h2 class="visually-hidden">Related content and links</h2>
  <?php dynamic_sidebar('sidebar') ?>
  <?php if (!is_home()) {
    dynamic_sidebar('page-sidebar');
} else {
    dynamic_sidebar('home-sidebar');
} ?>
</aside>
