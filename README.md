GOV.UK Blogs
============

This is the theme in use for the blogs hosted at blog.gov.uk. It is currently in beta.

The theme uses Bootstrap, Roots, Grunt, and LESS.


## Installation

Clone the repo into the WordPress themes directory:

    $ cd wp-content/themes
    $ git clone https://github.com/dxw/govuk-blogs.git

After you've cloned the repo, there are some extra steps you'll need to follow to get up and running:

    $ cd govuk-blogs
    $ git submodule update --init

This should give you the functioning theme. But the CSS and JavaScript require compilation (see Development).


## Development

To compile the JavaScript (concatenation and minification) and CSS (from LESS), you'll need to install grunt and this project's dependencies.

To get set up:

    $ sudo npm install -g grunt-cli bower # install grunt command line tool and bower
    $ cd themes/govuk-blogs
    $ npm install                         # MUST be run in govuk-blogs directory
    $ bower install                       # ditto

To have grunt watch your LESS/JS for changes and re-build them accordingly:

    $ grunt watch

Or to compile the CSS/JS only once:

    $ grunt

And finally, to opitimise PNGs and JPEGs (not done as part of any of the other tasks):

    $ grunt img

The main LESS file is assets/css/main.less. JS is concatenated from assets/js/plugins/\* and assets/js/main.js (in that order).


## To update roots

    $ composer update
    $ phar-install


## This theme uses

* http://www.rootstheme.com/
* http://twitter.github.io/bootstrap/
* http://lesscss.org/
* http://gruntjs.com/


## Help and bug reports

If you get stuck with something we might be able to help (but can't guarantee it). We're always happy to receive bug reports (or, even better, pull requests).

If you'd like to get in touch about anything to do with this theme, please use the issue tracker on Github: https://github.com/dxw/govuk-blogs/issues


## Licence

GPLv2 or later (see LICENSE.txt)
