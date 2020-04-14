<footer class="govuk-body-s">
  <a class="govuk-link" href="<?php the_permalink() ?>"><strong>Read more</strong> <span class="govuk-visually-hidden">about this topic</span></a>
  <?php if (get_comments_number() != 0) { ?>
      - <a href="<?php comments_link() ?>" class="govuk-link"><?php printf(_n('1 comment', '%1$s comments', get_comments_number(), 'roots'), number_format_i18n(get_comments_number())) ?></a>
    <?php } ?>
</footer>
