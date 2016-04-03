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
        cwd: '<%= dir.includes %>'
        expand: true
        src: [ '**/*'
        ]
        dest: '<%= dir.archive_folder %>/<%= dir.includes %>'
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
