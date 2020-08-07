module.exports = function (grunt) {
  const sass = require('node-sass');

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      main: {
        options: {
          implementation: sass,
          outputStyle: 'compressed',
          sourceComments: false,
          sourceMap: false
        },
        files: {
          'sempress/style.css': 'sass/style.scss',
          'sempress/css/editor-style.css': 'sass/editor-style.scss'
        }
      }
    },
    replace: {
      style: {
        options: {
          variables: {
            'author': '<%= pkg.author.name %>',
            'author_url': '<%= pkg.author.url %>',
            'version': '<%= pkg.version %>',
            'license': '<%= pkg.license.name %>',
            'license_version': '<%= pkg.license.version %>',
            'license_url': '<%= pkg.license.url %>',
            'name': '<%= pkg.name %>',
            'description': '<%= pkg.description %>',
            'homepage': '<%= pkg.homepage %>',
            'keywords': '<%= pkg.keywords.join(", ") %>'
          },
          prefix: '@@'
        },
        files: [{
          expand: true,
          flatten: true,
          src: ['sempress/style.css'],
          dest: 'sempress'
        }]
      }
    },
    makepot: {
      target: {
        options: {
          cwd: 'sempress',
          domainPath: '/languages',
          exclude: ['bin/.*', '.git/.*', 'vendor/.*'],
          potFilename: 'sempress.pot',
          type: 'wp-theme',
          updateTimestamp: true
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-replace');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-wp-i18n');

  // Default task(s).
  grunt.registerTask('default', ['sass', 'replace']);
};
