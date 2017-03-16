<?php
$showBanner = get_field('show_banner', 'options');
if ($showBanner === true || $showBanner = null) {
    $bannerTitle = get_field('banner_title', 'options');
    if ($bannerTitle == null) {
        $bannerTitle = 'Tell us what you think of BLOG.GOV.UK';
    }
    $bannerLinkText = get_field('banner_title', 'options');
    if ($bannerLinkText == null) {
        $bannerLinkText = 'Your feedback will help us improve this website';
    }
    $bannerLink = get_field('banner_link', 'options');
    if ($bannerLink == null) {
        //Link TBC
        $bannerLink = 'http://surveymonkey.com';
    }
    ?>
    <div id="user-satisfaction-survey-container" class="container">
      <section id="user-satisfaction-survey" class="visible" aria-hidden="false">
        <div class="row">
            <div class="span10">
                <h2><?php echo esc_html($bannerTitle) ?></h2>
                <p><a href="<?php echo $bannerLink ?>" id="take-survey" target="_blank"><?php echo esc_html($bannerLinkText) ?></a></p>
            </div>
            <div class="span2">
                <p><a href="#survey-no-thanks" id="survey-no-thanks">No thanks</a></p>
            </div>
        </div>
      </section>
    </div>
    <?php
}
?>
