<footer class="govuk-body-s">
  <a class="read-more" href="<?php the_permalink() ?>">Read more <span class="govuk-visually-hidden">about this topic</span></a>
  <?php if (get_comments_number() != 0) { ?>
      - <a href="<?php comments_link() ?>" class="view-comments"><?php printf(_n('1 comment', '%1$s comments', get_comments_number(), 'roots'), number_format_i18n(get_comments_number())) ?></a>
    <?php } ?>
</footer>
