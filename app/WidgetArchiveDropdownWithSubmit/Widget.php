<?php

namespace GovUKBlogs\WidgetArchiveDropdownWithSubmit;

class Widget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('archive-dropdown-with-submit', 'Archives Dropdown With Submit', [
            'classname' => 'widget_archive',
            'description' => 'The same as monthly "Archives" widget dropdown but with a submit button',
        ]);
    }

    public function widget($args, $instance)
    {
        $title = 'Archives';
 
        echo $args['before_widget'];
 
        echo $args['before_title'] . $title . $args['after_title'];
 
        $dropdown_id = "{$this->id_base}-archive-dropdown-with-submit-{$this->number}";
        
        echo '<label class="screen-reader-text" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

        echo '<select id="' . esc_attr($dropdown_id) . '" name="archive-dropdown">';
 
        echo '<option value="">Select month</option>';
 
        wp_get_archives([
            'type' => 'monthly',
            'format' => 'option',
            'show_post_count' => true
        ]);
    
        echo '</select>';

        echo '<button class="govuk-button" data-module="govuk-button" onclick="newLocation = document.getElementById(\''. esc_attr($dropdown_id) .'\').value; if ( newLocation != \'\' ) { window.location = newLocation; }">Go</button>';
 
        echo $args['after_widget'];
    }
}
