<?php 

# Remove the search widget, because a search box is always in the header
add_action('widgets_init', function () { 
  unregister_widget('WP_Widget_Search');
}, 1);


# Force inserted media to use https urls
// I have commented out for now to make the images work on the staging site. Please do not push to production!
// add_filter('wp_get_attachment_url', function($url, $post_id) { 
//   return preg_replace('/^http:\/\//', 'https://', $url);
// }, 10, 2);

