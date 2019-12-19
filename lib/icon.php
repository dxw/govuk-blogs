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
    if ($icon_options['logo'] != '') {
        return \Dxw\Result\Result::ok($icon_options['logo']);
    }

    return \Dxw\Result\Result::err('icon not set');
}

if (function_exists('acf_add_options_sub_page')) {
    $options = [
        'title' => 'Logo Options',
        'parent_slug' => 'themes.php',
    ];

    // Only allow super-admins to edit these option, if this constant is set
    if (defined('LOGO_OPTIONS_SUPERADMIN_ONLY') && LOGO_OPTIONS_SUPERADMIN_ONLY) {
        $options['capability'] = 'manage_network_themes';
    }

    acf_add_options_sub_page($options);
}

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_59429ab4dab8a',
        'title' => 'Logo Options',
        'fields' => [
            [
                'key' => 'field_59429b2ceb54c',
                'label' => 'Logo',
                'name' => 'icon',
                'type' => 'image',
                'instructions' => 'Logo will be displayed to the right of the blog header. Should be 180px square or larger.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
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
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-logo-options',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
}
