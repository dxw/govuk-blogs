<?php while (have_posts()) : the_post() ?>
  <article <?php post_class() ?>>
    <header>
      <h1 class="entry-title"><?php the_title() ?></h1>
      <?php get_template_part('templates/entry-meta') ?>
    </header>
    <div class="entry-content">
      <?php the_content() ?>
    </div>
    <footer class="single">
      <p>
        <strong>By:</strong> <?php gds_byline(); ?>
        &nbsp;&nbsp;<strong>Category:</strong> <?php echo get_the_category_list(', ') ?>
      </p>
      <p>
        <?php echo get_the_tag_list('<p><strong>Tags:</strong> ', ',', '</p>'); ?>
      </p>
    </footer>
    <?php share_icons(get_the_ID()) ?>
    <?php comments_template('/templates/comments.php') ?>
  </article>
<?php endwhile ?>
