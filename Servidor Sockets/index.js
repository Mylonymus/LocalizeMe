let app = require('express')();
let http = require('http').Server(app);
let io = require('socket.io')(http);
 

let api = 'http://www.position.es/API/';
io.on('connection', (socket) => {
  
  //console.log("Usuario conectado con IdSocket: "+socket.id);

  //console.log(io);
 

  socket.on('room', function(room) {
    var identificadorGrupo = 'Grupo'+room.id_grupo;
    io.name += identificadorGrupo; 
    if (socket.room) {
      socket.leave(socket.room);
      console.info(socket.nickname + ' ha salido de la sala ' + identificadorGrupo, room);  
      //Evento para las notificaciones
      socket.broadcast.to(socket.room).emit('exit-room', {nombreSala:room.nombre, usuario: socket.nickname})
    }else{
      socket.join(identificadorGrupo);
      socket.room = identificadorGrupo;
      //io.nsps['/'].rooms = io.nsps['/'].adapter.rooms;
      console.info(socket.nickname + ' se ha unido a la sala ' + identificadorGrupo, room);  
      //Evento para las notificaciones
      socket.broadcast.to(socket.room).emit('enter-room', {nombreSala:room.nombre, usuario: socket.nickname});
    }
    //socket.emit("join",room);
    
    
  });



  socket.on('disconnect', function(){
    //io.emit('users-changed', {user: socket.nickname, event: 'desconectado'});   
    console.log("Usuario desconectado con IdSocket: "+socket.id);
  });
 
  socket.on('set-nickname', (nickname) => {
    socket.nickname = nickname;
    //io.emit('users-changed', {user: nickname, event: 'conectado'});    
  });
  
  socket.on('add-message', (message) => {
    
    io.sockets.in(message.room).send({ text:message.text, room: message.room, from: message.from, created: new Date() });    

  });
});
 
var port = process.env.PORT || 3001;
 
http.listen(port, function(){
   console.log('listening in http://localhost:' + port);
});