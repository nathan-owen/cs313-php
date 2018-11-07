var http = require('http');

var url = process.argv[2];

http.get(url, function callback(response) {
    response.on("data",function (data) {
        console.log(data.toString());
    })
    response.on('error', console.error)
}).on('error',console.error);