var serv = require('socket.io')({ transports: [
    'websocket'
  , 'flashsocket'
  , 'htmlfile'
  , 'xhr-polling'
  , 'jsonp-polling'] });
 serv.listen(8080);
serv.sockets.on('connection', function(client){ console.log("Connected oK!"); serv.sockets.emit('server',"data"); });
serv.sockets.on('message', function(mess){ serv.sockets.emit('server',"data"); });
//serv.on('message', function(data){ console.log("myLog"); });
