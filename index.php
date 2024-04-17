<?php if (!have_posts()) : ?>
    <div class="govuk-error-summary">
        <h1 class="govuk-error-summary__title">
          Sorry, no blog posts were found
        </h1>
        <p class="govuk-body">This may be because:<p>
        <ul class="govuk-list govuk-list--bullet">
            <li>No blog posts have yet been published on this blog</li>
            <li>There is a problem with the service</li>
        </ul>
        <p>Please try again later.</p>
    </div>
<?php endif ?>

<?php while (have_posts()) : the_post() ?>
    <?php get_template_part('templates/content', get_post_format()) ?>
<?php endwhile ?>
