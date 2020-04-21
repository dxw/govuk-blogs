<div class="govuk-body-s">
  <?php gds_byline(); ?><span class="govuk-visually-hidden">Posted on: </span><time class="updated" datetime="<?php echo get_the_time('c') ?>" pubdate><?php echo get_the_date('j F Y') ?></time>
  -
  <span class="govuk-visually-hidden">Categories: </span>
  <?php echo get_the_category_list(', ') ?>
</div>
