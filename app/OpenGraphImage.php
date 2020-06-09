<?php

namespace GovUKBlogs;

class OpenGraphImage implements \Dxw\Iguana\Registerable
{
    public function register() : void
    {
        add_action('wp_head', [$this, 'wpHead']);
    }

    public function wpHead() : void
    {
    }
}
