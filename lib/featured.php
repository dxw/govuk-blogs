<?php

# Create a metabox for setting posts as featured posts
add_action('admin_init', function () {
  add_meta_box('gds_featured_post', __('Featured Post'), function ($post) {
    $checked = (int)$post->ID === (int)get_option('gds_featured_post');

    ?>
      <input name="gds_form_exists" type="hidden" value="true">
      <label>
        <input type="checkbox" name="gds_featured_post" <?php checked($checked) ?>>
        Featured Post
      </label>
    <?php
  }, 'post', 'side', 'low');
});


# Add the featured post box to the edit post page
add_action('edit_post', function ($post_ID, $post) {
  if (isset($_POST['gds_form_exists'])) {
    if (isset($_POST['gds_featured_post'])) {
      update_option('gds_featured_post', $post->ID);
    } elseif ((int)get_option('gds_featured_post') === $post->ID) {
      update_option('gds_featured_post', 0);
    }
  }

}, 10, 2);


# Hide featured posts from the homepage loop
add_action('parse_query', function ($query) {
  if (is_home() && !is_admin() ) { // is_admin here to ease OCD tendencies
    $query->set('post__not_in', array((int)get_option('gds_featured_post')));
  }
});


# Set the image size
add_image_size('featured-post', 750, 350, true);


# Create a new loop for displaying a featured post
function gds_get_featured() {
  $featured_post = (int)get_option('gds_featured_post');
  if (empty($featured_post)) {
    return false;
  }
  query_posts(array(
    'posts_per_page' => 1,
    'post__in' => array($featured_post),
  ));
  return true;
}
