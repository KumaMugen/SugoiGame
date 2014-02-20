<?php
	try{
		$precoNavio = 10000;
		if(Usuario::getTrip()->berries<$precoNavio){
			$conteudo["erro"] = "Você não possui Berries suficientes";
			return;
		}
		
		if(Usuario::getTrip()->getNavio()){
			$conteudo["erro"] = "Você já possui um navio";
			return;
		}
		$bd->query(
			"INSERT INTO tb_usr_navio ".
			"(tripulacao_id,skin) ".
			"VALUES ('".Usuario::$tripAtiva."','".Usuario::$faccao."')"
		);
		Usuario::getTrip()->subBerries($precoNavio);
		$conteudo["realizacao"] = "Você comprou um navio!";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$sessao="navio";
	
	$_GET["tripulantes"] = "";