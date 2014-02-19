<?php

# Add theme settings
add_action('admin_menu', function () {

  $title = __('Theme Options');

  $options = array(
    'gds_email_alerts' => array(
      'type' => 'uri',
      'title' => __('Email Alerts link'),
    ),
    'gds_organisations' => array(
      'type' => 'tinymce',
      'title' => __('Organisations'),
    ),
    'gds_topics' => array(
      'type' => 'tinymce',
      'title' => __('Topics'),
    ),
    'gds_location' => array(
      'type' => 'tinymce',
      'title' => __('Location'),
    ),
  );


  add_theme_page($title, $title, 'create_users', 'gds_options', function () use ($title, $options) {
    ?>
      <div class="wrap">
        <h2><?php echo esc_html($title) ?></h2>

        <form method="post" action="options.php">
          <?php settings_fields('gds_options') ?>

          <table class="form-table">
            <?php foreach ($options as $k => $v) : ?>
              <?php $title = $v['title'] ?>
              <?php $type = $v['type'] ?>
              <tr valign="top">
                <th scope="row"><label for="<?php echo esc_attr($k) ?>"><?php echo esc_html($title) ?></label></th>
                <td>
                  <?php if ($type === 'tinymce') : ?>
                    <?php wp_editor(get_option($k), $k) ?>
                  <?php elseif ($type === 'uri') : ?>
                    <input type="url" name="<?php echo esc_attr($k) ?>" value="<?php echo esc_attr(get_option($k)) ?>" class="regular-text">
                  <?php endif ?>
                </td>
              </tr>
            <?php endforeach ?>
          </table>

          <?php submit_button() ?>

        </form>
      </div>
    <?php
  });

  foreach ($options as $k => $v) {
    register_setting('gds_options', $k);
  }

});

