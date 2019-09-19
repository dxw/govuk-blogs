<?php
$showBannerOnNetwork = get_site_option('banner_setting');
$showBannerBySite = get_field('show_banner', 'options');
if ($showBannerOnNetwork == true && ($showBannerBySite == true || $showBannerBySite === null)) {
    $bannerTitle = get_site_option('banner_title');
    $bannerLinkText = get_site_option('banner_link_text');
    $bannerLink = get_site_option('banner_link'); ?>
    <div id="user-satisfaction-survey-container" class="container">
      <section id="user-satisfaction-survey" class="visible" aria-hidden="false">
        <div class="grid-row">
            <div class="column-three-quarters">
                <h3><?php echo esc_html($bannerTitle) ?></h2>
                <p><a href="<?php echo esc_url($bannerLink)?>" id="take-survey" target="_blank"><?php echo esc_html($bannerLinkText) ?></a></p>
            </div>
            <div class="column-one-quarter">
                <p><a href="#survey-no-thanks" id="survey-no-thanks">No thanks</a></p>
            </div>
        </div>
      </section>
    </div>
    <?php
}
?>
