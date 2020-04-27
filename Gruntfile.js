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

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            production: {
                options: {
                    loadPath: 'node_modules/',
                    style: 'compressed',
                    sourcemap: 'auto'
                },
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

    grunt.loadNpmTasks('grunt-contrib-sass')
    grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.loadNpmTasks('grunt-contrib-copy')
    grunt.loadNpmTasks('grunt-image')

    grunt.registerTask('govuk_template', function () {
        var done = this.async()
          , child_process = require('child_process')
          , async = require('async')

          , runCommands = function (commands, callback) {
              async.series(commands.map(function (command) {
                  return function (callback) {
                      child_process.exec(command, function (error, stdout, stderr) {
                          if (error !== null) {
                              console.log('error executing command')
                              callback(true)
                          }
                          callback(null)
                      })
                  }
              }), callback)
            }

        runCommands([
            'test -d govuk_template || git clone https://github.com/alphagov/govuk_template.git',
            'git -C govuk_template fetch',
            'git -C govuk_template checkout origin/master',
            'cd govuk_template && bundle install --path=vendor/bundle',
            'rm -rf govuk_template/pkg/*',
            'cd govuk_template && bundle exec rake build:mustache',
            'rm -rf build/govuk_template',
            'cp -r govuk_template/pkg/mustache_govuk_template-*/ build/govuk_template',
        ], done)
    })

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
