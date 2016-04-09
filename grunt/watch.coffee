###
jshint node:true
###
module.exports = {
  sass: {
    files: [
      'assets/scss/**/*.scss'
    ]
    tasks: [
      'sass:dev'
      'postcss'
    ]
  }
  coffee: {
    files: [
      'src/coffee/**/*.coffee'
    ]
    tasks: [
      'coffee'
    ]
  }
}
