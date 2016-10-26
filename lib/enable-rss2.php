<?php

// We need to re-enable RSS2 (the UseAtom module of iguana-extras disables it
// along with all other non-Atom formats).
//
// In WP's Atom feed, titles are encoded as HTML (the Atom spec allows XHTML
// (RIP), plain text, or HTML in titles).
//
// There is a company called GovDelivery with a product that turns feeds into
// emails, and their product does not follow the Atom specification and it
// treats all titles as plain text.
//
// Fortunately, one of WordPress's feeds uses plain text titles so we can just
// enable that one instead of having to maintain a separate copy of WP's Atom
// template.
//
// GovDelivery have acknowledged this bug in their product but have not
// provided an estimate as to when it'll be fixed.

add_action('init', function () {
    add_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
}, 11);
