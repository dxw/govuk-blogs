<?php
if (function_exists("register_field_group")) {
  register_field_group(array (
    'id' => 'acf_related-posts',
    'title' => 'Related posts',
    'fields' => array (
      array (
        'key' => 'field_53022510c191d',
        'label' => 'Related posts',
        'name' => 'related_posts',
        'type' => 'repeater',
        'sub_fields' => array (
          array (
            'key' => 'field_5302251ec191e',
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
            'column_width' => '',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
          array (
            'key' => 'field_5302252ec191f',
            'label' => 'URL',
            'name' => 'url',
            'type' => 'text',
            'column_width' => '',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'formatting' => 'html',
            'maxlength' => '',
          ),
        ),
        'row_min' => '',
        'row_limit' => '',
        'layout' => 'table',
        'button_label' => 'Add Row',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
