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
          dist: 'dist'
          dist_filename: 'v8ch-card-widget-0_1.zip'
          includes: 'includes'
          vendor: 'vendor'
          views: 'views'
        }
      }
    }
  )
