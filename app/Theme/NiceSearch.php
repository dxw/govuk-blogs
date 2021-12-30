<?php

namespace GovUKBlogs\Theme;

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 * @link https://github.com/roots/soil/blob/main/src/Modules/NiceSearchModule.php
 */
class NiceSearch implements \Dxw\Iguana\Registerable
{
    public function register()
    {
        add_filter('template_redirect', [$this, 'redirect']);
        add_filter('wpseo_json_ld_search_url', [$this, 'rewrite']);
    }

    /**
     * Redirect query string search results to pretty URL.
     */
    public function redirect()
    {
        global $wp_rewrite;

        if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->get_search_permastruct()) {
            return;
        }

        $search_base = $wp_rewrite->search_base;

        if (
            is_search()
            && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false
            && strpos($_SERVER['REQUEST_URI'], '&') === false
        ) {
            if (wp_redirect(get_search_link())) {
                exit;
            }
        }
    }
    /**
     * Rewrite query string search URL as pretty URL.
     */
    public function rewrite(string $url)
    {
        return str_replace('/?s=', '/search/', $url);
    }
}
