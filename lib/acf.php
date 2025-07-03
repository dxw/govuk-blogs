<?php

use \GovUKBlogs\Theme\ImageLicensing;

if (function_exists('acf_add_options_sub_page')) {
	acf_add_options_sub_page('Banner');
	acf_add_options_sub_page('Google Verification Code');
}

if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group([
		'key' => 'group_5846892ea7f02',
		'title' => 'Banner',
		'fields' => [
			[
				'key' => 'field_584689440d481',
				'label' => 'Show banner',
				'name' => 'show_banner',
				'type' => 'true_false',
				'instructions' => 'Show banner on this site',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'message' => '',
				'default_value' => 1,
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-banner',
				],
			],
		],
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	]);
	acf_add_local_field_group([
		'key' => 'group_5846892ea7h09',
		'title' => 'Google verification code',
		'fields' => [
			[
				'key' => 'field_584689440g473',
				'label' => 'Google Search Console verification code',
				'name' => 'google_verification_code',
				'type' => 'text',
				'instructions' => 'Enter the meta code provided by Google',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'message' => '',
				'default_value' => '',
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-google-verification-code',
				],
			],
		],
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	]);
}

if (function_exists("register_field_group")) {

	// Related posts

	register_field_group([
	'id' => 'acf_related-posts',
	'title' => 'Related posts',
	'fields' => [
	  [
		'key' => 'field_53022510c191d',
		'label' => 'Related posts',
		'name' => 'related_posts',
		'type' => 'repeater',
		'sub_fields' => [
		  [
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
		  ],
		  [
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
		  ],
		],
		'row_min' => '',
		'row_limit' => '',
		'layout' => 'table',
		'button_label' => 'Add Row',
	  ],
	],
	'location' => [
	  [
		[
		  'param' => 'post_type',
		  'operator' => '==',
		  'value' => 'post',
		  'order_no' => 0,
		  'group_no' => 0,
		],
	  ],
	],
	'options' => [
	  'position' => 'normal',
	  'layout' => 'no_box',
	  'hide_on_screen' => [
	  ],
	],
	'menu_order' => 0,
  ]);

	// Theme Options

	register_field_group([
	'id' => 'acf_theme-options',
	'title' => 'Theme Options',
	'fields' => [
	  [
		'key' => 'field_53061c4e7dec9',
		'label' => 'Email Alerts link',
		'name' => 'gds_email_alerts',
		'type' => 'text',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	  ],
	  [
		'key' => 'field_53061c717deca',
		'label' => 'Organisations',
		'name' => 'gds_organisations',
		'type' => 'wysiwyg',
		'default_value' => '',
		'toolbar' => 'full',
		'media_upload' => 'yes',
	  ],
	  [
		'key' => 'field_53061c9c7decc',
		'label' => 'Location',
		'name' => 'gds_location',
		'type' => 'wysiwyg',
		'default_value' => '',
		'toolbar' => 'full',
		'media_upload' => 'yes',
	  ],
	],
	'location' => [
	  [
		[
		  'param' => 'options_page',
		  'operator' => '==',
		  'value' => 'acf-options-theme-options',
		  'order_no' => 0,
		  'group_no' => 0,
		],
	  ],
	],
	'options' => [
	  'position' => 'normal',
	  'layout' => 'no_box',
	  'hide_on_screen' => [
	  ],
	],
	'menu_order' => 0,
  ]);

	// Featured video

	register_field_group([
	'id' => 'acf_featured-video',
	'title' => 'Featured video',
	'fields' => [
	  [
		'key' => 'field_5328943e15f2c',
		'label' => 'Video URL',
		'name' => 'video_url',
		'type' => 'text',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	  ],
	],
	'location' => [
	  [
		[
		  'param' => 'post_type',
		  'operator' => '==',
		  'value' => 'post',
		  'order_no' => 0,
		  'group_no' => 0,
		],
	  ],
	],
	'options' => [
	  'position' => 'side',
	  'layout' => 'default',
	  'priority' => 'low',
	  'hide_on_screen' => [
	  ],
	],
	'menu_order' => 0,
  ]);

	// Fix priority for "Featured video"
	add_filter('acf/input/meta_box_priority', function ($priority, $acf) {
		if (isset($acf['options']['priority'])) {
			return $acf['options']['priority'];
		}

		return $priority;
	}, 10, 2);

	
	register_field_group([
	'id' => 'acf_image-licensing',
	'title' => 'Image licensing',
	'fields' => [
	  [
		'key' => 'field_5463adf92808a',
		'label' => 'Licence',
		'name' => 'licence',
		'type' => 'select',
		'choices' => array_map(function ($licence) {
			return $licence['name'];
		}, ImageLicensing::$imageLicenses),
		'default_value' => '',
		'allow_null' => 1,
		'multiple' => 0,
	  ],
	  [
		'key' => 'field_5463b0f72808b',
		'label' => 'Copyright holder',
		'name' => 'copyright_holder',
		'type' => 'text',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	  ],
	  [
		'key' => 'field_5463b1152808c',
		'label' => 'Link to source',
		'name' => 'link_to_source',
		'type' => 'text',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	  ],
	],
	'location' => [
	  [
		[
		  'param' => 'attachment',
		  'operator' => '==',
		  'value' => 'all',
		],
	  ],
	],
	'options' => [
	  'position' => 'normal',
	  'layout' => 'no_box',
	  'hide_on_screen' => [
	  ],
	],
	'menu_order' => 0,
  ]);
}
