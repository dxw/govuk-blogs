<?php

# Display the author for a post, using coauthors if available and falling back to the WordPress user if not.
function gds_byline() {
  if(function_exists('coauthors_posts_links')) { 
    coauthors_posts_links(', ');
  } else {
    ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" rel="author" class="fn"><?php echo get_the_author() ?></a> <?php
  } 
}
