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
          'sunset/admin-colors.css'  : 'sunset/colors.scss',
          'midnight/admin-colors.css': 'midnight/colors.scss',
          'vineyard/admin-colors.css': 'vineyard/colors.scss',
          'primary/admin-colors.css' : 'primary/colors.scss'
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
