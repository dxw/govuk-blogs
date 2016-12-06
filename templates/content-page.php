<?php while (have_posts()) : the_post() ?>
  <article class="page-content clearfix">
    <div class="visible-print">
      <p><?php echo esc_html(get_permalink()) ?></p>
    </div>
    <header>
      <h1 class="entry-title"><?php the_title() ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content() ?>
    </div>
  </article>
<?php endwhile ?>
