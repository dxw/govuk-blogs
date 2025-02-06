<?php

# Display the author for a post, using coauthors if available and falling back to the WordPress user if not.
function gds_byline()
{
	do_action('gds_byline');
	?>
	<span class="govuk-visually-hidden">Posted by: </span>
	<?php
	if (function_exists('coauthors_posts_links')) {
		coauthors_posts_links(', ');
	} else {
		echo '<i>'. get_the_author() .'</i>';
	}
}
