<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/') ?>">
  <label class="visuallyhidden" for="s">Search for:</label>
  <input type="search" value="<?php echo get_search_query() ?>" name="s" id="s" class="search-query" placeholder="Search blog">
  <input type="submit" id="searchsubmit" value="<?php _e('Search', 'roots') ?>" class="btn">
</form>
