<?php
$govukFrontendAssetPath = get_template_directory_uri() . '/build/govuk-assets/';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
		<meta name="theme-color" content="#0b0c0c">

		<link rel="icon" sizes="48x48" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/favicon.ico">
		<link rel="icon" sizes="any" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/favicon.svg" type="image/svg+xml">
		<link rel="mask-icon" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/govuk-icon-mask.svg" color="#0b0c0c">
		<link rel="apple-touch-icon" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/govuk-icon-180.png">
		<link rel="manifest" href="<?php echo esc_url($govukFrontendAssetPath); ?>manifest.json">
		<meta name="theme-color" content="#0b0c0c">

		<link rel="icon" sizes="48x48" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/favicon.ico">
		<link rel="icon" sizes="any" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/favicon.svg" type="image/svg+xml">
		<link rel="mask-icon" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/govuk-icon-mask.svg" color="#0b0c0c">
		<link rel="apple-touch-icon" href="<?php echo esc_url($govukFrontendAssetPath); ?>images/govuk-icon-180.png">
		<link rel="manifest" href="<?php echo esc_url($govukFrontendAssetPath); ?>manifest.json">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class('govuk-template__body'); ?>>
		<?php wp_print_inline_script_tag("document.body.className += ' js-enabled' + ('noModule' in HTMLScriptElement.prototype ? ' govuk-frontend-supported' : '');");?>

		<a href="#content" class="govuk-skip-link" data-module="govuk-skip-link">Skip to main content</a>

		<header class="govuk-template__header">
			<div class="govuk-header" data-module="govuk-header">
				<div class="govuk-header__container govuk-width-container">
					<div class="govuk-header__logo">
						<a href="https://www.gov.uk/" title="Go to the GOV.UK homepage" id="logo" class="govuk-header__homepage-link">
							<?php include(get_template_directory().'/assets/img/govuk-logo.svg'); ?>
						</a>
					</div>
				</div>
			</div>
		</header>

		<?php get_template_part('templates/banner'); ?>
		<?php get_template_part('templates/main-content'); ?>
		<footer class="govuk-template__footer">
			<div class="govuk-footer js-footer">

				<div class="govuk-width-container">
					<?php include(get_template_directory().'/assets/img/govuk-crown.svg'); ?>
					<div class="govuk-footer__meta">
						<div class="govuk-footer__meta-item govuk-footer__meta-item--grow">
							<h2 class="govuk-visually-hidden">Useful links</h2>
							<?php get_template_part('templates/footer'); ?>
							<?php include(get_template_directory().'/assets/img/ogl-logo.svg'); ?>
							<span class="govuk-footer__licence-description">
								<?php get_template_part('templates/licence'); ?>
							</span>
						</div>

						<div class="govuk-footer__meta-item">
							<a class="govuk-footer__link govuk-footer__copyright-logo" href="https://www.nationalarchives.gov.uk/information-management/re-using-public-sector-information/uk-government-licensing-framework/crown-copyright/">© Crown copyright</a>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<div id="global-app-error" class="app-error hidden"></div>

		<?php wp_footer(); ?>
	</body>
</html>
