<?php
function logo_get_default_options() {
	$options = array(
		'logo' => ''
	);
	return $options;
}


function logo_options_init() {
     $logo_options = get_option( 'theme_logo_options' );
	 

     if ( false === $logo_options ) {

          $logo_options = logo_get_default_options();
		  add_option( 'theme_logo_options', $logo_options );
     }

}

add_action( 'after_setup_theme', 'logo_options_init' );

function logo_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'logo_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), 'logo-settings' );
		if ( $referer != '' ) {
			return __('I want this to be my logo!', 'logo' );
		}
	}

	return $translated_text;
}


function logo_menu_options() {

     add_theme_page('Logo Options', 'Logo Options', 'edit_theme_options', 'logo-settings', 'logo_admin_options_page');
}

add_action('admin_menu', 'logo_menu_options');

function logo_admin_options_page() {
	?>
		
		
		<div class="wrap">
			
			<div id="logo-themes" class="logo32"><br /></div>
		
			<h2><?php _e( 'Logo Options', 'logo' ); ?></h2>
			
			<?php settings_errors( 'logo-settings-errors' ); ?>
			
			<form id="form-logo-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_logo_options');
					do_settings_sections('logo');
				?>
			
				<p class="submit">
					<input name="theme_logo_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'logo'); ?>" />
					<input name="theme_logo_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'logo'); ?>" />		
				</p>
			
			</form>
			
		</div>
	<?php
}

function logo_options_validate( $input ) {
	$default_options = logo_get_default_options();
	$valid_input = $default_options;
	
	$logo_options = get_option('theme_logo_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	if ( $submit ) {
		if ( $logo_options['logo'] != $input['logo']  && $logo_options['logo'] != '' )
			delete_image( $logo_options['logo'] );
		
		$valid_input['logo'] = $input['logo'];
	}
	elseif ( $reset ) {
		delete_image( $logo_options['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		delete_image( $logo_options['logo'] );
		$valid_input['logo'] = '';
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	

	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);

	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function logo_options_enqueue_scripts() {
	wp_register_script( 'logo-upload', get_template_directory_uri() .'/lib/js/logo-upload.jquery.js', array('jquery','media-upload','thickbox') );	

	if ( 'appearance_page_logo-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('logo-upload');
		
	}
	
}
add_action('admin_enqueue_scripts', 'logo_options_enqueue_scripts');


function logo_options_settings_init() {
	register_setting( 'theme_logo_options', 'theme_logo_options', 'logo_options_validate' );
	
	add_settings_section('logo_settings_header', __( 'Logo Options', 'logo' ), 'logo_settings_header_text', 'logo');
	
	add_settings_field('logo_setting_logo',  __( 'Logo', 'logo' ), 'logo_setting_logo', 'logo', 'logo_settings_header');
	
	add_settings_field('logo_setting_logo_preview',  __( 'Logo Preview', 'logo' ), 'logo_setting_logo_preview', 'logo', 'logo_settings_header');
}
add_action( 'admin_init', 'logo_options_settings_init' );

function logo_setting_logo_preview() {
	$logo_options = get_option( 'theme_logo_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $logo_options['logo'] ); ?>" />
	</div>
	<?php
}

function logo_settings_header_text() {
	?>
		<p><?php _e( 'Upload a logo for this blog.', 'logo' ); ?></p>
	<?php
}

function logo_setting_logo() {
	$logo_options = get_option( 'theme_logo_options' );
	?>
		<input type="hidden" id="logo_url" name="theme_logo_options[logo]" value="<?php echo esc_url( $logo_options['logo'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload logo', 'logo' ); ?>" />
		<?php if ( '' != $logo_options['logo'] ): ?>
			<input id="delete_logo_button" name="theme_logo_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete logo', 'logo' ); ?>" />
		<?php endif; ?>
	<?php
}



?>