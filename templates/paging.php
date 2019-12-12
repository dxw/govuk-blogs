<?php if ($wp_query->max_num_pages > 1) : ?>

  <nav class="page-numbers-container pagination-container" aria-label="Pagination">
      <div class="grid-row">
        <?php pagination(); ?>
      </div>
  </nav>

<?php endif; ?>
