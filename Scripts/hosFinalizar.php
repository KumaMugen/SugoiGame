<?php
	if(!isset($_GET["ids"])) {
		$conteudo["erro"] = "Personagem inválido";
		return;
	}
	$ids = explode(";", $_GET["ids"]);
	unset($ids[sizeof($ids)-1]);
	
	try{
		$trips = Usuario::getTrip()->getTripulantes();
		
		foreach ($trips as $key => $value) {
			if(in_array($value->id, $ids)){
				if($value->inTratamento() AND ($value->inTratamento()-atual_segundo()<=0)){
					$bd->query(
						"DELETE FROM tb_hos_personagem ".
						"WHERE personagem_id='".$value->id."' "
					);
					$bd->query(
						"UPDATE tb_per_personagem ".
						"SET hp='".$value->getHPMax()."' ".
						"WHERE personagem_id='".$value->id."' "
					);
					
					$value->tratamento=FALSE;
					$value->hp = $value->getHPMax();
				}
			}
		}
		
		$_GET["tripulantes"] = "";
		$sessao = "hospitalTratamento";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}