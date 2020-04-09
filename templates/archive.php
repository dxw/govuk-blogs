<hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
<h2 class="govuk-heading-l"><?php single_cat_title(); ?></h2>
<?php echo category_description(); ?>
<?php while (have_posts()) : the_post() ?>
<article <?php post_class() ?>>
  <header>
    <h2 class="govuk-heading-m"><a class="govuk-link" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <?php get_template_part('templates/entry-meta') ?>
    <?php gds_post_thumbnail() ?>
  </header>
  <?php the_excerpt() ?>
  
  <?php get_template_part('templates/entry-footer') ?>
</article>
<?php endwhile ?>
