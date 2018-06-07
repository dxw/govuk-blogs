<?php

function blogIconPath() : \Dxw\Result\Result
{
    // New style
    $icon = get_field('icon', 'options');
    if ($icon !== false && $icon !== null) {
        return \Dxw\Result\Result::ok($icon['url']);
    }

    // Old style
    $icon_options = get_option('theme_logo_options');
    if ( $icon_options['logo'] != '' ) {
        return \Dxw\Result\Result::ok($icon_options['logo']);
    }

    return \Dxw\Result\Result::err('icon not set');
}

if (function_exists('acf_add_options_sub_page')) {
    acf_add_options_sub_page([
        'title' => 'Logo Options',
        'parent_slug' => 'themes.php',
    ]);
}

if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array (
        'key' => 'group_59429ab4dab8a',
        'title' => 'Logo Options',
        'fields' => array (
            array (
                'key' => 'field_59429b2ceb54c',
                'label' => 'Logo',
                'name' => 'icon',
                'type' => 'image',
                'instructions' => 'Upload a personalised icon for the blog header. Must be uploaded at 90x90px to display correctly.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-logo-options',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
}
