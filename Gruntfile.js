module.exports = function(grunt) {

	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			colors: {
				options: {
					style: 'compact',
					lineNumbers: false,
				},
				files: [{
					'sunset/colors.css'   : 'sunset/colors.scss',
					'vineyard/colors.css' : 'vineyard/colors.scss',
					'primary/colors.css'  : 'primary/colors.scss',
					'mint/colors.css'     : 'mint/colors.scss',
					'evergreen/colors.css': 'evergreen/colors.scss'
				}]
			}
		},
		cssjanus: {
			colors: {
				expand: true,
				cwd: '.',
				dest: '.',
				ext: '-rtl.css',
				src: [
					'*/colors.css'
				]
			}
		},
		watch: {
			sass: {
				files: ['**/*.scss', ],
				tasks: ['sass:colors', 'cssjanus:colors']
			}
		}

	});

	// Default task(s).
	grunt.registerTask('default', ['sass','cssjanus']);

};
