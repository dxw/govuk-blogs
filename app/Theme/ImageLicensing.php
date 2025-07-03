<?php

namespace GovUKBlogs\Theme;

class ImageLicensing implements \Dxw\Iguana\Registerable
{
	public static $imageLicenses = [
		'ogl' => [
			'name' => 'OGL',
			'link' => 'http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/',
			'display' => false,
		],
		'cc-by' => [
			'name' => 'Creative Commons Attribution',
			'link' => 'http://creativecommons.org/licenses/by/4.0',
			'display' => true,
		],
		'cc-by-sa' => [
			'name' => 'Creative Commons Attribution-ShareAlike',
			'link' => 'http://creativecommons.org/licenses/by-sa/4.0',
			'display' => true,
		],
		'cc-by-nd' => [
			'name' => 'Creative Commons Attribution-NoDerivs',
			'link' => 'http://creativecommons.org/licenses/by-nd/4.0',
			'display' => true,
		],
		'cc-by-nc' => [
			'name' => 'Creative Commons Attribution-NonCommercial',
			'link' => 'http://creativecommons.org/licenses/by-nc/4.0',
			'display' => true,
		],
		'cc-by-nc-sa' => [
			'name' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
			'link' => 'http://creativecommons.org/licenses/by-nc-sa/4.0',
			'display' => true,
		],
		'cc-by-nc-nd' => [
			'name' => 'Creative Commons Attribution-NonCommercial-NoDerivs',
			'link' => 'http://creativecommons.org/licenses/by-nc-nd/4.0',
			'display' => true,
		],
		'other' => [
			'name' => 'Other',
			'link' => null,
			'display' => false,
		],
	];

	public function register()
	{
		add_filter('render_block', [$this, 'renderBlock'], 10, 2);
	}

	public function generateLicenseCaption($attachmentId)
	{
		$license = get_post_meta($attachmentId, 'licence', true);
		$licenseData = self::$imageLicenses[$license];

		if (!$licenseData['display']) {
			return null;
		}

		$caption = 'Licence: ';
		$caption .= '<a href="' . esc_attr($licenseData['link']) . '">' . esc_html($licenseData['name']) . '</a>';

		$copyrightHolder = get_post_meta($attachmentId, 'copyright_holder', true);
		$linkToSource = get_post_meta($attachmentId, 'link_to_source', true);

		if ($copyrightHolder || $linkToSource) {
			$caption .= ' ' . ($linkToSource
				? '<a href="' . esc_attr($linkToSource) . '">' . esc_html($copyrightHolder ?: 'Source') . '</a>'
				: esc_html($copyrightHolder));
		}

		return $caption;
	}

	public function renderBlock($blockContent, $block)
	{
		if ($block['blockName'] !== 'core/image') {
			return $blockContent;
		}

		$attachmentId = $block['attrs']['id'];
		$licenseCaption = $this->generateLicenseCaption($attachmentId);
		$licenseCaptionHtml = '<figcaption class="caption" data-license-caption="true">' . $licenseCaption . '</figcaption>';

		return '<figure class="wp-block-image">' . $blockContent . $licenseCaptionHtml . '</figure>';
	}
}
