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
				expand: true,
				cwd: '.',
				dest: '.',
				ext: '.css',
				src: [
					'*/colors.scss'
				]
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
				tasks: ['sass:colors']
			}
		}

	});

	// Default task(s).
	grunt.registerTask('default', ['sass','cssjanus']);

};
