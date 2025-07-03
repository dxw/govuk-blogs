<?php

namespace GovUKBlogs\Theme;

class ImageLicensing implements \Dxw\Iguana\Registerable
{
    public static $imageLicenses = [
        'ogl' => [
            'name' => 'OGL',
            'link' => 'http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/',
            'display' => false,
        ],
        'cc-by' => [
            'name' => 'Creative Commons Attribution',
            'link' => 'http://creativecommons.org/licenses/by/4.0',
            'display' => true,
        ],
        'cc-by-sa' => [
            'name' => 'Creative Commons Attribution-ShareAlike',
            'link' => 'http://creativecommons.org/licenses/by-sa/4.0',
            'display' => true,
        ],
        'cc-by-nd' => [
            'name' => 'Creative Commons Attribution-NoDerivs',
            'link' => 'http://creativecommons.org/licenses/by-nd/4.0',
            'display' => true,
        ],
        'cc-by-nc' => [
            'name' => 'Creative Commons Attribution-NonCommercial',
            'link' => 'http://creativecommons.org/licenses/by-nc/4.0',
            'display' => true,
        ],
        'cc-by-nc-sa' => [
            'name' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
            'link' => 'http://creativecommons.org/licenses/by-nc-sa/4.0',
            'display' => true,
        ],
        'cc-by-nc-nd' => [
            'name' => 'Creative Commons Attribution-NonCommercial-NoDerivs',
            'link' => 'http://creativecommons.org/licenses/by-nc-nd/4.0',
            'display' => true,
        ],
        'other' => [
            'name' => 'Other',
            'link' => null,
            'display' => false,
        ],
    ];
}
