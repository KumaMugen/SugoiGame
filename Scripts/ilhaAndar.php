<?php
	try{
		if(!isset($_GET["x"]) OR !isset($_GET["y"])){
			$conteudo["erro"] = "Faltam dados";
			return;
		}
		
		$x = (Int)$_GET["x"];
		$y = (Int)$_GET["y"];
		
		if(abs($x)>2 OR abs($y)>2){
			$conteudo["erro"] = "Coordenadas invalidas";
			return;
		}
		
		$n = new Vetor($x,$y);
		
		$ncoord = Usuario::getTrip()->coord["coord"];
		
		if(Usuario::getTrip()->coord=="interno"){
			$conteudo["erro"] = getMsgErroInIlha();
			return;
		}
		
		$ncoord->somarVetor($n);
		
		if($ncoord->x < 0 OR $ncoord->x > 19
		OR $ncoord->y < 0 OR $ncoord->y > 19){
			$conteudo["erro"] = "Coordenadas invalidas";
			return;
		}
		$zona = Usuario::getTrip()->coord["zona"];
		Usuario::getTrip()->setCoord($ncoord->x ,$ncoord->y ,$zona);
		
		$iniciaCombate = FALSE;
		
		//verifica se o jogador foi atacado
		$mob = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_mob ".
			"WHERE ilha_id='".Usuario::inIlha()."' ".
			"AND zona='$zona' AND coordenada='".$ncoord->toString()."'"
		);
		if(sizeof($mob)!=0){
			if(rand(1,100) <= $mob[0]["chance"]){
				$iniciaCombate = TRUE;
				
				//iniciaCombatePvE
				Usuario::getTrip()->iniciaCombatePvE($mob[0]["mob_id"],$mob[0]["background"]);
			}
		}
		
		Usuario::getTrip()->updateCoord(TRUE,!$iniciaCombate);
		
		if($iniciaCombate){
			$conteudo["retorno"] = "iniciarCombate";
		}
		else
			include "Scripts/ilhaExternoVisualizar.php";
		
		$exibeInfoGeral[0] = 1;
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
