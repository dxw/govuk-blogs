# GOV.UK Blogs

This is the theme in use for the blogs hosted at blog.gov.uk.


## Installation

Clone the theme:

    % cd wp-content/themes
    % git clone https://github.com/dxw/govuk-blogs.git

This will give you a functioning theme, but if you want to hack on it there are assets that need compiling. See the [Development](#development) section.


## Development

Open MRs directly to `master`. We don't use a `develop` branch, as this is a theme repo rather than an app, so it doesn't trigger any deployments. Deploys are triggered by updating the whippet files in the apps that use this theme.

Requirements:

* [yarn](https://yarnpkg.com/)
* [composer](https://getcomposer.org/)
* Run this in the theme: yarn install

If it's in build, don't touch it because it'll get overwritten.

JS and SASS files live in assets/js and assets/css. To compile them when they change run this:

    % yarn run grunt watch

Images can be optimised like so:

    % yarn run grunt img

This theme is based on [GOV.UK Frontend](https://github.com/alphagov/govuk-frontend).

To update the composer modules:

    % composer update

To work on the native blocks run `npm start` from within the block root directory - a recent or LTS version of Node is recommended.

## Versioning

Use the [semantic versioning](https://semver.org/) standard.

The version should be updated in `style.css`, and the appropriate commit tagged as `vX.Y.Z`.

Update [the changelog](CHANGELOG.md) following the standard at https://keepachangelog.com/en/1.0.0/.

## This theme uses

* http://www.rootstheme.com/
* https://sass-lang.com/
* http://gruntjs.com/
* https://github.com/alphagov/govuk-frontend
* https://github.com/bobthecow/mustache.php
* https://github.com/dxw/php-missing


## Help and bug reports

If you get stuck with something we might be able to help (but can't guarantee it). We're always happy to receive bug reports (or, even better, pull requests).

If you'd like to get in touch about anything to do with this theme, please use the issue tracker on GitHub: https://github.com/dxw/govuk-blogs/issues


## Licence

GPLv2 or later (see LICENSE.txt)
