module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                stripBanners: true
            },
            css: {
                src: [
                    'web/assets/bootstrap/dist/css/bootstrap.min.css',
                    'web/assets/bootstrap/dist/css/bootstrap-theme.min.css',
                    'web/assets/prismjs/prism.css',
                    'web/assets/prismjs/plugins/line-numbers/prism-line-numbers.css',
                    'web/assets/prismjs/plugins/line-highlight/prism-line-highlight.css',
                    'web/assets/bd2/css/theme.css'
                ],
                dest: 'web/assets/bd2/css/bd2.css'
            },
            js: {
                src: [
                    'web/assets/jQuery/dist/jquery.min.js',
                    'web/assets/jquery/dist/jquery.min.js',
                    'web/assets/jquery.cookie/jquery.cookie.js',
                    'web/assets/blockui/jquery.blockUI.js',
                    'web/assets/bootstrap/dist/js/bootstrap.min.js',
                    'web/assets/prismjs/prism.js',
                    'web/assets/prismjs/components/prism-sql.min.js',
                    'web/assets/prismjs/plugins/line-numbers/prism-line-numbers.min.js',
                    'web/assets/bd2/js/theme.js',
                    'web/assets/bd2/js/ie10-viewport-bug-workaround.js'
                ],
                dest: 'web/assets/bd2/js/bd2.js'
            }
        },
        cssmin: {
            target: {
                files: {
                    'web/assets/bd2/css/bd2.min.css': ['web/assets/bd2/css/bd2.css']
                }
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
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['less', 'concat', 'cssmin', 'uglify']);
};
