<?php

add_action('widgets_init', function () {
  register_widget('AboutWidget');
});

class AboutWidget extends WP_Widget {

  function __construct() {
    $this->WP_Widget('about_widget', 'About Widget', ['classname' => 'about_widget', 'description' => 'Information about blog']);
    $this->alt_option_name = 'about_widget';
  }

  public function widget( $args, $instance ) {
    $title   = $instance['title'];
    $desc    = apply_filters( 'widget_textarea', empty( $instance['description'] ) ? '' : $instance['description'], $instance );

    // Display information
    echo '<section class="widget about_widget">';
      if ( !empty( $title ) ) {
        echo '<h3>' . $title . '</h3>';
      }
      if ( !empty( $desc ) ) {
        echo wpautop( $desc );
      }
    echo '</section>';
  }

  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    if ( isset( $instance[ 'description' ] ) ) {
      $desc = $instance[ 'description' ];
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'description' ); ?>">Description:</label>
      <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" rows="16" cols="10"><?php echo $desc; ?></textarea>
    </p>
  <?php
  }
  
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title']       = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    if ( current_user_can('unfiltered_html') ) {
      $instance['description'] =  $new_instance['description'];
    } else {
      $instance['description'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['description']) ) );
    }

    return $instance;
  }
}
