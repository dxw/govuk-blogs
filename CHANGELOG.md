# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
