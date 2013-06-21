<?php

# Register our menus, and remove the Roots default
add_action('init', function () {
  unregister_nav_menu('primary_navigation');

  //register_nav_menus(array(
  // 'main_menu' => 'Main menu',
  //  'related_blogs' => 'Related blogs',
  //  'follow_us' => 'Follow us',
  //  'footer' => 'Footer',
  //));
});
