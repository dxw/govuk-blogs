<?php

add_filter('tiny_mce_before_init', 'init');
add_filter('mce_buttons_2', 'add_style_button');

function add_style_button($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

function init($settings)
{
    $style_formats = [
        [
          'title' => 'Highlight',
          'block' => 'div',
          'classes' => 'highlight',
          'wrapper' => true
        ]
    ];

    $settings['style_formats'] = json_encode($style_formats);

    return $settings;
}
