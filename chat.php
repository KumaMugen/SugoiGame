<?php 
	require "config.php";
	if(!Usuario::$logado || Usuario::$tripAtiva==0){
		echo "Voce precisa estar logado";
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>One Piece Sugoi Game - CHAT</title>
	<link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<link rel="stylesheet" href="CSS/estrutura.css" type="text/css" />
<link rel="stylesheet" href="Chat/chat.css" type="text/css" />
<?php include "CSS/cores.php"; ?>
<style type="text/css">
	body{
		background: url("Imagens/<? echo $cor ?>/back.jpg");
	}
	#mensagens{
		background: url("Imagens/<? echo $cor ?>/back1.jpg");
		border: 1px solid <? echo $border; ?>;
	}
	#minha_msg{
		background: <? echo $bg; ?>;
		border: 1px solid <? echo $border; ?>;
	}
	#canal{
		background: <? echo $border2; ?>;
	}
</style>
<script type="text/javascript" src="JS/jquery.js"></script>
<?php include "Chat/chat.php"; ?>
<body>
<div id="trip-info"></div>
<div id="mensagens"></div>
<span id="mini_aberto" style="position: absolute; top: 0px; left: 0px;"></span>
<div id="enviar_msg">
	<form id="form-chat">
		<select name="canal" id="canal">
			<option value="g">Global</option>
		</select>
		<input type="text" name="msg" id="minha_msg" autocomplete="off" maxlength="150">
		<button type="submit" id="enviar">Enviar</button>
	</form>
</div>
</body>
</html>