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
    <a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID; ?>" rel="external nofollow" title="Link to this comment" class="comment-link">Link to this comment</a>
    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </div>
  <?php # There is a missing DIV tag here due to a bug in roots ?>
