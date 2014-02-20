<?php
	try{
		$coleta = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_coleta ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."'"
		);
		$portais = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_portal ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."'"
		);
		$jogadores = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_tripulacao ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."'"
		);
		$itens = array();
		foreach ($coleta as $key => $value) {
			if(atual_segundo() >= $value["ultimo_respawn"]+$value["tempo_respawn"]*60)
				$itens[] = $value;
		}
		$list=array(
			"itens" => $itens,
			"portais" => $portais,
			"jogadores" => $jogadores,
			"eu" => array(
				"coord" => Usuario::getTrip()->coord["coord"]->toString(),
				"icon" => Usuario::getBandeira()
			)
		);
		
		$conteudo["retorno"] = $list;
		
		$exibeInfoGeral[0] = 1;
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
