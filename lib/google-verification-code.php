<?php

add_action('wp_head', function () {
    if (function_exists('get_field')) {
        $googleVerificationCode = get_field('google_verification_code', 'options');
        if (!is_null($googleVerificationCode) && $googleVerificationCode !== '') {
            ?>
            <meta name="google-site-verification" content="<?php echo esc_attr($googleVerificationCode); ?>" />
            <?php
        }
    }
});
