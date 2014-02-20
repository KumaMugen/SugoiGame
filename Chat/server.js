var io = require('socket.io').listen(888);
var mysql = require('mysql');
var async = require('async');
var cookie = require('cookie');

var emailFormat = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
var stringFormat = new RegExp(/^[\w]+$/);
var intFormat = new RegExp(/^[\d]+$/);

var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '0474342',
  database : 'sugoigame2'
});
connection.connect();
var usuarios = {};

//processo de autenticação do usuario
io.configure(function (){
	io.set('authorization', function (handshakeData, accept) {
		var id, ck, trip;
		if (handshakeData.headers.cookie) {
			//obtem os cookies
			cookies = cookie.parse(handshakeData.headers.cookie);
			id = cookies.id;
			ck = cookies.sh;
			
			//verificacao de formato
			if(!intFormat.test(id) || id.length>10) return accept('Id invalida.', false);
			if(!stringFormat.test(ck) || ck.length>32) return accept('Chave invalida.', false);
			
			//pesquisa dados de usuario
			console.log("\tTentativa de acesso: "+id+" - "+ck);
			connection.query("SELECT * FROM tb_usr_conta_cookie WHERE conta_id = ?",id,
			function(err, rows, fields) {
				if (err) return accept(err, false);
				if(rows.length == 0) return accept('Id nao encontrada.', false);
				
				//autentica
				if(ck != rows[0].cookie_id) return accept('Chave invalida.', false);
				console.log("\tChave "+ck+" aprovada!");
				
				//verifica tripulacao selecionada
				connection.query("SELECT * FROM tb_usr_conta_tripulacao WHERE conta_id = ?",id,
				function(err, rows, fields) {
					if (err) return accept(err, false);
					if(rows.length == 0) return accept('tripulacao nao selecionada.', false);
					
					trip = rows[0].tripulacao_id;
					console.log("\tTripulacao "+trip+" selecionada!");
					
					//pega informações da tripulação
					connection.query("SELECT * FROM tb_usr_tripulacao WHERE tripulacao_id = ?",trip,
					function(err, rows, fields) {
						if (err) return accept(err, false);
						if(rows.length == 0) return accept('tripulacao nao encontrada.', false);
						
						console.log("\t"+rows[0].nome+" conectado!");
						handshakeData.tripulacao = rows[0];
					});
				});
			});
		} else {
			return accept('No cookie transmitted.', false);
		} 
		accept(null, true);
	});
});

io.on('connection', function (client) {
	client.on('send-message',function(msg){
		var data = new Date();
		var tempo = formataTempo(data.getHours()) + ":" + formataTempo(data.getMinutes());
		io.sockets.emit('message',{
			trip: {
				nome: client.handshake.tripulacao.nome,
				reputacao: client.handshake.tripulacao.reputacao,
				bandeira: client.handshake.tripulacao.bandeira,
				id: client.handshake.tripulacao.tripulacao_id,
			},
			horario: tempo,
			texto: htmlspecialchars(msg.message)
		});
	});
});


function htmlspecialchars(str) {
	if (typeof(str) == "string") {
		str = str.replace(/&/g, "&amp;"); /* must do &amp; first */
		str = str.replace(/"/g, "&quot;");
		str = str.replace(/'/g, "&#039;");
		str = str.replace(/</g, "&lt;");
		str = str.replace(/>/g, "&gt;");
	}
	return str;
}
function formataTempo(i){
	if (i<10){
		i="0" + i;
	}
	return i;
}
//onnection.end();
