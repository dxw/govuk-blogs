<?php if ($depth > 1) : ?>
  <span class="visuallyhidden">Replies to <?php comment_author( $comment->comment_parent ); ?>></span>
<?php endif; ?>

<div class="media-body">
  <p class="media-heading">
    <span class="visuallyhidden">Comment by</span>
    <span class="author"><?php comment_author_page(); ?></span>
    <span class="visuallyhidden">posted on</span>
    <time datetime="<?php echo comment_date('c') ?>">on <?php echo esc_html(get_comment_date('d F Y')) ?></time>
  </p>
  <div class="comment-body">
    <?php if ($comment->comment_approved == '0') : ?>
      <div class="alert">
        <?php _e('Your comment is awaiting moderation.', 'roots') ?>
      </div>
    <?php endif ?>

    <?php comment_text() ?>

    <ul class="comment-links">
      <?php edit_comment_link(__('Edit comment', 'roots'), '<li>', '</li>') ?>
      <li>
         <a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID; ?>" rel="external nofollow">Link to this comment</a>
      </li>
    </ul>
    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </div>
  <?php # There is a missing DIV tag here due to a bug in roots ?>
