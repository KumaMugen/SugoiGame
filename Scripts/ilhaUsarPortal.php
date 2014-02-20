<?php
	try{
		if(!isset($_GET["coord"])){
			$conteudo["erro"] = "Faltam dados";
			return;
		}
		if(!preg_match(COORD_FORMAT,$_GET["coord"])){
			$conteudo["erro"] = "Dado inválido";
			return;
		}
		$coord = $_GET["coord"];
		
		$c = explode("_",$coord);
		$c = new Vetor($c[0],$c[1]);
		
		if($c->x < 0 OR $c->x > 19
		OR $c->y < 0 OR $c->y > 19){
			$conteudo["erro"] = "Coordenadas invalidas";
			return;
		}
		
		$userCoord = Usuario::getTrip()->coord["coord"];
		
		if(abs($userCoord->x - $c->x)>2 OR abs($userCoord->y - $c->y)>2){
			$conteudo["erro"] = "Coordenadas invalidas";
			return;
		}
		
		
		$portais = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_portal ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."' ".
			"AND coordenada=':0:'",
			array($coord),
			array(COORD_FORMAT)
		);
		
		$ncoord = explode("_",$portais[0]["coordenada_destino"]);
		
		if($portais[0]["zona_destino"]==0)$ncoord[0] = "interno";
		
		Usuario::getTrip()->setCoord($ncoord[0],$ncoord[1],$portais[0]["zona_destino"]);
		
		Usuario::getTrip()->updateCoord(TRUE,TRUE);
		$sessao = "ilhaGeral";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}