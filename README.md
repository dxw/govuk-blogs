# GOV.UK Blogs

This is the theme in use for the blogs hosted at blog.gov.uk. It is currently in beta.


## Installation

Clone the theme:

    % cd wp-content/themes
    % git clone https://github.com/dxw/govuk-blogs.git

This will give you a functioning theme, but if you want to hack on it there are assets that need compiling. See the [Development](#development) section.


## Development

Requirements:

* node and npm
* grunt-cli and bower (npm install -g grunt-cli bower)

To set the theme up (only need to do this once):

    % npm install


### Static assets

To build the CSS/JS:

    % grunt

To have grunt watch your LESS/JS for changes and re-build them accordingly:

    % grunt watch

To opitimise PNGs and JPEGs (not done as part of any of the other tasks):

    % grunt img

The main LESS file is assets/css/main.less. JS is concatenated from assets/js/plugins/\* and assets/js/main.js (in that order).


### To update roots

    % composer update
    % phar-install


### To update govuk_template

    % grunt govuk_template

This generates a mustache template and lots of CSS and JS which all ends up in build/govuk_template. The mustache template is included from base.php.


## This theme uses

* http://www.rootstheme.com/
* http://twitter.github.io/bootstrap/
* http://lesscss.org/
* http://gruntjs.com/
* https://github.com/alphagov/govuk_template


## Help and bug reports

If you get stuck with something we might be able to help (but can't guarantee it). We're always happy to receive bug reports (or, even better, pull requests).

If you'd like to get in touch about anything to do with this theme, please use the issue tracker on Github: https://github.com/dxw/govuk-blogs/issues


## Licence

GPLv2 or later (see LICENSE.txt)
