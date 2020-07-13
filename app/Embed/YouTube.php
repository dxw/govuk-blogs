<?php

namespace GovUKBlogs\Embed;

class YouTube implements \Dxw\Iguana\Registerable
{
    public function register() : void
    {
        add_filter('embed_oembed_html', [$this, 'forceHttps']);
        add_filter('oembed_result', [$this, 'hideRelated']);
    }

    // Force to HTTPS
    public function forceHttps(string $cache) : string
    {
        $cache = preg_replace('$http://www.youtube.com$', 'https://www.youtube.com', $cache);
        return $cache;
    }

    // Don't show related videos
    // https://wordpress.org/plugins/hide-youtube-related-videos/
    public function hideRelated(string $data) : string
    {
        $data = preg_replace('/(youtube\.com.*)(\?feature=oembed)(.*)/', '$1?wmode=transparent&amp;rel=0$3', $data);
        return $data;
    }
}
