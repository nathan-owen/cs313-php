var fs = require('fs')
var path = require('path')

let items = [];

module.exports = function (dirName, extension, callback) {
    ext = "." + extension;

    fs.readdir(dirName, function(err, list){
        if(err)
            callback(err,null);
        else {
            list.forEach(file => {
                if(path.extname(file) === ext )
                {
                    items.push(file);
                }
            });
            callback(null,items);
        }
         
    });
}
