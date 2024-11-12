<?php

$headerTag = is_home() ? 'h1' : 'div';
?>
<header class="header" aria-label="blog name">
    <div class="govuk-grid-row">

        <?php $logo_options = get_option('theme_logo_options'); ?>

        <div class="govuk-grid-column-two-thirds">
            <<?php echo $headerTag; ?> class="blog-title govuk-heading-xl">
                <span class="blog"><a href="<?php echo network_site_url(); ?>">Blog</a></span>
                <a href="<?php echo home_url() ?>"><?php bloginfo('name') ?></a>
			</<?php echo $headerTag; ?>>

            <?php if ($orgs = gds_organisations() ||  get_option('options_gds_location')) : ?>
                <div class="bottom blog-meta">
                        <?php if ($orgs = gds_organisations()) : ?>
                            <dl>
                                <dt>Organisations:</dt>
                                <dd><?php echo $orgs # this is pre-escaped?></dd>
                            </dl>
                        <?php endif ?>
                        <?php if (get_option('options_gds_location')) : ?>
                            <dl>
                                <dt>Location:</dt>
                                <dd><?php echo get_option('options_gds_location') ?></dd>
                            </dl>
                        <?php endif ?>
                </div>
            <?php endif ?>
        </div>

        <div class="govuk-grid-column-one-third">
            <?php $result = blogIconPath() ?>
            <?php if (!$result->isErr()): ?>
                <div class="logo-container hidden-mobile">
                    <img src="<?php echo $result->unwrap() ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>">
                </div>
            <?php endif ?>
            <div class="bottom search-container">
                <?php get_template_part('templates/searchform'); ?>
            </div>
        </div>

    </div>

    <?php if (function_exists('history_mode_notice') && (history_mode_notice_active(get_the_ID()))) { ?>
        <div class="govuk-grid-row">
            <div class="history-status-block">
                <h2 class="govuk-heading-l">
                    <?php history_mode_notice(get_the_ID(), 'blog post'); ?>
                </h2>
            </div>
        </div>
    <?php } ?>

</header>
