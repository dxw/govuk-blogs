					<hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
					<h1 class="govuk-heading-l"><?php echo sprintf(__("Search results for %s", "govuk-blogs"), get_search_query()); ?></h1>
<?php
if (have_posts()) {
	while (have_posts()) {
		the_post(); ?>
					<article <?php post_class() ?>>
						<header>
							<h3 class="govuk-heading-m"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
							<?php
		get_template_part('templates/entry-meta');
		if (has_post_thumbnail()) {
			the_post_thumbnail('large');
		} ?>
						</header>
						<?php the_excerpt() ?>
						<?php get_template_part('templates/entry-footer') ?>
					</article>
	<?php
	}
} else { ?>
					<article>
						<p class="govuk-body"><?php echo sprintf(__("No results found on <strong>%s</strong>.", "govuk-blogs"), get_bloginfo('name')); ?></p>
						<p><?php echo sprintf(__("Please try searching again using different words or try this search on %s.", "govuk-blogs"), '<a href="https://www.gov.uk/">GOV.UK</a>'); ?></p>
					</article>
<?php
}
