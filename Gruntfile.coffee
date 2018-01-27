###
jshint node:true
###
module.exports = (grunt) ->
  require('load-grunt-config')(
    grunt
    {
      data: {
        dir: {
          assets: 'assets'
          archive_folder: 'v8ch-carousel-widget'
          bower: 'bower_components'
          css: 'assets/css'
          dist: 'dist'
          dist_filename: 'v8ch-carousel-widget-0_1_1.zip'
          fonts: 'assets/fonts'
          img: 'assets/images'
          js: 'assets/js'
          includes: 'includes'
          vendor: 'vendor'
          views: 'views'
        }
      }
    }
  )