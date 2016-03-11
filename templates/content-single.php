<?php while (have_posts()) : the_post() ?>
  <article <?php post_class('clearfix') ?>>
    <div class="visible-print">
      <p><?php echo esc_html(get_permalink()) ?></p>
    </div>
    <header>
      <h1 class="entry-title"><?php the_title() ?></h1>
      <?php get_template_part('templates/entry-meta') ?>
    </header>
    <div class="entry-content">
      <?php the_content() ?>
    </div>
    <footer class="single">
      <?php the_footnotes(); ?>
      <?php if (have_rows('related_posts')) : ?>
        <div class="related-posts">
          <p>You may also be interested in:</p>
          <ul>
            <?php while (have_rows('related_posts')) : ?>
              <?php the_row() ?>
              <li><a href="<?php echo esc_attr(get_sub_field('url')) ?>"><?php echo esc_html(get_sub_field('title')) ?></a></li>
            <?php endwhile ?>
          </ul>
        </div>
      <?php endif ?>
      <?php echo get_the_tag_list('<p class="tags"><strong>Tags:</strong> ', ', ', '</p>'); ?>
    </footer>
  </article>

  <div class="page-numbers-container page-navigation">
    <div class="previous pull-left">
      <?php previous_post_link('<span class="arrow-button"></span><span class="link">%link</span>') ?>
    </div>
    <div class="next pull-right">
      <?php next_post_link('<span class="link">%link</span><span class="arrow-button"></span>') ?>
    </div>
  </div>
  <div class="clearfix"></div>

  <?php share_icons(get_the_ID()) ?>
  <?php comments_template('/templates/comments.php') ?>
<?php endwhile ?>
