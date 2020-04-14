<?php while (have_posts()) : the_post() ?>
  <article>
    <div class="visible-print">
      <p><?php echo esc_html(get_permalink()) ?></p>
    </div>
    <header>
      <h1 class="govuk-heading-xl "><?php the_title() ?></h1>
    </header>
    <?php the_content() ?>
  </article>
<?php endwhile ?>
