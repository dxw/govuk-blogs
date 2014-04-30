<article <?php post_class() ?>>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <?php get_template_part('templates/entry-meta') ?>
    <?php gds_post_thumbnail() ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt() ?>
  </div>
  <footer>
    <a class="read-more" href="<?php the_permalink() ?>">Read more</a>
    <?php if (get_comments_number() != 0) { ?>
      <span> — </span>
      <a href="<?php comments_link() ?>"><?php printf(_n('1 comment', '%1$s comments', get_comments_number(), 'roots'), number_format_i18n(get_comments_number())) ?></a>
    <?php } ?>
  </footer>
</article>
