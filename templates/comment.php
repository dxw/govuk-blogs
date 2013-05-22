<div class="media-body">
  <p class="media-heading">
    <span class="author"><?php echo get_comment_author_link() ?></span>
    <time datetime="<?php echo comment_date('c') ?>">— <?php echo esc_html(get_comment_date('d/m/Y')) ?></time>
  </p>
  <?php edit_comment_link(__('(Edit)', 'roots'), '', '') ?>
  <div class="comment-body">
  <?php if ($comment->comment_approved == '0') : ?>
    <div class="alert">
      <?php _e('Your comment is awaiting moderation.', 'roots') ?>
    </div>
  <?php endif ?>

  <?php comment_text() ?>
  <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </div>