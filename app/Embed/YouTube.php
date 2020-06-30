<?php

namespace GovUKBlogs\Embed;

class YouTube implements \Dxw\Iguana\Registerable
{
    public function register() : void
    {
        add_filter('oembed_dataparse', [$this, 'hideRelated']);
        add_filter('oembed_dataparse', [$this, 'useNocookie']);
    }

    // Don't show related videos
    // https://wordpress.org/plugins/hide-youtube-related-videos/
    public function hideRelated(string $data) : string
    {
        $data = preg_replace('_(youtube\.com.*)(\?feature=oembed)(.*)_', '$1?wmode=transparent&amp;rel=0$3', $data);
        return $data;
    }

    // Use -nocookie URL
    public function useNocookie(string $html) : string
    {
        $html = preg_replace('_//(www.)?youtube.com/_', '//www.youtube-nocookie.com/', $html);
        return $html;
    }
}
