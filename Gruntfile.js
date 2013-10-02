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

          'midnight/admin-colors.css': ['midnight/colors.scss', '_admin.scss'],
          'midnight/customizer.css'  : ['midnight/colors.scss', '_customizer.scss'],

          'vineyard/admin-colors.css': ['vineyard/colors.scss', '_admin.scss'],
          'vineyard/customizer.css'  : ['vineyard/colors.scss', '_customizer.scss'],

          'primary/admin-colors.css': ['primary/colors.scss', '_admin.scss'],
          'primary/customizer.css'  : ['primary/colors.scss', '_customizer.scss'],
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
