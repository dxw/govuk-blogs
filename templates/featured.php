<?php if (gds_get_featured()) : ?>
  <?php while (have_posts()): the_post() ?>
    <div class="row">
      <article <?php post_class('featured span12') ?>>
        <div class="featured-wrapper">
          <h2 class="entry-title visible-tablet"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
          <div class="image">
            <?php gds_post_thumbnail(true) ?>
          </div>
          <div class="text">
            <h2 class="entry-title visible-desktop hidden-tablet"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <div class="entry-summary">
              <?php the_excerpt() ?>
            </div>
            <a class="read-more" href="<?php the_permalink() ?>">Read more</a>
          </div>
          <div class="clear"></div>
        </div>
      </article>
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php wp_reset_query() ?>
