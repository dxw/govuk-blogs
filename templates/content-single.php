<?php while (have_posts()) : the_post() ?>
  <article <?php post_class() ?>>
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
      <ul class="related-posts">
        <?php while (have_rows('related_posts')) : ?>
          <?php the_row() ?>
          <li><a href="<?php echo esc_attr(get_sub_field('url')) ?>"><?php echo esc_html(get_sub_field('title')) ?></a></li>
        <?php endwhile ?>
      </ul>
      <p>
        <?php echo get_the_tag_list('<p><strong>Tags:</strong> ', ',', '</p>'); ?>
      </p>
    </footer>
  </article>

  <div class="next-prev">
    <div class="previous pull-left">
      <?php previous_post_link() ?>
    </div>
    <div class="next pull-right">
      <?php next_post_link() ?>
    </div>
  </div>
  <div class="clearfix"></div>

  <?php share_icons(get_the_ID()) ?>
  <?php comments_template('/templates/comments.php') ?>
<?php endwhile ?>
