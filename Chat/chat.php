<script src="http://localhost:<?php echo PORTA_CHAT; ?>/socket.io/socket.io.js"></script>
<script type="text/javascript">
	var socket = io.connect('http://localhost:<?php echo PORTA_CHAT; ?>');
	socket.on('error', function () {
		$("#mensagens").append(
			$("<DIV>")
				.addClass("system-msg")
				.append("Impossível conectar ao servidor de chat.")
		);
	});
	socket.on("connect",function(){
		$("#mensagens").append(
			$("<DIV>")
				.addClass("system-msg")
				.append("Conectado ao canal Global!")
		);
	});
	socket.on('message', function (ev) {
		$("#mensagens").append(
			$("<DIV>")
				.addClass("horario")
				.append("["+ev.horario+"]")
		).append(
			$("<DIV>")
				.addClass("user-nome")
				.append(ev.trip.nome)
				.data("bandeira",ev.trip.bandeira)
				.data("reputacao",ev.trip.reputacao)
				.data("tripId",ev.trip.id)
		).append(
			$("<DIV>")
				.addClass("user-message")
				.append(ev.texto)
		);
		var objDiv = document.getElementById("mensagens");
		objDiv.scrollTop = objDiv.scrollHeight;
	});
	$(document).ready(function(){
		$('#form-chat').on("submit",function(e){ //use clicks message send button
			e.preventDefault();
			var mymessage = $('#minha_msg').val(); //get message text
			
			if(mymessage == ""){ //emtpy message?
				return;
			}
			$('#minha_msg').val("");
			
			//prepare json data
			var msg = {
				message: mymessage
			};
			//convert and send data to server
			socket.emit('send-message', msg);
		});
		$(".user-nome").live("click",function(){
			var bandeira = $(this).data("bandeira");
			var nome = $(this).html();
			var reputacao = $(this).data("reputacao");
			var tripId = $(this).data("tripId");
			$("#trip-info")
				.html("")
				.fadeIn(10)
				.append(
					$("<DIV>")
						.addClass("trip-info-bandeira")
						.append(
							$("<IMG>").attr("src","Imagens/Bandeiras/"+bandeira+".jpg")
						)
				).append(
					$("<DIV>")
						.addClass("trip-info-nome")
						.append(nome)
				).append(
					$("<DIV>")
						.addClass("trip-info-rep")
						.append($("<SPAN>").addClass("label").html("Reputação:"))
						.append(reputacao)
				);
		});
		$("#trip-info").on("click",function(){
			$(this).fadeOut(10);
		});
	});
</script>