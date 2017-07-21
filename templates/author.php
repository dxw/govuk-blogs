<div class="author-container">
    <div class="grid-row author-details">
        <div class="column-one-quarter avatar">
            <?php gds_avatar() ?>
        </div>
        <div class="column-three-quarters">
            <h2 class="author-title"><?php the_author_meta('display_name'); ?></h2>
            <?php $content = get_the_author_meta('description');
                echo apply_filters('the_content', $content); ?>
        </div>
    </div>
    <?php while (have_posts()) : the_post() ?>
        <?php get_template_part('templates/content', get_post_format()) ?>
    <?php endwhile ?>
</div>

