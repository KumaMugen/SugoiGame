<?php
	try{
		$combateId = Usuario::inCombate();
		if(!$combateId){
			$sessao="hospital";
			$_GET["tripulantes"] = "";
			return;
		}
		$combate = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate ".
			"WHERE combate_id='".$combateId["combate_id"]."'"
		);
		$combate = $combate[0];
		
		$status = "C";
		$p = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE combate_id='".$combate["combate_id"]."'"
		);
		$hp[0] = 0;
		$hp[1] = 0;
		$pers[0] = array();
		$pers[1] = array();
		foreach ($p as $key => $value) {
			$hp[$value["equipe"]] += $value["hp"];
			
			$pers[$value["equipe"]][] = $value;
		}
		$equipeOponente = ($combateId["equipe"]==1)?0:1.;
		
		if($hp[$combateId["equipe"]]<=0){
			$status = "P";
		}
		else if($combate["tipo"]==0){
			$mob = $bd->fazArray(
				"SELECT * FROM tb_cbt_combate_mob ".
				"WHERE combate_id='".$combate["combate_id"]."'"
			);
			$mob = $mob[0];
			
			$mobInfo = $bd->fazArray(
				"SELECT * FROM tb_pve_mob ".
				"WHERE mob_id='".$mob["mob_id"]."'"
			);
			$mobInfo = $mobInfo[0];
			
			if($mob["hp"]<=0){
				$status = "V";
			}
			
			$rItens = $bd->fazArray(
				"SELECT * FROM tb_pve_mob_drop_item ".
				"WHERE mob_id='".$mob["mob_id"]."'"
			);
			
			$rEquips = $bd->fazArray(
				"SELECT * FROM tb_pve_mob_drop_equipamento ".
				"WHERE mob_id='".$mob["mob_id"]."'"
			);
			
			$tipo = "PvE";
			
			if(file_exists("Logs/Combates/".$tipo."/".$combateId["combate_id"].".log")){
				unlink("Logs/Combates/".$tipo."/".$combateId["combate_id"].".log");
			}
		}
		else if($hp[$equipeOponente]<=0){
			$status = "V";
			$tipo = "PvP";
			
			$oponente = $bd->fazArray(
				"SELECT * FROM tb_cbt_combate_tripulacao ".
				"WHERE combate_id='".$combateId["combate_id"]."' AND equipe='".$equipeOponente."'"
			);
		}
		
		if($status=="C"){
			$conteudo["erro"] = "Essa batalha ainda não acabou";
			return;
		}
		else{
			$bd->query(
				"DELETE FROM tb_cbt_combate ".
				"WHERE combate_id='".$combate["combate_id"]."'"
			);
		}
		if($status=="V"){
			if($combate["tipo"]==0){
				$rxp = $mobInfo["recompensa_xp"]/1000*getXPByNivel($mobInfo["lvl"])*RATE_XP;;
			}
			else{
				$rxp=0;
				$rItens=array();
				$rEquips=array();
			}
			
			//personagens em caso de vitoria
			foreach ($pers[$combateId["equipe"]] as $key => $value) {
				$bd->query(
					"UPDATE tb_per_personagem ".
					"SET xp=xp+:0:, hp=':1:', mp=':2:' ".
					"WHERE personagem_id=':3:'",
					array(
						$rxp,
						$value["hp"],
						$value["mp"],
						$value["personagem_id"]
					),
					array(
						INT_FORMAT,
						INT_FORMAT,
						INT_FORMAT,
						INT_FORMAT
					));
			}
			
			if($combateId["berries"]!=0){
				Usuario::getTrip()->addBerries($combateId["berries"]);
			}
			
			$espaco = Usuario::getTrip()->getCarga();
			foreach ($rItens as $key => $value) {
				if($espaco < Usuario::getTrip()->getCapCarga()){
					if(rand(1,100)<=$value["chance"]){
						Usuario::getTrip()->addItem($value["item_id"],$value["quant"]);
						$espaco++;
					}
				}
			}
			foreach ($rEquips as $key => $value) {
				if($espaco < Usuario::getTrip()->getCapCarga()){
					if(rand(1,100)<=$value["chance"]){
						Usuario::getTrip()->$rEquips($value["equipamento_id"]);
						$espaco++;
					}
				}
			}
			
			//atualiza status de missao
			if(Usuario::inMissao() && $tipo==="PvE"){
				$mis = Usuario::$missaoList;
				if($mis[0]["tipo"]==1 AND $mis[0]["objetivo_id"]==$mob["mob_id"]){
					$quant = $mis[0]["objetivo_quant"]+1;
					
					$bd->query(
						"UPDATE tb_mis_missao_andamento SET objetivo_quant='$quant' ".
						"WHERE tripulacao_id='".Usuario::getTrip()->trip."'"
					);
				}
			}
			if($tipo=="PvP"){
				foreach ($pers[$equipeOponente] as $key => $value) {
					$bd->query(
						"UPDATE tb_per_personagem ".
						"SET hp='0', mp=':0:' ".
						"WHERE personagem_id=':1:'",
						array(
							$value["mp"],
							$value["personagem_id"]
						),
						array(
							INT_FORMAT,
							INT_FORMAT
						));
				}
				$oponenteInfo = new TripulacaoAlheia($oponente[0]["tripulacao_id"]);
				
				$oponenteInfo->setCoord("interno","interno");
			}
			
			$sessao="ilhaGeral";
		}
		else{
			//personagens em caso de derrota
			foreach ($pers[$combateId["equipe"]] as $key => $value) {
				$bd->query(
					"UPDATE tb_per_personagem ".
					"SET hp='0', mp=':0:' ".
					"WHERE personagem_id=':1:'",
					array(
						$value["mp"],
						$value["personagem_id"]
					),
					array(
						INT_FORMAT,
						INT_FORMAT
					));
			}
			
			if($combateId["berries"]!=0){
				Usuario::getTrip()->subBerries($combateId["berries"]);
			}
			Usuario::getTrip()->setCoord("interno","interno");
			
			Usuario::getTrip()->updateCoord(Usuario::inIlha(),TRUE);
			
			if($tipo=="PvP"){
				$rxp=0;
				//personagens em caso de vitoria
				foreach ($pers[$equipeOponente] as $key => $value) {
					$bd->query(
						"UPDATE tb_per_personagem ".
						"SET xp=xp+:0:, hp=':1:', mp=':2:' ".
						"WHERE personagem_id=':3:'",
						array(
							$rxp,
							$value["hp"],
							$value["mp"],
							$value["personagem_id"]
						),
						array(
							INT_FORMAT,
							INT_FORMAT,
							INT_FORMAT,
							INT_FORMAT
						));
				}
			}
			
			$sessao="hospital";
		}
		
		Usuario::$combate = FALSE;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$_GET["tripulantes"] = "";