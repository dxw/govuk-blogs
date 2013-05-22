## GOV.UK Blogs

This is the theme in use for the blogs hosted at blog.gov.uk. It is currently in beta.

## Installation

The theme uses Bootstrap, Roots, Grunt and Less CSS. After you've cloned the repo, there are some extra steps you'll need to follow to get up and running:

First, make sure you've got the Bootstrap and Roots submodules:

```
$ git submodule update --init
```

This should give you the functioning theme. But the CSS is written in Less, and compiled to main.min.css.

The best way to develop efficiently using Less is to install Grunt, following the instructions here:

http://gruntjs.com/getting-started

and then to run grunt watch in the background while you're developing. This will watch for changes to your .less files and automatically compile them. If you prefer, you can also install and run less manually. (You don't need to do this if you've installed Grunt.) For more information about less, including installation instructions, visit:

 http://lesscss.org/

## Help and bug reports

If you get stuck with something we might be able to help (but can't guarantee it). We're always happy to receive bug reports (or, even better, pull requests).

If you'd like to get in touch about anything to do with this theme, please use the issue tracker on Github: https://github.com/dxw/govuk-blogs/issues

## Licence

GPLv2 or later

