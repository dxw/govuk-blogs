//
// == Installation ==
//
// Install the grunt command-line tool (-g puts it in /usr/local/bin):
// % sudo npm install -g grunt-cli
//
// Install all the packages required to build this:
// (Packages will be installed in ./node_modules - don't accidentally commit this)
// % cd wp-content/themes/theme-name
// % npm install
//
// == Building ==
//
// % grunt
//
// Watch for changes:
// % grunt watch
//
// Compress images (not done by the above tasks):
// % grunt img
//

module.exports = function (grunt) {
    'use strict';

    const sass = require('node-sass')

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            options: {
                implementation: sass,
                outputStyle: 'compressed',
                sourceMap: true,
                includePaths: ['node_modules/'],
            },
            production: {
                files: {
                    'build/main.min.css': 'assets/css/main.scss',
                    'build/admin.min.css': 'assets/css/admin.scss',
                }
            }
        },

        uglify: {
            dist: {
                options: {
                    preserveComments: 'some',
                    compress: false,
                    sourceMap: 'build/main.min.js.map',
                    sourceMappingURL: 'main.min.js.map',
                    sourceMapRoot: '../',
                },
                files: {
                    'build/main.min.js': [
                        'assets/js/plugins/*.js',
                        'node_modules/jquery-placeholder/jquery.placeholder.js',
                        'node_modules/bowser/bowser.js',
                        'node_modules/url-polyfill/url-polyfill.js',
                        'node_modules/es6-promise/dist/es6-promise.auto.js',
                        'node_modules/govuk-frontend/govuk/all.js',
                        'assets/js/main.js',
                        'assets/js/comments.js'
                    ],
                },
            },
        },

        copy: {
            dist: {
                files: [
                    {
                        src: [
                            'node_modules/bootstrap/img/glyphicons-halflings.png',
                            'node_modules/bootstrap/img/glyphicons-halflings-white.png',
                            'node_modules/govuk-frontend/govuk/assets/fonts/*',
                            'node_modules/govuk-frontend/govuk/assets/images/*'
                        ],
                        dest: 'build/',
                    },
                ],
            },
        },

        image: {
          dynamic: {
            files: [{
              expand: true,
              cwd: 'assets/img',
              src: ['**/*.{png,jpg,gif,svg}'],
              dest: 'assets/img'
            }]
          }
        },

        _watch: {
            css: {
                files: ['assets/css/**/*.scss'],
                tasks: ['sass'],
            },
            js: {
                files: ['assets/js/**/*.js'],
                tasks: ['uglify'],
            },
        },
    })

    grunt.loadNpmTasks('grunt-sass')
    grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.loadNpmTasks('grunt-contrib-copy')
    grunt.loadNpmTasks('grunt-image')

    grunt.renameTask('watch', '_watch')
    grunt.registerTask('watch', [
        'default',
        '_watch',
    ])

    grunt.registerTask('default', [
        'copy',
        'sass',
        'uglify',
    ])

}
