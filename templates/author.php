<div class="row">
  <div class="span8 author-container">
    <div class="row">
      <div class="span2 avatar">
        <?php gds_avatar() ?>
      </div>
      <div class="span6">
        <h2 class="author-title"><?php the_author_meta('display_name'); ?></h2>
          <?php $content = get_the_author_meta('description');
                echo apply_filters('the_content', $content); ?>
      </div>
    </div>
    <?php while (have_posts()) : the_post() ?>
      <?php get_template_part('templates/content', get_post_format()) ?>
    <?php endwhile ?>
  </div>
</div>
