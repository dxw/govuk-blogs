<?php while (have_posts()) : the_post() ?>
<div class="page-content">
  <?php the_content() ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')) ?>
</div>
<?php endwhile ?>
