<?php if ($wp_query->max_num_pages > 1) : ?>

  <nav class="page-numbers-container" aria-label="Pagination">
    <?php pagination(); ?>
</nav>

<?php endif; ?>
