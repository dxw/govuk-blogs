<?php if (gds_get_featured()) : ?>
  <?php while (have_posts()): the_post() ?>
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-full">
        <article <?php post_class('featured') ?>>
          <div class="featured-wrapper">
            <h2 class="govuk-heading-m entry-title visible-tablet"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <div class="image">
              <?php gds_post_thumbnail(true) ?>
            </div>
            <div class="text">
              <h2 class="govuk-heading-m entry-title visible-desktop hidden-tablet"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
              <div class="entry-summary">
                <?php the_excerpt() ?>
              </div>
              <a class="read-more" href="<?php the_permalink() ?>"><?php echo sprintf(__('Read more<span class="govuk-visually-hidden"> of %s</span>', "govuk-blogs"), get_the_title()); ?></a>
            </div>
          </div>
        </article>
      </div>
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php wp_reset_query() ?>
