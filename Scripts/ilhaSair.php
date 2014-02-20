<?php
	try{
		if(Usuario::getTrip()->getCapitao()->lvl < 2){
			$conteudo["mensagem"] = "Seu capitão precisa estar no nível 2 para que sua tripulação possa sair da ilha.";
			return;
		}
		
		$ilha = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha WHERE ilha_id='".Usuario::inIlha()."'"
		);
		
		$coordenada = $ilha[0]["zona_saida"]."_".$ilha[0]["coordenada_saida"];
		
		//cancela o tratamento de todo mundo no hospital
		$bd->query(
			"DELETE FROM tb_hos_personagem ".
			"WHERE tripulacao_id='".Usuario::$tripAtiva."' "
		);
		
		$bd->query(
			"UPDATE tb_usr_tripulacao ".
			"SET coordenada_atual='".$coordenada."' ".
			"WHERE tripulacao_id='".Usuario::$tripAtiva."'"
		);
		
		$coord = explode("_",$ilha[0]["coordenada_saida"]);
		
		Usuario::getTrip()->setCoord($coord[0],$coord[1],$ilha[0]["zona_saida"]);
		$sessao = "ilhaGeral";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}