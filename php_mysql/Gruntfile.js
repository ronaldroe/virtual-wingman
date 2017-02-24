module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist:{
        options: {
          style: 'expanded',
          compass: true
        },
        files: {
          'css/style.css': 'css/style.scss'
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions']
      },
      no_dest: {
        src: 'css/style.css'
      }
    },
    watch: {
      sass: {
        files: ['css/style.scss'],
        tasks: ['sass', 'autoprefixer'],
      },
      src: {
        files: ['css/*.css', 'scripts/*.js'],
        options: {
          livereload: true,
        }
      }
    },

  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');

  // Default task(s).
  grunt.registerTask('default', ['sass', 'autoprefixer', 'watch']);

};
