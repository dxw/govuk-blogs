<?php

$fingerPrintedStyles = new FingerPrintedStyles(get_template_directory_uri() . '/build/fingerprint.json');
$fingerPrintedStyles->register();

class FingerPrintedStyles
{
    private $json;

    public function __construct($pathToCSSManifest)
    {
        $this->json = json_decode(file_get_contents($pathToCSSManifest), true);
    }

    public function get($fileName)
    {
        if (!array_key_exists($fileName, $this->json['rewrittenFiles'])) {
            return '';
        }
        return $this->json['rewrittenFiles'][$fileName];
    }

    private function getFingerPrintedCSSPath($path)
    {
        $newFileName = $this->get($path);
        return get_template_directory_uri() . '/' . $newFileName;
    }

    public function register()
    {
        add_action('wp_enqueue_scripts', function ($cssManifest) {
            wp_enqueue_script('main', $this->getFingerPrintedCSSPath('build/main.min.js'), ['jquery']);
            wp_enqueue_script('govuk-frontend', get_template_directory_uri().'/build/govuk-frontend-load.js');
            wp_enqueue_style('main', $this->getFingerPrintedCSSPath('build/main.min.css'));
        });

        add_action('admin_enqueue_scripts', function ($cssManifest) {
            wp_enqueue_style('admin', $this->getFingerPrintedCSSPath('build/admin.min.css'));
        });
    }
}

add_action('init', function () {
    remove_action('wp_enqueue_scripts', 'roots_scripts', 100);
});

add_action('wp_head', function () {
    ?>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
  <?php
});

add_filter('wp_script_attributes', 'addScriptTypeToJs', 10, 1);

function addScriptTypeToJs($attr)
{
    if (empty($attr['id']) || empty($attr['src'])) {
        return $attr;
    }

    if ($attr['id'] === 'govuk-frontend-js') {
        $attr['type'] = 'module';
    }

    return $attr;
}
