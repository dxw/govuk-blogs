<div class="subscribe">
  <ul>
    <li class="atom"><a href="<?php echo esc_attr(get_feed_link('atom')) ?>">atom</a></li>
    <?php if (get_option('options_gds_email_alerts')) : ?>
      <li class="email"><a href="<?php echo esc_attr(get_option('options_gds_email_alerts')) ?>">email alerts</a></li>
    <?php endif ?>
  </ul>
  <div class="clear"></div>
</div>
