<div class="govuk-body-s">
	<?php if (get_post_type() === 'post') {
		gds_byline();
		echo ", ";
	} ?>
	<span class="govuk-visually-hidden"><?php _e("Posted on:", "govuk-blogs"); ?></span>
	<time class="updated" datetime="<?php echo get_the_time('c') ?>"><?php echo get_the_date('j F Y') ?></time>
	<?php if (has_category()) { ?>-
	<span class="govuk-visually-hidden"><?php _e("Categories:", "govuk-blogs"); ?></span>
	<?php echo get_the_category_list(', '); ?>
	<?php } ?>
</div>
