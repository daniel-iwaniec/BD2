module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                stripBanners: true
            },
            dist: {
                src: ['web/assets/bd2/js/theme.js', 'web/assets/bd2/js/ie10-viewport-bug-workaround.js'],
                dest: 'web/assets/bd2/js/bd2.js'
            }
        },
        uglify: {
            build: {
                src: 'web/assets/bd2/js/bd2.js',
                dest: 'web/assets/bd2/js/bd2.min.js'
            }
        },
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "web/assets/bd2/css/theme.css": "web/assets/bd2/css/theme.less"
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('default', ['less', 'concat', 'uglify']);
};
