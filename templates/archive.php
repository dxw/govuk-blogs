<h2 class="archive-title"><?php single_cat_title(); ?></h2>
<?php echo category_description(); ?>
<?php while (have_posts()) : the_post() ?>
<article <?php post_class() ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <?php get_template_part('templates/entry-meta') ?>
    <?php gds_post_thumbnail() ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt() ?>
  </div>
  <?php get_template_part('templates/entry-footer') ?>
</article>
<?php endwhile ?>
