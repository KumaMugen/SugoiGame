<?php 
	require "config.php";
	
	if(!Usuario::$logado){
		echo "Você precisa estar logado";
		return;
	}
	if(Usuario::$tripAtiva==0){
		echo "Você precisa estar logado";
		return;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Gerenciar Contatos</title> 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
<link type="text/css" href="CSS/chat.css" rel="stylesheet" charset="utf-8">
</head>
<body style="background: #fff;">
<div id="adicionar">
	<form method="POST" action="chatAdd.php">
	<div class="container">
		<div class="container_title">Adicione uma tripulação a sua lista:</div>
		<div class="container_body">
			<input type="text" name="nome" />
		</div>
		<div class="container_sub">
			<input type=submit value="Adicionar" class="invitebutton">
		</div>
	</div>
	</form>
</div>
<div id="remover">
	<form method="post" action="chatRemove.php">
	<div class="container">
		<div class="container_title">Remova uma tripulação da sua lista:</div>
		<div class="container_body">
			<input type="text" name="nome" />
		</div>
		<div class="container_sub">
			<input type=submit value="Remover" class="invitebutton">
		</div>
	</div>
	</form>
</div>
</body>
</html>