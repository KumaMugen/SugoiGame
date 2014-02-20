<?php
	setcookie("id", "", time()-10,'/');
	setcookie("sh", "", time()-10,'/');
	setcookie("id_per", "", time()-10,'/');
	try{
		$bd->query("DELETE FROM tb_usr_conta_cookie WHERE conta_id='".Usuario::$id."'");
	
		$trip = $bd->fazArray("SELECT * FROM tb_usr_conta_tripulacao WHERE conta_id='".Usuario::$id."'");
		if(sizeof($trip)!=0){
			$bd->query("UPDATE tb_usr_tripulacao SET is_logado='0' WHERE tripulacao_id='".$trip[0]["tripulacao_id"]."'");
			$bd->query("DELETE FROM tb_usr_conta_tripulacao WHERE conta_id='".Usuario::$id."'");
		}
	}
	catch(Exception $i){ $erro->insere("Erro ao deslogar \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	session_destroy();
	
	$conteudo["redirect"] = "index.php";