//
// == Installation ==
//
// Install all the packages required to build this:
// (Packages will be installed in ./node_modules - don't accidentally commit this)
// % yarn install
//
// == Building ==
//
// % yarn run grunt
//
// Watch for changes:
// % yarn run grunt watch
//
// Compress images (not done by the above tasks):
// % yarn run grunt img
//

module.exports = function (grunt) {
    'use strict';

    const sass = require('sass')

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        clean: ['build'],

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

		fingerprint: {
			production: {
			  options: {
				json: 'build/fingerprint.json',
			  },
			  src: [
				'build/*.min.css',
				'build/main.min.js'
				],
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
                        'node_modules/es6-promise/dist/es6-promise.auto.js',
                        'node_modules/govuk-frontend/dist/govuk/all.js',
                        'assets/js/main.js',
                        'assets/js/comments.js',
						'assets/js/buttons.js',
						'assets/js/accordion.js'
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
                            'node_modules/govuk-frontend/dist/govuk/assets/fonts/*',
                            'node_modules/govuk-frontend/dist/govuk/assets/rebrand/images/*',
							'node_modules/govuk-frontend/dist/govuk/assets/rebrand/manifest.json',
							'node_modules/govuk-frontend/dist/govuk/govuk-frontend.min.js'
                        ],
                        dest: 'build/',
                    },
					{
						expand: true,
						cwd: 'assets/js/',
						flatten: true,
						src: 'govuk-frontend-load.js',
						dest: 'build/'
					}
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
			files: ['assets/css/**/*.scss', 'assets/js/**/*.js'],
			tasks: ['clean', 'copy', 'sass', 'uglify', 'fingerprint' ],
        },
    })

    grunt.loadNpmTasks('grunt-sass')
    grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.loadNpmTasks('grunt-contrib-copy')
    grunt.loadNpmTasks('grunt-image')
	grunt.loadNpmTasks('@dxw-digital/grunt-fingerprint')
    grunt.loadNpmTasks('grunt-contrib-clean')

    grunt.renameTask('watch', '_watch')
    grunt.registerTask('watch', [
        'default',
        '_watch',
    ])

    grunt.registerTask('default', [
        'clean',
        'copy',
        'sass',
        'uglify',
		'fingerprint'
    ])

}
