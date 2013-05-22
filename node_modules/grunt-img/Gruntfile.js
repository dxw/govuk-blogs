module.exports = function(grunt) {
    "use strict";
    grunt.initConfig({
        img: {
            dir: {
                src: 'tests/img',
                dest: 'tests/optimg'
            }
        },
        watch: {
            files: '<config:lint.grunt>',
            tasks: 'lint:grunt'
        },
        jshint: {
            files: ['Gruntfile.js', 'tasks/*.js'],
            options: {
                es5: true,
                node: true,
                curly: false,
                eqeqeq: true,
                immed: true,
                latedef: false,
                newcap: true,
                noarg: true,
                sub: true,
                undef: true,
                boss: true,
                eqnull: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadTasks('tasks');

    grunt.registerTask('default', ['jshint','img']);
};
