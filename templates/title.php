<?php if (!is_home()) : ?>
  <?php # the_post() and rewind_posts() for author listings ?>
  <?php the_post() ?>
  <h2><?php roots_title() ?></h2>
  <?php rewind_posts() ?>
<?php endif ?>
