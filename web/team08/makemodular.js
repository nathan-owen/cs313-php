var mymodule = require('./myModule.js')

var dir = process.argv[2]
var ext = process.argv[3]

mymodule(dir,ext,function(err,data) {
    if(err) {
        console.log("Error: " + err);
    } else {
        for(i = 0; i < data.length; i++) {
            console.log(data[i]);
        }
    }
});

