###
jshint node:true
###
module.exports = {
  site: {
    expand: true
    flatten: false
    bare: true
    cwd: 'src/coffee'
    src: [ '*.coffee' ]
    dest: 'assets/js'
    ext: '.js'
    options: { bare: true }
  }
}