<?php
	if(!isset($_GET["tipo"]) OR !isset($_GET["alvo"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_GET["tipo"]) OR !preg_match(INT_FORMAT, $_GET["alvo"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("tipo ou alvo");
		return;
	}
	
	$tipo = $_GET["tipo"];
	$alvo = $_GET["alvo"];
	
	if($tipo < 1 OR $tipo > 6 OR $tipo == 4){
		$conteudo["erro"] ="tipo de combate inválido";
		return;
	}
	try{
		$trip = new TripulacaoAlheia($alvo);
		if($tipo==3){
			
		}
		else{
			$mc = Usuario::getTrip()->coord;
			$ac = $trip->coord;
			if($ac === "interno"){
				$conteudo["erro"] ="Jogaddor inválido";
				return;
			}
			else if(Usuario::inIlha()){
				if($mc["zona"] != $ac["zona"] 
				OR abs($mc["coord"]->x - $ac["coord"]->x) > 2 
				OR abs($mc["coord"]->y - $ac["coord"]->y) > 2){
					$conteudo["erro"] ="Jogaddor inválido";
					return;
				}
			}
			else{
				if(abs($mc->x - $ac->x) > 1 
				OR abs($mc->y - $ac->y) > 1){
					$conteudo["erro"] ="Jogaddor inválido";
					return;
				}
			}
			if(Usuario::inIlha()){
				$bg = $bd->fazArray(
					"SELECT * FROM tb_mun_ilha_zona_pvp ".
					"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".$mc["zona"]."'"
				);
				if(sizeof($bg)==0){
					$conteudo["erro"] ="Área inválida";
					return;
				}
				$bg = $bg[0]["background"];
			}
			else{
				$bg=0;
			}
			
			Usuario::getTrip()->iniciaCombatePvP($trip,$tipo,$bg);
			Usuario::getTrip()->updateCoord(Usuario::inIlha(),FALSE);
			$trip->updateCoord(Usuario::inIlha(),FALSE);
		}
		
		$conteudo["combate"]=TRUE;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$exibeInfoGeral[0] = 0;