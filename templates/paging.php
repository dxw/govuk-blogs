<?php if ($wp_query->max_num_pages > 1) : ?>
  <div class="page-numbers-container">
    <?php if ($paged == 0) { $paged = 1; } ?>
    <?php if ($paged > 1) : ?>
      <a href="<?php echo get_previous_posts_page_link(); ?>">
         <span class="previous arrow">
           <span class="arrow-button"></span>
           <span class="contain">
             <span class="link">Previous page</span>
             <span class="page-numbers"><?php echo ($paged-1) ?> of <?php echo $wp_query->max_num_pages; ?></span>
        </span>
      </a>
    <?php endif; ?>
    <?php if ($paged < $wp_query->max_num_pages) : ?>
      <a href="<?php echo get_next_posts_page_link(); ?>">
        <span class="next arrow">
          <span class="arrow-button"></span>
          <span class="contain">
            <span class="link">Next page</span>
            <span class="page-numbers"><?php echo ($paged+1) ?> of <?php echo $wp_query->max_num_pages; ?></span>
          </span>
        </span>
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>
