###
jshint node:true
###
module.exports = {
  build: {
    files: [
      {
        cwd: '<%= dir.bower %>/slick-carousel/slick'
        expand: true
        src: [
          'slick.css'
        ]
        dest: '<%= dir.css %>'
      }
      {
        cwd: '<%= dir.bower %>/slick-carousel/slick/fonts'
        expand: true
        src: [
          '**/*'
        ]
        dest: '<%= dir.fonts %>'
      }
      {
        cwd: '<%= dir.bower %>/slick-carousel/slick'
        expand: true
        src: [
          'slick.js'
        ]
        dest: '<%= dir.js %>'
      }
      {
        cwd: '<%= dir.bower %>/slick-carousel/slick'
        expand: true
        src: [
          'ajax-loader.gif'
        ]
        dest: '<%= dir.img %>'
      }
    ]
  }
}
