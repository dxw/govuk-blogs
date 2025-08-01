<?php

namespace GovUKBlogs\Theme;

class ImageLicensing implements \Dxw\Iguana\Registerable
{
	/**
	* @var array<string, array{
	*     name:   string,
	*     link:   string|null,
	*     display: bool
	* }>
	*/
	public static $imageLicences = [
		'ogl' => [
			'name' => 'OGL',
			'link' => 'https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/',
			'display' => false,
		],
		'cc-by' => [
			'name' => 'Creative Commons Attribution',
			'link' => 'https://creativecommons.org/licenses/by/4.0',
			'display' => true,
		],
		'cc-by-sa' => [
			'name' => 'Creative Commons Attribution-ShareAlike',
			'link' => 'https://creativecommons.org/licenses/by-sa/4.0',
			'display' => true,
		],
		'cc-by-nd' => [
			'name' => 'Creative Commons Attribution-NoDerivs',
			'link' => 'https://creativecommons.org/licenses/by-nd/4.0',
			'display' => true,
		],
		'cc-by-nc' => [
			'name' => 'Creative Commons Attribution-NonCommercial',
			'link' => 'https://creativecommons.org/licenses/by-nc/4.0',
			'display' => true,
		],
		'cc-by-nc-sa' => [
			'name' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
			'link' => 'https://creativecommons.org/licenses/by-nc-sa/4.0',
			'display' => true,
		],
		'cc-by-nc-nd' => [
			'name' => 'Creative Commons Attribution-NonCommercial-NoDerivs',
			'link' => 'https://creativecommons.org/licenses/by-nc-nd/4.0',
			'display' => true,
		],
		'other' => [
			'name' => 'Other',
			'link' => null,
			'display' => false,
		],
	];

	public function register(): void
	{
		add_filter('wp_prepare_attachment_for_js', [$this, 'appendLicenceToCaption'], 10, 2);
		add_filter('render_block_core/image', [$this, 'renderBlock'], 10, 2);
	}

	private function generateLicenceCaption(int $attachmentId): ?string
	{
		$licence = (string) get_post_meta($attachmentId, 'licence', true);

		if (empty($licence)) {
			return null;
		}

		$licenceData = self::$imageLicences[$licence];

		if (!$licenceData['display']) {
			return null;
		}

		$caption = 'Licence: <a href="' . esc_attr((string) $licenceData['link']) . '">' . esc_html($licenceData['name']) . '</a>';

		$copyrightHolder = (string) get_post_meta($attachmentId, 'copyright_holder', true);
		$linkToSource = (string) get_post_meta($attachmentId, 'link_to_source', true);

		if ($copyrightHolder || $linkToSource) {
			$caption .= ' ' . ($linkToSource
				? '<a href="' . esc_attr($linkToSource) . '">' . esc_html($copyrightHolder ?: 'Source') . '</a>'
				: esc_html($copyrightHolder));
		}

		return $caption;
	}

	public function appendLicenceToCaption(array $response, object $attachment): array
	{
		$caption = (string) $response['caption'];

		$caption = preg_replace('/(\n<br>\s*)?Licence:.*$/mi', '', $caption);
		$caption = trim($caption);

		$licenceCaption = $this->generateLicenceCaption((int) $attachment->ID);

		if (isset($licenceCaption)) {
			$caption = $caption ? $caption . "\n<br>" . $licenceCaption : $licenceCaption;
		}

		$response['caption'] = $caption;

		return $response;
	}

	public function renderBlock(string $blockContent, array $block): string
	{
		if (!isset($block['attrs']['id'])) {
			return $blockContent;
		}
		$attachmentId = (int) $block['attrs']['id'];

		$innerHTML = (string) $block['innerHTML'];
		if (stripos($innerHTML, 'Licence:') !== false) {
			return $blockContent;
		}

		$licenceCaption = $this->generateLicenceCaption($attachmentId);
		if (!isset($licenceCaption)) {
			return $blockContent;
		}

		if (stripos($blockContent, '<figcaption') !== false) {
			return preg_replace(
				'/(<\/figcaption>)/i',
				'<br>' . $licenceCaption . '$1',
				$blockContent,
				1
			);
		}

		return '<figure class="wp-block-image">' . $blockContent
			. '<figcaption class="caption">' . $licenceCaption . '</figcaption></figure>';
	}
}
