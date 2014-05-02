<?php 

# Remove the search widget, because a search box is always in the header
add_action('widgets_init', function () { 
  unregister_widget('WP_Widget_Search');
}, 1);


# Force inserted media to use https urls
add_filter('wp_get_attachment_url', function($url, $post_id) { 
  return preg_replace('/^http:\/\//', 'https://', $url);
}, 10, 2);

