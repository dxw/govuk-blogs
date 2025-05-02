<?php
if (post_password_required()) {
	return;
}

if (have_comments()) : ?>
  <section id="comments" class="comments">
    <h3 class="govuk-heading-m"><?php printf(_n('1 comment', '%1$s comments', get_comments_number(), 'roots'), number_format_i18n(get_comments_number())) ?></h3>

    <ol class="media-list">
      <?php wp_list_comments(['walker' => new GDS_Walker_Comment()]) ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <nav>
      <ul class="pager">
        <?php if (get_previous_comments_link()) : ?>
          <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'roots')) ?></li>
        <?php endif ?>
        <?php if (get_next_comments_link()) : ?>
          <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'roots')) ?></li>
        <?php endif ?>
      </ul>
    </nav>
    <?php endif ?>

  </section><!-- /#comments -->
<?php endif ?>

<?php if (comments_open()) : ?>
  <section id="respond" class="leave-a-comment">
    <header aria-label="Leave a comment" class="govuk-grid-row group">
        <div class="govuk-grid-column-full">
          <h3 class="govuk-heading-m"><?php comment_form_title(__('Leave a comment', 'roots'), __('Leave a reply to %s', 'roots'), __(false, 'roots')); ?></h3>
          <p class="govuk-body cancel-comment-reply"><?php cancel_comment_reply_link('Cancel reply') ?></p>
        </div>
    </header>

    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
      <p class="govuk-body"><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'roots'), wp_login_url(get_permalink())) ?></p>
    <?php else : ?>

      <form action="<?php echo get_option('siteurl') ?>/wp-comments-post.php" method="post" id="commentform" class="group">
        <div class="govuk-form-group">
          <a name="comment_field"></a>
          <label for="comment" class="govuk-label"><?php _e('Enter your comment', 'roots') ?></label>
          <textarea class="govuk-textarea required" name="comment" id="comment" cols="50" rows="10" required aria-required="true"></textarea>
        </div>
        <div class="js-comment-extra">
          <?php if (is_user_logged_in()) : ?>
            <p class="govuk-body">
              <?php printf(__('You are logged in as <strong>%s</strong>.', 'roots'), $user_identity) ?>
              <a href="<?php echo wp_logout_url(get_permalink()) ?>"><?php _e('Log out', 'roots') ?></a>
            </p>
          <?php else : ?>
            <div class="govuk-form-group">
              <a name="name_field"></a>
              <label class="govuk-label" for="author"><?php _e('Name', 'roots'); ?></label>
              <input type="text" class="govuk-input text<?php echo $req ? ' required' : '' ?>" name="author" id="author" value="<?php echo esc_attr($comment_author) ?>" <?php echo $req ? 'required aria-required="true"' : '' ?> autocomplete="name">
            </div>
            <div class="govuk-form-group">
              <a name="email_field"></a>
              <label class="govuk-label" for="email"><?php _e('Email', 'roots'); ?></label>
              <div class="govuk-hint"><?php _e("We only ask for your email address so we know you're a real person", "govuk-blogs"); ?></div>
              <input type="email" class="govuk-input text<?php echo $req ? ' required' : '' ?>" name="email" id="email" value="<?php echo esc_attr($comment_author_email) ?>" <?php echo $req ? 'required aria-required="true"' : '' ?> autocomplete="email">
            </div>
          <?php endif ?>
          <?php do_action('comment_form', $post->ID) ?>
          <button class="govuk-button" data-module="govuk-button">
            <?php _e("Submit comment", "govuk-blogs"); ?>
          </button>
        </div>
        <?php comment_id_fields() ?>
        <div class="comment-privacy-notice dxw-subscription">
            <p class="govuk-inset-text"><?php
		_e("By submitting a comment you understand it may be published on this public website.", "govuk-blogs");
    	echo sprintf(
    		__('Please read our <a href="%s">privacy notice</a> to see how the GOV.UK blogging platform handles your information.', "govuk-blogs"),
    		"https://www.gov.uk/government/publications/govuk-blogging-platform-privacy-notice"
    	); ?></p>
        </div>
      </form>
    <?php endif ?>
  </section><!-- /#respond -->
<?php endif ?>
