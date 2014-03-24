<div class="media-body">
  <p class="media-heading">
    <span class="author"><?php echo get_comment_author_link() ?></span>
    <span class="divider">—</span>
    <time datetime="<?php echo comment_date('c') ?>"><?php echo esc_html(get_comment_date('d/m/Y')) ?></time>
    <span class="divider">—</span>
    <a href="<?php echo esc_attr(get_comment_link()) ?>">comment link</a>
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
  <?php # There is a missing DIV tag here due to a bug in roots ?>
