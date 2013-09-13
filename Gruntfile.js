module.exports = function(grunt) {

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
          'sunset/admin-colors.css': ['sunset/colors.scss', '_admin.scss'],
          'sunset/customizer.css'  : ['sunset/colors.scss', '_customizer.scss'],

          'navy/admin-colors.css': ['navy/colors.scss', '_admin.scss'],
          'navy/customizer.css'  : ['navy/colors.scss', '_customizer.scss'],
        }]
      }
    },

    watch: {
      sass: {
        files: ['**/*.scss', ],
        tasks: ['sass:colors']
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['sass']);

};
