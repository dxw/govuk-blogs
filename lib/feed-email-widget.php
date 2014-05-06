<?php

add_action('widgets_init', function () {
  register_widget('FeedEmailWidget');
});

class FeedEmailWidget extends WP_Widget {
  public $fields = array(
    'link'          => 'Link',
  );

  function __construct() {

    $this->WP_Widget('feed_email_widget', 'Feed Email Widget', ['classname' => 'feed_email_widget', 'description' => 'Shows feed/email buttons']);
    $this->alt_option_name = 'feed_email_widget';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('feed_email_widget', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $link = apply_filters('widget_title', empty($instance['link']) ? '' : $instance['link'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

  ?>
    <h3>Sign up for updates</h3>
    <div class="subscribe icons-buttons">
      <ul>
        <?php if ($link) : ?>
          <li>
            <a href="<?php echo esc_attr($link) ?>" class="email">Email</a>
          </li>
        <?php endif ?>
        <li>
          <a href="<?php echo esc_attr(get_feed_link('atom')) ?>" class="feed">Atom</a>
        </li>
      </ul>
      <div class="clear"></div>
    </div>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('feed_email_widget', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['feed_email_widget'])) {
      delete_option('feed_email_widget');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('feed_email_widget', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}
