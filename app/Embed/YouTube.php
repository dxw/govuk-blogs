<?php

namespace GovUKBlogs\Embed;

class YouTube implements \Dxw\Iguana\Registerable
{
    public function register() : void
    {
        add_filter('oembed_dataparse', [$this, 'forceHttps']);
        add_filter('oembed_dataparse', [$this, 'hideRelated']);
        add_filter('oembed_dataparse', [$this, 'addTitleAttribute'], 10, 3);
    }

    // Force to HTTPS
    public function forceHttps(string $cache) : string
    {
        $cache = preg_replace('_http://www.youtube.com_', 'https://www.youtube.com', $cache);
        return $cache;
    }

    // Don't show related videos
    // https://wordpress.org/plugins/hide-youtube-related-videos/
    public function hideRelated(string $data) : string
    {
        $data = preg_replace('_(youtube\.com.*)(\?feature=oembed)(.*)_', '$1?wmode=transparent&amp;rel=0$3', $data);
        return $data;
    }

    // Youtube: Add title attribute to iframe
    public function addTitleAttribute(string $return, object $data, string $url) : string
    {
        if (preg_match('_https?://((m|www)\.)?youtube\.com/watch.*_', $url)===1 || preg_match('_https?://youtu\.be/.*_', $url)===1) {
            if (isset($data->title)) {
                $return = str_replace('></iframe>', ' title="Video: ' . esc_attr($data->title) . '"></iframe>', $return);
            }
        }
        return $return;
    }
}
