<?php
	try{
		$bd->query("UPDATE tb_usr_tripulacao SET is_logado='0' WHERE tripulacao_id='".Usuario::$tripAtiva."'");
		$bd->query("DELETE FROM tb_usr_conta_tripulacao WHERE conta_id='".Usuario::$id."'");
		
		setcookie("id_per", "", time()-10,'/');
	}
	catch(Exception $i){ $erro->insere("Erro ao deslogar \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	session_destroy();
	
	$conteudo["redirect"] = "game.php";