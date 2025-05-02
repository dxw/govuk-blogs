<?php if ($depth > 1) : ?>
  <span class="govuk-visually-hidden"><?php _e("Replies to", "govuk-blogs"); ?> <?php comment_author($comment->comment_parent); ?></span>
<?php endif; ?>

<div class="media-body">
  <p class="govuk-body media-heading">
    <span class="govuk-visually-hidden"><?php _e("Comment by", "govuk-blogs"); ?></span>
    <span class="author"><?php comment_author_page(); ?></span>
    <span class="govuk-visually-hidden"><?php _e("posted on", "govuk-blogs"); ?></span>
    <time datetime="<?php echo comment_date('c') ?>"><?php echo esc_html(get_comment_date('d F Y')) ?></time>
  </p>
  <div class="comment-body">
    <?php if ($comment->comment_approved == '0') : ?>
      <div class="alert">
        <?php _e('Your comment is awaiting moderation.', 'roots') ?>
      </div>
    <?php endif ?>

    <?php comment_text() ?>

    <div class="comment-links">
      <?php edit_comment_link(__('Edit comment', 'roots')) ?>
         <a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID; ?>" rel="external nofollow"><?php _e("Link to this comment", "govuk-blogs"); ?></a>
    </div>
    <?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']])) ?>
  </div>
  <?php # There is a missing DIV tag here due to a bug in roots?>
