<?php
	try{
		if(!isset($_GET["coord"])){
			$conteudo["erro"] = getErroFormularioIncompleto();
			return;
		}
		if(!preg_match(COORD_FORMAT,$_GET["coord"])){
			$conteudo["erro"] = getErroInformacaoInvalida("Coord");
			return;
		}
		$coord = $_GET["coord"];
		$jogadores = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_tripulacao ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."' ".
			"AND coordenada=':0:'",
			array($coord),
			array(COORD_FORMAT)
		);
		$list = array();
		$pvp = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_pvp ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."'"
		);
		if(sizeof($pvp)>0){
			$pvp = array(
				"disponivel" => TRUE
			);
		}
		foreach ($jogadores as $key => $value) {
			$trip = new TripulacaoAlheia($value["tripulacao_id"]);
			
			$p = $pvp;
			if($trip->conta == Usuario::$id){
				$p = array();
			}
			else{
				if($trip->faccao != Usuario::$faccao OR $trip->faccao==1)
					$p["atacar"] = TRUE;
			}
			
			$list[$key] = getInfoJogadorInMapa($trip,$p);
		}
		
		$conteudo["retorno"] = $list;
		
		$exibeInfoGeral[0] = 0;
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
