###
jshint node:true
###
module.exports = {
  plugin: {
    options: {
      archive: '<%= dir.dist %>/<%= dir.dist_filename %>'
    }
    files: [
      {
        cwd: '<%= dir.assets %>/css'
        expand: true
        src: [ '**/*' ]
        dest: '<%= dir.archive_folder %>/<%= dir.assets %>/css'
      }
      {
        cwd: '<%= dir.assets %>/fonts'
        expand: true
        src: [ '**/*' ]
        dest: '<%= dir.archive_folder %>/<%= dir.assets %>/fonts'
      }
      {
        cwd: '<%= dir.assets %>/images'
        expand: true
        src: [ '**/*' ]
        dest: '<%= dir.archive_folder %>/<%= dir.assets %>/images'
      }
      {
        cwd: '<%= dir.includes %>'
        expand: true
        src: [ '**/*'
        ]
        dest: '<%= dir.archive_folder %>/<%= dir.includes %>'
      }
      {
        cwd: '<%= dir.js %>/'
        expand: true
        src: [ '**/*' ]
        dest: '<%= dir.archive_folder %>/<%= dir.js %>'
      }
      {
        cwd: '<%= dir.vendor %>/plugin-updates'
        expand: true
        src: [ '**/*'
        ]
        dest: '<%= dir.archive_folder %>/<%= dir.vendor %>/plugin-updates'
      }
      {
        cwd: '<%= dir.views %>/'
        expand: true
        src: [ '**/*.php' ]
        dest: '<%= dir.archive_folder %>/<%= dir.views %>'
      }
      {
        cwd: ''
        expand: true
        src: [
          'LICENSE'
          'readme.md'
          '*.php'
          'readme.txt'
        ]
        dest: '<%= dir.archive_folder %>'
      }
    ]
  }
}
