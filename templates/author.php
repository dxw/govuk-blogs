<div class="author-container">
    <div class="govuk-grid-row author-details">
        <div class="govuk-grid-column-one-quarter avatar">
            <?php gds_avatar() ?>
        </div>
        <div class="govuk-grid-column-three-quarters">
            <h1 class="govuk-heading-l"><?php the_author_meta('display_name'); ?></h1>
            <?php $content = get_the_author_meta('description');
            echo apply_filters('the_content', $content); ?>
        </div>
    </div>
    <?php while (have_posts()) : the_post() ?>
        <?php get_template_part('templates/content', get_post_format()) ?>
    <?php endwhile ?>
</div>
