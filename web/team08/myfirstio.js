var fs = require('fs')
var contents = fs.readFileSync(process.argv[2]);
var str = contents.toString()
var array = str.split('\n')
console.log(array.length - 1)