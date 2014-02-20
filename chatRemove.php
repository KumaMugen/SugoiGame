<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Gerenciar Contatos</title> 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
<link type="text/css" href="CSS/chat.css" rel="stylesheet" charset="utf-8">
</head>
<body style="background: #fff;">
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
	
	$nome = $_POST["nome"];
	
	$trip = $bd->fazArray( "SELECT tripulacao_id FROM tb_usr_tripulacao WHERE nome=':0:'",array($nome),array(ALL_FORMAT) );
	
	if(sizeof($trip) == 0){
		echo "Tripulação não encontrada";
		return;
	}
	$inv = $trip[0]["tripulacao_id"];
	
	if($inv != Usuario::$tripAtiva){
		$rows = $bd->query( "SELECT * FROM tb_usr_amigos WHERE fromid='".Usuario::$tripAtiva."' AND toid='".$inv."'");
		if(mysql_num_rows($rows) == 0){
			echo "Essa tripulação não está em sua lista";
			return;
		}
		
		$bd->query(
			"DELETE FROM tb_usr_amigos ".
			"WHERE fromid='".Usuario::$tripAtiva."' AND toid='".$inv."'"
		);
	}
	
	echo "Tripulação Removida!";
?>
<br><br>
Aguarde alguns segundos até que as informações sejam atualizadas.
</body>
</html>
