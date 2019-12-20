# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
