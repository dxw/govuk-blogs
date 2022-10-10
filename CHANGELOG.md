# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

### Removed

- Support for PHP versions below 7.4

## [3.3.4] - 2022-02-15

### Changed

- permission to allow Editors access to menus and widgets

## [3.3.4] - 2022-02-15

### Changed

- Mustache bumped to v2.14.1 to patch [security issue](https://github.com/advisories/GHSA-4rmr-c2jx-vx27)

## [3.3.3] - 2021-11-29

- Fix contrast for cookie consent button 

## [3.3.2] - 2021-08-27

- Escape author and co-author names in atom feeds

## [3.3.1] - 2021-08-25

### Changed

- Customised override styles to improve accessibility of cookie consent overlay, including better focus states and layout for smaller screen sizes

## [3.3.0] - 2021-04-09

### Changed

- The network-wide banner has an extra configuration options: additional text field, background colour, and ability to make non-dismissable

## [3.2.1] - 2021-03-10

### Changed

- The "Archives with dropdown" widget wraps its list of archive links in a `<ul>`


## [3.2.0] - 2021-02-16

### Changed

- Fixed jQuery plugin (assets/js/comments.js) to restore display of error information when a user tries to submit a form with empty required fields
- Accessible "Archives with dropdown" widget
- Styles on "Categories with dropdown" widget made more consistent with govuk-frontend default styles

## [3.1.9] - 2020-07-23

### Removed

- Remove CSS height constraint on homepage featured images

## [3.1.8] - 2020-07-14

### Removed

- Force HTTPS filter for YouTube videos (the oEmbed endpoint now returns HTTPS URLs)
- Add title attribue filter for YouTube videos (the oEmbed endpoint now includes a title attribute)

### Added

- New filter for YouTube videos to add -nocookie to URL

## [3.1.7] - 2020-07-02

### Changed

- Featured blog post images on homepage are tabbable and highlighted on focus

## [3.1.6] - 2020-06-30

### Changed
- "Read more" links include hidden text specifying the post name for screenreader users
- License switched to MIT

## [3.1.5] - 2020-06-24

### Changed
- Do not mark up blog count number as an h2

## [3.1.4] - 2020-06-11

### Changed
- og:image in HEAD links to the featured image

## [3.1.3] - 2020-06-03

### Changed
- Native browser styles used for text highlighting

## [3.1.2] - 2020-05-01

### Changed
- Visited link colour is only applied to visited links, rather than all links

## [3.1.1] - 2020-04-29

### Changed
- `grunt-contrib-sass` replaced by `grunt-sass`. This means we can use Node Sass, rather than the deprecated Ruby Sass gem.
- Borders at top of article listings darkened

## [3.1.0] - 2020-04-27

### Removed
- Govuk Template support. Govuk Frontend is now out of compatibility mode, and all Govuk Template assets removed
- IE6 styles

### Changed
- Correct formatting of post author/date restored

## [3.0.0] - 2020-04-27

### Changed
- Govuk Frontend added in compatibility mode (see https://frontend.design-system.service.gov.uk/migrating-from-legacy-products/)
- All markup migrated to comply with Govuk Frontend v3
- Some minor colour scheme changes as per new Frontend template
- Presentational markup for history mode plugin included in theme rather than plugin

## [2.7.1] - 2020-04-08

### Changed
- Upgrade Yarn dependencies to resolve vulnerabilities reported by yarn audit
- Only attempt to log external link clicks with Google Analytics if GA is loaded

## [2.7.0] - 2019-12-20

### Changed
- Cookie banner is always hidden by default.

## [2.6.0] — 2019-12-19

### Added
- A new constant `LOGO_OPTIONS_SUPERADMIN_ONLY` which restricts the logo options page to super admin users

## [2.5.3] - 2019-12-17

### Changed
- Clearer focus style for form inputs and linked images.

## [2.5.2] - 2019-12-13

### Added
- A method to remove the function that Roots hooks onto the 'styler_loader_tag' filter, as this was breaking admin styles in WordPress 5.3 and up.

## [2.5.1] — 2019-12-12

### Added
- Autocomplete attributes for comment form name & email fields

### Changed
- Link focus style updated to reflect Gov.uk design system
- Pagination link HTML is now rendered in the same order as it is displayed, to ensure tab order is easy to follow
- Change all ".visually-hidden" class to ".visuallyhidden" for consistency reason
- The current page number in pagination has no link attached to it

## [2.5.0] — 2019-12-10

### Changed

- Hidden "Sharing and Comments" heading moved below pagination elements
- Colour contrast increased for search placeholder text and "Blog" title
- The "No quotes" option in the "Formats" dropdown in the editor is replaced by a "Highlight" option. This produces the same styles, but using a div to wrap the content rather than a blockquote, as the blockquote use was semantically incorrect.

## Earlier releases

Releases up to and including 2.4.0 predate this changelog.
