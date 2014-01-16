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
