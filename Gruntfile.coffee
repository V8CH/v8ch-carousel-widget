###
jshint node:true
###
module.exports = (grunt) ->

  path = require('path')
  require('time-grunt')(grunt)

  pkg = grunt.file.readJSON('package.json')
  parentPath = '../../themes/rice-paper' # Flags this project as a plugin related to a theme

  ###
  Values for Grunt template macros and project filesystem locations
  Shouldn't be necessary to change these on a standard build
  ###
  dir = {
    archive_folder: pkg.name
    assets: 'assets'
    bower: 'bower_components'
    css: 'assets/css'
    dist: 'dist'
    fonts: 'assets/fonts'
    functions: 'assets/functions'
    includes: 'includes'
    img: 'assets/images'
    js: 'assets/js'
    media: 'assets/media'
    parts: 'parts'
    pkg: pkg
    plugins: '../../plugins'
    scss: 'assets/scss'
    src: 'src'
    translation: 'assets/translation'
    vendor: 'vendor'
  }
  if parentPath?
    dir.parent = parentPath # copy task checks for null on this value, so add it here instead of declaring it

  ###
  *
  * Shared properties and filesets used by tasks
  *   Most of the config action happens here
  *
  ###

  ### First, compile imageAssets property using format of cwd: src ###
  imageAssets = {}
  imageAssets[dir.bower + '/slick-carousel/slick'] = ['ajax-loader.gif']

  ### Second, compile sassAssets property using format of output filename: src ###
  sassAssets = {
    'slick.css': dir.bower + '/slick-carousel/slick/slick.scss'
    'slick-theme.css': dir.scss + '/slick-theme.scss'
  }

  ### Third, compile BrowserSync files ###
  ### Note: First set is watched on every theme; shouldn't be necessary to change these on a standard build ###
  browserSyncFiles = [
    'assets/css/prism.css'
    'assets/css/site.css'
    'assets/functions/*.php'
    'assets/js/*.js'
    'parts/*.php'
    '*.php'
  ]
  ### Note: Parent files only watched on child themes; shouldn't be necessary to change these on a standard build ###
  if parentPath?
    browserSyncFiles.concat(
      [
        dir.parent + '/assets/css/*.css'
        dir.parent + '/assets/js/*.js'
        dir.parent + '/assets/functions/*.php'
        dir.parent + '/parts/*.php'
        dir.parent + '/*.php'
      ]
    )
  ### Note: Additions specific to this theme; add files as necessary here ###
  browserSyncFiles.concat(
    [
      # dir.parent + '/path/to/file'
    ]
  )

  ### Fourth, compile cssminFiles property using format of output filename: src ###
  cssminFiles = {}
  cssminFiles[dir.css + '/v8ch-rice-paper-carousel-widget.min.css'] = [
    dir.css + '/slick.css'
    dir.css + '/slick-theme.css'
  ]

  ### Fifth, compile docFiles property using format of post ID: markup doc path ###
  docFiles = {
    '118': 'doc/rice-paper-carousel-widget.md'
    '161': 'doc/using.md'
    '162': 'doc/carousel-slides.md'
    '163': 'doc/carousel-tags.md'
    '164': 'doc/widget-configuration.md'
    '165': 'doc/layout-templates.md'
  }

  ###
  * All required values setup now, so fire up Grunt
  ###
  grunt.initConfig(
    {
      cssminFiles: cssminFiles
      dir: dir
      distIncludes: [
        dir.css
        dir.fonts
        dir.includes
        dir.img
        dir.js
        dir.vendor
        dir.views
      ]
      docFiles: docFiles
      imageAssets: imageAssets
      sassAssets: sassAssets
    }
  )
  require('load-grunt-config')(
    grunt
    {
      configPath: path.join(process.cwd(), '../../themes/rice-paper/grunt') # Point to related theme Grunt tasks
      overridePath: path.join(process.cwd(), 'grunt') # Plugin overrides
      data: {
        dir: dir
      }
    }
  )