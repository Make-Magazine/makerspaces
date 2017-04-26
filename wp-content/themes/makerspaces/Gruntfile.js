module.exports = function(grunt) {
  var watchFiles = [
    'includes/less/*.less',
    'includes/js/*.js',
    'includes/js/angular/global-faires-map-app/*.js'
  ];
  var lessSrcFiles = {
    'includes/css/style.css': 'includes/less/style.less',
  };
  // All configurations go here
  grunt.initConfig({

    // Reads the package.json file
    pkg: grunt.file.readJSON('package.json'),

    // Each Grunt plugins configurations will go here
    less: {
      prod: {
        options: {
          compress: true
        },
        files: lessSrcFiles
      },
      dev: {
        options: {
          compress: false,
          dumpLineNumbers: 'comments'
        },
        files: lessSrcFiles
      }
    },
    // Concat js files
    concat: {
      options: {
        banner: '// Compiled file - any changes will be overwritten by grunt task\n',
        separator: ';',
        process: function(src, filepath) {
          return '//!!\n//!! ' + filepath + '\n' + src;
        }
      },
      dist: {
        files: {
          'includes/js/min/scripts.js': ['includes/js/*.js'],
          'includes/js/angular/global-faires-map-app.js': [
            'includes/js/angular/global-faires-map-app/faireMapsApp.js',
            'includes/js/angular/global-faires-map-app/*.js'
          ],
        }
      },
    },
    // uglify js
    uglify: {
      js: {
        options: {
          mangle: false,
          banner: '// Compiled file - any changes will be overwritten by grunt task\n',
        },
        files: {
          'includes/js/min/scripts.min.js': 'includes/js/min/scripts.js',
        }
      }
    },
    watch: {
      prod: {
        files: watchFiles,
        tasks: ['less:prod', 'concat', 'uglify']
      },
      dev: {
        files: watchFiles,
        tasks: ['less:dev', 'concat']
      },
      reload: {
        files: watchFiles,
        tasks: ['less'],
        options: {
          livereload: true
        }
      }
    }
  });

  // Simplify the repetivite work of listing each plugin in grunt.loadNpmTasks(), just get the list from package.json and load them...
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Register the tasks with Grunt
  // To only watch for less changes and process without browser reload type in "grunt"
  grunt.registerTask('default', ['less:prod', 'concat', 'uglify', 'watch:prod']);
  // Dev mode build task
  grunt.registerTask('dev', ['less:dev', 'concat', 'watch:dev']);
  // To watch for less changes and process them with livereload type in "grunt reload"
  grunt.registerTask('reload', ['less', 'watch:reload']);

};
