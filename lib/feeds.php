<?php

# Add the Atom feed back in. Roots removes it.
add_action('wp_head', function () {
  ?>
    <link rel="alternate" type="application/atom+xml" title="<?php echo get_bloginfo('name') ?> Feed" href="<?php echo esc_attr(get_feed_link('atom')) ?>">
  <?php
});
