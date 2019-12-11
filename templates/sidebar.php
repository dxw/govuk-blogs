<aside class="sidebar" role="complementary">
  <h2 class="visuallyhidden">Related content and links</h2>
  <?php dynamic_sidebar('sidebar') ?>
  <?php if (!is_home()) {
    dynamic_sidebar('page-sidebar');
} else {
    dynamic_sidebar('home-sidebar');
} ?>
</aside>
