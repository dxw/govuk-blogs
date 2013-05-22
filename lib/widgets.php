<?php

add_action('widgets_init', function () {
  register_sidebar(array(
    'name'          => 'Universal sidebar',
    'id'            => 'sidebar',
    'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
});

add_action('widgets_init', function () {
  register_sidebar(array(
    'name'          => 'Home sidebar',
    'id'            => 'home-sidebar',
    'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
});


add_action('widgets_init', function () {
  register_sidebar(array(
    'name'          => 'Page sidebar',
    'id'            => 'page-sidebar',
    'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));
});

