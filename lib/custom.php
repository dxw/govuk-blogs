<?php

# Remove the search widget, because a search box is always in the header
add_action('widgets_init', function () {
    unregister_widget('WP_Widget_Search');
}, 1);


# Force inserted media to use https urls
add_filter('wp_get_attachment_url', function ($url, $post_id) {
    return preg_replace('/^http:\/\//', 'https://', $url);
}, 10, 2);


# Contributors can upload images
if (current_user_can('contributor') && !current_user_can('upload_files')) {
    add_action('admin_init', 'allow_contributor_uploads');
}

function allow_contributor_uploads()
{
    $contributor = get_role('contributor');
    $contributor->add_cap('upload_files');
}

# Removes the name of the post from the body_class array so it doesn't break things (bootstrap I'm looking for you)
add_filter('body_class', 'remove_class');
function remove_class($classes)
{
    $base_name = basename(get_permalink());
    $remove_classes = [
      $base_name
    ];
    $classes = array_diff($classes, $remove_classes);

    return $classes;
}

# Gives Editors perms for Widgets and Menus

$role = get_role('editor'); 
$role->add_cap('edit_theme_options');

function custom_admin_menu() {

    $user = new WP_User(get_current_user_id());     
    if (!empty( $user->roles) && is_array($user->roles)) {
        foreach ($user->roles as $role)
            $role = $role;
    }

    if($role == "editor") { 
       remove_submenu_page( 'themes.php', 'themes.php' );
    }       
}

add_action('admin_menu', 'custom_admin_menu');