<h2 class="archive-title"><?php single_cat_title(); ?></h2>
<?php while (have_posts()) : the_post() ?>
<article <?php post_class() ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <?php get_template_part('templates/entry-meta') ?>
    <?php if ( has_post_thumbnail() ) {
    	the_post_thumbnail('large');
    	} ?> 
  </header>
  <div class="entry-summary">
    <?php the_excerpt() ?>
  </div>
  <footer>
    <a class="read-more" href="<?php the_permalink() ?>">Read more</a>
    —
    <a href="<?php comments_link() ?>"><?php printf(_n('1 comment', '%1$s comments', get_comments_number(), 'roots'), number_format_i18n(get_comments_number())) ?></a>
  </footer>
</article>
<?php endwhile ?>
 