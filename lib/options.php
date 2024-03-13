<?php

if (function_exists('acf_add_options_sub_page')) {
	acf_add_options_sub_page([
	'title' => 'Theme Options',
	'parent' => 'themes.php',
  ]);
}

add_action('network_admin_menu', function () {
	add_submenu_page('settings.php', 'Banner', 'Banner', 'manage_options', 'banner-settings', function () {
		if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'banner-settings')) {
			if (isset($_POST['banner_setting'])) {
				$banner_setting = absint($_POST['banner_setting']);
				update_site_option('banner_setting', $banner_setting);
			} else {
				delete_site_option('banner_setting');
			}
			if (isset($_POST['banner_dismissable'])) {
				$banner_setting = absint($_POST['banner_dismissable']);
				update_site_option('banner_dismissable', $banner_setting);
			} else {
				delete_site_option('banner_dismissable');
			}
			$banner_colour = $_POST['banner_colour'];
			$banner_title = $_POST['banner_title'];
			$banner_text = $_POST['banner_text'];
			$banner_link_text = $_POST['banner_link_text'];
			$banner_link = $_POST['banner_link'];
			update_site_option('banner_colour', $banner_colour);
			update_site_option('banner_title', $banner_title);
			update_site_option('banner_text', $banner_text);
			update_site_option('banner_link_text', $banner_link_text);
			update_site_option('banner_link', $banner_link);
		} ?>

        <div class="wrap">
            <h2>Banner setting</h2>

            <p>This page controls the banner display across this site.</p>

            <p>If you choose to display the banner here, it will display across all sites in the network unless explicitly turned off in the options of a specific site.</p>

            <form method="POST" action="settings.php?page=banner-settings">

                <?php wp_nonce_field('banner-settings') ?>

                <table class="form-table">
                    <tr>
                        <td>
                            <label>
                                Display banner <input type="checkbox" name="banner_setting" value="1" <?php checked(get_site_option('banner_setting'), 1) ?> >
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Allow users to dismiss banner <input type="checkbox" name="banner_dismissable" value="1" <?php checked(get_site_option('banner_dismissable'), 1) ?> >
                            </label>
                            <br/>
                            <p>If checked, users will be able to click a "No thanks" link to dismiss the banner for a year</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Banner background colour <input type="text" name="banner_colour" value="<?php echo esc_attr(get_site_option('banner_colour')) ?>">
                                <br/>
                                <p>Enter a CSS colour code (e.g. "#000000" for black). If left blank, default is blue.</p>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Banner title <input type="text" name="banner_title" value="<?php echo esc_attr(get_site_option('banner_title')) ?>">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Banner text <input type="text" name="banner_text" value="<?php echo esc_attr(get_site_option('banner_text')) ?>">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Banner link text <input type="text" name="banner_link_text" value="<?php echo esc_attr(get_site_option('banner_link_text')) ?>">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                Banner link <input type="url" name="banner_link" value="<?php echo esc_attr(get_site_option('banner_link')) ?>">
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
