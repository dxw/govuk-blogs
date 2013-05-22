//
// == Getting started ==
//
// Install the grunt command-line tool (-g puts it in /usr/local/bin):
// % sudo npm install -g grunt-cli
//
// Install all the packages required to build this:
// (Packages will be installed in ./node_modules - don't accidentally commit this)
// % cd wp-content/themes/theme-name
// % npm install
//
// One-off build:
// % grunt
//
// Watch for changes:
// % grunt watch
//

module.exports = function(grunt) {

    grunt.initConfig({
        less: {
            dist: {
                options: {
                    yuicompress: true,
                },
                files: {
                    "assets/main.min.css": "assets/css/main.less"
                },
            },
        },
        uglify: {
            dist: {
                options: {
                    preserveComments: 'some',
                    compress: false,
                },
                files: {
                    'assets/main.min.js': [
                        'assets/js/plugins/*.js',
                        'assets/js/main.js',
                    ],
                },
            },
        },
        img: {
            dist: {
                src: 'assets/img',
            },
        },
        watch: {
            css: {
                files: ['assets/css/*.less'],
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
    grunt.loadNpmTasks('grunt-img')

    grunt.registerTask('default', [
        'less',
        'uglify',
        'img',
    ])

}
