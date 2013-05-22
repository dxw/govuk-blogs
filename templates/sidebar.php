<aside class="sidebar">
  <?php dynamic_sidebar('sidebar') ?>
  <?php if (!is_home()) { dynamic_sidebar('page-sidebar'); }
  else { dynamic_sidebar('home-sidebar'); } ?>
</aside>
