var http = require('http');
var clients = new Array();
var app = http.createServer(function(req, res) {
    res.writeHead(200, {
        'Content-Type': 'text/html'
    });
});
var io = require('socket.io').listen(app);
var namedPairs = {};
io.on('connection', function(socket) {
    console.log("New client connected, sending welcome packet");
    //User connected,lets test the waters.
    socket.emit('welcome', {
        message: 'Welcome!',
        id: socket.id
    });
    //Client sent data back, and we got it. Let's see if our data matches theirs.
    socket.on("__INIT", function(rep) {
        console.log("Got client handshake packet, sending data back!");
        socket.emit("__SERVINIT", {
            head: "I got your reply, this is what you sent: ",
            UUID: rep.message
        });
        //Data matches,client wants to finish, and they send the username
        socket.on("__COMPLETE", function(data) {
            console.log("Handshake done, adding user to array");
            var result = namedPairs[data.USERNAME] === undefined;
            if (result) {
                namedPairs[data.USERNAME] = [];
            }
            namedPairs[data.USERNAME].push(socket.id);
            console.log("All done, sending final packet");
            //Let them know we are done setting up
            socket.emit("__DONE", {
                IDS: namedPairs[data.USERNAME]
            });
        });
    });
    //The client disconnected, we need to remove from array
    socket.on("disconnect", function() {
        console.log("Socket disconnected, removing from array");
        for (var oBJ in namedPairs) {
            if (namedPairs[oBJ].indexOf(socket.id) > -1) {
                var index = namedPairs[oBJ].indexOf(socket.id);
                namedPairs[oBJ].splice(index, 1);
            }
        }
    });
    //If they need to broadcast
    socket.on("broadcast", function(ret) {
        var data = JSON.parse(ret);
        //Is it only to certain user or is it global?
        if (data.scope == "ALL") {
            for (var username in namedPairs) {
                for (var sockID in namedPairs[username]) {
                    io.to(namedPairs[username][sockID]).emit(data.key, data.value);
                }
            }
        } else {
            if (!namedPairs[data.scope]) {
				console.log(data.statusCases);
                switch(data.statusCases){
					case "USEROFFLINE":
					var tmp = JSON.parse(data.statusCases["USEROFFLINE"]);
					console.log(tmp);
					if(tmp.action == "NOP"){
					console.log("NOP pointer got. Exiting.");
					break
					}
					default: break;
				}
            } else {
                for (var sockID in namedPairs[data.scope]) {
                    console.log("EMITTING!!");
                    io.to(namedPairs[data.scope][sockID]).emit(data.key, data.value);
                }
            }
        }
    });
});
app.listen(3000);
console.log("Listening on *:3000");