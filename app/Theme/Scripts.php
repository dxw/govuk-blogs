<?php

namespace GovUKBlogs\Theme;

class Scripts implements \Dxw\Iguana\Registerable
{
	private $cssManifest;

	public function __construct(CSSManifest $cssManifest)
	{
		$this->cssManifest = $cssManifest;
	}

	public function register()
	{
		add_action('wp_enqueue_scripts', [$this, 'wpEnqueueScripts']);
		add_action('after_setup_theme', [$this, 'wpEnqueueEditorStyles']);
		add_filter('wp_script_attributes', [$this, 'addScriptTypeToJs'], 10, 1);
		add_action('enqueue_block_editor_assets', [$this, 'enqueueBlocksVariations']);
		add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockStyleVariations']);
	}

	private function getFingerPrintedPath($path)
	{
		$newFileName = $this->cssManifest->get($path);
		return get_template_directory_uri() . '/' . $newFileName;
	}

	private function getFingerPrintedRelativePath($path)
	{
		return $this->cssManifest->get($path);
	}

	public function wpEnqueueScripts()
	{
		wp_enqueue_script('main', $this->getFingerPrintedPath('build/main.min.js'), ['jquery']);
		wp_enqueue_script('govuk-frontend', get_template_directory_uri().'/build/govuk-frontend-load.js');
		wp_enqueue_style('main', $this->getFingerPrintedPath('build/main.min.css'));
	}

	public function wpEnqueueEditorStyles()
	{
		add_editor_style($this->getFingerPrintedRelativePath('build/admin.min.css'));
	}

	public function addScriptTypeToJs($attr)
	{
		if (empty($attr['id']) || empty($attr['src'])) {
			return $attr;
		}

		if ($attr['id'] === 'govuk-frontend-js') {
			$attr['type'] = 'module';
		}

		return $attr;
	}

	public function enqueueBlocksVariations()
	{
		wp_enqueue_script(
			'blocks-variations',
			get_theme_file_uri('/assets/js/block-variations.js'),
			[
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post',
			],
			'',
			true
		);
	}

	public function enqueueBlockStyleVariations()
	{
		wp_enqueue_script(
			'block-style-variations',
			get_theme_file_uri('/assets/js/block-style-variations.js'),
			[
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post'
			]
		);
	}
}
