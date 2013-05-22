grunt-img
=============

[Grunt][grunt] task to optimize PNG and JPG images with [optipng][optipng] & [jpegtran][jpegtran].

## Getting Started

First, be sure that you have [optipng][optipng] 0.7(or earlier) and [jpegtran][jpegtran] installed in your system.

### for Mac users
You can install with [homebrew][homebrew]
```shell
brew install optipng jpeg
```

### for Linux users
Debian, Ubuntu and Mint
```shell
apt-get install optipng libjpeg libjpeg-progs
```
Both libraries are easy to find for RPM distributions too.

### for Windows users
Don't worry because both libraries are included.

### Setup task grunt-img with grunt.js
Install this task next to your project's [grunt.js gruntfile][getting_started] with:
```shell
npm install grunt-img
```

Then add the line bellow to your project's `grunt.js` gruntfile:

```javascript
grunt.loadNpmTasks('grunt-img');
```
Questions? Take a look at [this stream](http://shelr.tv/records/5007063396608020cc000117)

## How to config
Grunt provide a simple way to config its tasks, grunt-img follow the same principle:

```js
grunt.initConfig({
    img: {

        // using only dirs with output path
        task1: {
            src: 'public/src',
            dest: 'public/img'
        },

        // recursive extension filter with output path
        task2: {
            src: ['public/src/**/*.png'],
            dest: 'public/img'
        },

        // file by file with output path
        task3: {
            src: ['public/src/logo.png','public/src/social.jpg'],
            dest: 'public/img'
        },

        // single path to optimize and replace all images
        task4: {
            src: 'public/img'
        },

        // file by file to optimize and replace
        task5: {
            src: ['public/img/concert.jpg, public/img/halestorm.png']
        },

        // filter extension to optimize and replace
        task6: {
            src: ['public/img/*.png']
        }
    }
});
```


## License

MIT License
(c) [Helder Santana](http://heldr.com)

Credits
---------------
* HTML5 Boilerplate [node-build-script][node-build-script]

[node-build-script]: http://github.com/h5bp/node-build-script
[grunt]: https://github.com/cowboy/grunt
[getting_started]: https://github.com/cowboy/grunt/blob/master/docs/getting_started.md
[jpegtran]: http://jpegclub.org/jpegtran/
[optipng]: http://optipng.sourceforge.net/
[homebrew]: http://mxcl.github.com/homebrew/