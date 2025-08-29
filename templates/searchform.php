<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/') ?>">
    <label class="govuk-label govuk-label--m" for="s"><?php _e("Search blog", "govuk-blogs"); ?></label>
    <div class="search-input-wrapper">
        <input enterkeyhint="search" title="Search" type="search" value="<?php echo get_search_query() ?>" name="s" id="s" class="search-query">
        <input type="submit" id="searchsubmit" value="<?php _e('Search', 'roots') ?>" class="btn">
    </div>
</form>
