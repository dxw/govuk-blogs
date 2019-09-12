<h2 class="search-title">Search results for <?php the_search_query(); ?> </h2>

<?php if (have_posts()) { ?>
  
  <?php while (have_posts()) : the_post() ?>
    <article <?php post_class() ?>>
      <header>
        <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
        <?php get_template_part('templates/entry-meta') ?>
        <?php if (has_post_thumbnail()) {
    the_post_thumbnail('large');
} ?> 
      </header>
      <div class="entry-summary">
        <?php the_excerpt() ?>
      </div>
      <?php get_template_part('templates/entry-footer') ?>
    </article>
  <?php endwhile ?>

<?php } else { ?>
  <article>
    <p>No results found on <strong><?php echo get_bloginfo('name'); ?></strong>.</p>
    <p>Please try searching again using different words or try this search on <a href="https://www.gov.uk/">GOV.UK</a>.</p>
  </article>
<?php } ?>
 