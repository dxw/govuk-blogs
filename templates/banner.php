<?php
$showBannerOnNetwork = get_site_option('banner_setting');
$showBannerBySite = get_field('show_banner', 'options');
if ($showBannerOnNetwork == true && ($showBannerBySite == true || $showBannerBySite === null)) {
    $bannerTitle = get_site_option('banner_title');
    $bannerLinkText = get_site_option('banner_link_text');
    $bannerLink = get_site_option('banner_link'); ?>
    <aside id="user-satisfaction-survey-container" class="govuk-width-container">
      <section id="user-satisfaction-survey" class="visible" aria-hidden="false">
        <div class="govuk-grid-row">
            <div class="govuk-grid-column-three-quarters">
                <p class="govuk-heading-s"><?php echo esc_html($bannerTitle) ?></p>
                <p class="govuk-body"><a href="<?php echo esc_url($bannerLink)?>" id="take-survey" target="_blank"><?php echo esc_html($bannerLinkText) ?></a></p>
            </div>
            <div class="govuk-grid-column-one-quarter">
                <p class="govuk-body"><a href="#survey-no-thanks" id="survey-no-thanks" class="govuk-link" role="button" aria-controls="user-satisfaction-survey">No thanks</a></p>
            </div>
        </div>
      </section>
    </aside>
    <?php
}
?>
