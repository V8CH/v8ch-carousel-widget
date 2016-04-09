###
jshint node:true
###
module.exports = {
  dev: [
    'watch:sass'
    'watch:coffee'
  ]
  options: {
    limit: 8
    logConcurrentOutput: true
  }
}
