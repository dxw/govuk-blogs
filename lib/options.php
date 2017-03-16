<?php

if (function_exists('acf_add_options_sub_page')) {
  acf_add_options_sub_page([
    'title' => 'Theme Options',
    'parent' => 'themes.php',
  ]);
}

add_action('network_admin_menu', function () {
    add_submenu_page('settings.php', 'Banner', 'Banner', 'manage_options', 'banner-settings', function () {
        if (isset($_POST['_wpnonce']) && isset($_POST['banner_setting']) && wp_verify_nonce($_POST['_wpnonce'], 'banner-settings')) {
            $skip_days = absint($_POST['banner_setting']);
            update_site_option('banner_setting', $skip_days);
        } elseif (isset($_POST['_wpnonce']) && !isset($_POST['banner_setting']) && wp_verify_nonce($_POST['_wpnonce'], 'banner-settings')) {
            delete_site_option('banner_setting');
        }
        ?>

        <div class="wrap">
            <h2>Banner setting</h2>

            <p>This page controls the banner display across this site.</p>

            <p>If you choose to display the banner here, it will display across all sites in the network unless explicitly turned off on a site-by-site basis.</p>

            <form method="POST" action="settings.php?page=banner-settings">

                <?php wp_nonce_field('banner-settings') ?>

                <table class="form-table">
                    <tr>
                        <td>
                            <label>
                                Display banner <input type="checkbox" name="banner_setting" value="1" <?php checked( get_site_option('banner_setting'), 1 ) ?> >
                            </label>
                        </td>
                    </tr>
                </table>

                <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>

            </form>
        </div>

        <?php

    });
});
