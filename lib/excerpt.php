<?php

# Remove the default Roots excerpt handler...
add_action('init', function () {
  remove_filter('excerpt_more', 'roots_excerpt_more');
});

# ...and add a nicer one
add_filter('excerpt_more', function ($more) {
  return ' …';
});
