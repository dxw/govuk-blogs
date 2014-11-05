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
        less: {
            dist: {
                options: {
                    compress: true,
                    sourceMap: true,
                    sourceMapFilename: 'build/main.min.css.map',
                    sourceMapURL: 'main.min.css.map',
                    sourceMapRootpath: '../',
                },
                files: {
                    'build/main.min.css': 'assets/css/main.less',
                    'build/admin.min.css': 'assets/css/admin.less',
                },
            },
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
                        'bower_components/jquery-placeholder/jquery.placeholder.js',
                        'bower_components/bowser/bowser.js',
                        'bower_components/lte-ie/lte-ie.js',
                        'assets/js/main.js',
                    ],
                },
            },
        },

        copy: {
            dist: {
                files: [
                    {
                        src: [
                            'bower_components/bsie/bootstrap/css/bootstrap-ie6.min.css',
                            'bower_components/bootstrap/img/glyphicons-halflings.png',
                            'bower_components/bootstrap/img/glyphicons-halflings-white.png',
                        ],
                        dest: 'build/',
                    },
                ],
            },
        },

        img: {
            dist: {
                src: 'assets/img',
            },
        },

        _watch: {
            css: {
                files: ['assets/css/**/*.less'],
                tasks: ['less'],
            },
            js: {
                files: ['assets/js/**/*.js'],
                tasks: ['uglify'],
            },
        },
    })

    grunt.loadNpmTasks('grunt-contrib-less')
    grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.loadNpmTasks('grunt-contrib-copy')
    grunt.loadNpmTasks('grunt-img')

    grunt.registerTask('bower-install', 'Installs bower deps', function () {
        var done = this.async()
          , bower = require('bower')

        bower.commands.install().on('end', function () {
            done()
        })
    })

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
        'bower-install',
        'copy',
        'less',
        'uglify',
    ])

}
