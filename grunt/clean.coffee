###
jshint node:true
###
module.exports = {
  build: {
    files: [
      {
        dot: true
        src: [
          '<%= dir.css %>/*.css*'
          '<%= dir.fonts %>/*'
          '<%= dir.js %>/*.js'
        ]
      }
    ]
  }
  dist: {
    files: [
      {
        dot: true
        src: [
          '<%= dir.dist %>/**/*'
          '!<%= dir.dist %>/v8ch-carousel-widget.json'
        ]
      }
    ]
  }
}