<?php

namespace GovUKBlogs\Embed;

class YouTube implements \Dxw\Iguana\Registerable
{
    public function register() : void
    {
        add_filter('embed_oembed_html', [$this, 'forceHttps']);
    }

    // Force to HTTPS
    public function forceHttps(string $cache) : string
    {
        $cache = preg_replace('$http://www.youtube.com$', 'https://www.youtube.com', $cache);
        return $cache;
    }
}
