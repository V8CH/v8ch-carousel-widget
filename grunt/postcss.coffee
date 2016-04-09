module.exports = {
  options: {
    map: {
      inline: false
    }
    processors: [
      require('pixrem')
      require('autoprefixer')(
        {
          browsers: [
            # 'Chrome >= 40'
            "Android 2.3",
            "Android >= 4",
            "Chrome >= 20",
            "Firefox >= 24",
            "Explorer >= 8",
            "iOS >= 6",
            "Opera >= 12",
            "Safari >= 6"
          ]
        })
    ]
  }
  'style': {
    src: '<%= dir.css %>/slick-theme.css'
  }
}
