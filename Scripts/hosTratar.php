<?php
	if(!isset($_GET["ids"])) {
		$conteudo["erro"] = "Personagem inválido";
		return;
	}
	$ids = explode(";", $_GET["ids"]);
	unset($ids[sizeof($ids)-1]);
	
	try{
		$trips = Usuario::getTrip()->getTripulantes();
		$tratTime = 16;
		
		$edifico = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_edificio ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND edificio_id='2'"
		);
		
		if(sizeof($edifico) == 0){
			$conteudo["erro"] = "Essa ilha não possui um Hospital para tratar sua tripulacao.";
			return;
		}
		$tratTime -= ($edifico[0]["lvl"]);
		$tratTime *= 60;
		
		foreach ($trips as $key => $value) {
			if(in_array($value->id, $ids)){
				if(!$value->inTratamento() AND $value->hp != $value->getHPMax()){
					$porcent = ($value->getHPmax()-$value->hp)/$value->getHPMax();
					$t = $tratTime * $porcent;
					$t += atual_segundo();
					
					$bd->query(
						"INSERT INTO tb_hos_personagem ".
						"(tripulacao_id,personagem_id, finalizacao) ".
						"VALUES ('".Usuario::$tripAtiva."','".$value->id."','".$t."')"
					);
					
					$value->tratamento=$t;
				}
			}
		}
		
		$sessao = "hospitalTratamento";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}