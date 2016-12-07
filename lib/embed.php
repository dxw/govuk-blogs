<?php

#
# Add non-default embed handlers, and fix ones which are not HTTPS aware
#

# Storify
wp_oembed_add_provider('#https?://storify.com/.*#', 'https://api.embed.ly/1/oembed', true);


# Youtube: force to HTTPS
add_filter('embed_oembed_html', function ($cache, $url=null, $attr=null, $post_ID=null) {
  $cache = preg_replace('$http://www.youtube.com$', 'https://www.youtube.com', $cache);
  return $cache;
});


# Youtube: Don't show related videos
# Credit: http://wordpress.org/plugins/hide-youtube-related-videos/
add_filter('oembed_result', function ($data, $url, $args = array()) {
  $data = preg_replace('/(youtube\.com.*)(\?feature=oembed)(.*)/', '$1?wmode=transparent&amp;rel=0$3', $data);
  return $data;
}, 10, 3);

# Instagram: add class so Instagram embeds can be styled independently
add_filter('embed_oembed_html', function ($cache, $url, $attr, $post_ID) {
    if (preg_match('/https?:\/\/www\.\instagram\.com/', $url)==1) {
        $cache = str_replace('<div class="entry-content-asset">', '<div class="entry-content-asset instagram-embed">', $cache);
        return $cache;
    }
}, 10, 4);


# CoverItLive
add_filter('the_content', function ($content) {
  global $content_width;

  $ex = "_<p>(https?://(www\.)?coveritlive\.com/\S+)</p>_i";
  $replacement = '<iframe src="${1}&width='.$content_width.'" class="coveritlive"></iframe>';

  return preg_replace($ex, $replacement, $content);
});


# Audioboo
wp_oembed_add_provider('#https?://audioboo.fm/.*#', 'https://api.embed.ly/1/oembed?key=053112f24c9243bd891aada0a99ea83b&url=', true);
