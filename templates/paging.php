<?php if ($wp_query->max_num_pages > 1) : ?>

  <div class="page-numbers-container">
    <?php pagination(); ?>
  </div>

<?php endif; ?>
