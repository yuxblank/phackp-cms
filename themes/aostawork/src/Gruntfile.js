module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files: {
					'../resources/css/aostawork.css' : 'sass/materialize.scss'
				}
			}
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['sass']
			}
		},
        clean: {
            build: {
                src: ['../resources/css', '../resources/js']
            },
            options: {
                force: true
            }
        },
        copy: {
            main: {
                expand: true,
                cwd: 'js',
                src: '**/*.js',
                dest: '../resources/js',
                flatten: false
/*                filter: 'isFile'*/
            }
        },
        uglify: {
            template: {
                files: [{
                    expand: true,
                    cwd: 'js',
                    src: '**/*.js',
                    dest: '../resources/js'
                }]
            }
        }
	});
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.registerTask('default',['watch']);
    grunt.registerTask('build',['clean','sass', 'uglify']);
    grunt.registerTask('build-dev',['clean','sass','copy']);
}