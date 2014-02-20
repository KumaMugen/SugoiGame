<?php
	$title = "Combate";
	$conteudoCorpo = array();
	
	$combateId = Usuario::inCombate();
	$combate = $bd->fazArray(
		"SELECT * FROM tb_cbt_combate ".
		"WhERE combate_id='".$combateId["combate_id"]."'"
	);
	$combate = $combate[0];
	
	$jog1 = array(
		"title" => Usuario::getTrip()->nome,
		"i1" => Usuario::getTrip()->getCapitao()->nome,
		"i2" => Usuario::getTrip()->getPatente(),
		"bandeira" => Usuario::getTrip()->getBandeiraLink(),
		"equipe" => $combateId["equipe"]
	);
	
	if($combate["tipo"]==0){
		$tipo = "PvE";
		$oponente = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_mob ".
			"WHERE combate_id='".$combateId["combate_id"]."'"
		);
		$oponente = $oponente[0];
		$oponenteInfo = $bd->fazArray(
			"SELECT * FROM tb_pve_mob ".
			"WHERE mob_id='".$oponente["mob_id"]."'"
		);
		$oponenteInfo = $oponenteInfo[0];
		
		$tipoTitle = "Combate";
		
		$jog2 = array(
			"title" => $oponenteInfo["nome"],
			"i1" => "",
			"i2" => "",
			"bandeira" => "Imagens/Batalha/Mob/icon.jpg",
			"equipe" => 1
		);
	}
	else {
		$tipo = "PvP";
		$tipoTitle = getTipoCombate($combate["tipo"]);
		
		$oponente = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_tripulacao ".
			"WHERE combate_id='".$combateId["combate_id"]."'"
		);
		foreach ($oponente as $key => $value) {
			if($value["tripulacao_id"]!=Usuario::$tripAtiva){
				$oponente = $value;
				break;
			}
		}
		$oponenteInfo = new TripulacaoAlheia($oponente["tripulacao_id"]);
		
		$jog2 = array(
			"title" => $oponenteInfo->nome,
			"i1" => $oponenteInfo->getCapitao()->nome,
			"i2" => $oponenteInfo->getPatente(),
			"bandeira" => $oponenteInfo->getBandeiraLink(),
			"equipe" => $oponente["equipe"]
		);
		
		$up = new CombateUpdate($combateId["combate_id"]);
	}
	
	$bg = $combate["background"];
	$tab = getPersonagensInTabuleiro($combateId["combate_id"],$tipo);
	
	$log = array();
	if(file_exists("Logs/Combates/".$tipo."/".$combateId["combate_id"].".log")){
		$log = file("Logs/Combates/".$tipo."/".$combateId["combate_id"].".log");
		$log = array_reverse($log);
	}
	$relatorio = "";
	foreach ($log as $key => $value) {
		$relatorio.=$value;
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("DIV","id=cabecalho",array(
			e("DIV","class=tipo-title",array(texto($tipoTitle))),
			e("DIV","class=vs"),
			e("DIV","class=jogador1 jogador",getInfoJogadorCombate($jog1)),
			e("DIV","class=jogador2 jogador",getInfoJogadorCombate($jog2))
		)),
		e("DIV","id=tabuleiro-bg","class=".$tipo,"style=background:url(Imagens/Batalha/$bg.jpg)",array(
			e("DIV","id=relatorio",array(texto($relatorio))),
			e("DIV","id=tabuleiro","class=tabuleiro-$tipo","style=background:url(Imagens/Batalha/Tabuleiro$tipo.png)",array(
				($tipo=="PvE")?(
					e("DIV","id=npc",array(
						e("DIV","id=npc-hp",array(
							barra(150,"gray",($oponente["hp"]/$oponenteInfo["hp"]),"green",($oponente["hp"]." / ".$oponenteInfo["hp"]),1),
						)),
						e("IMG","id=npc-img","src=Imagens/Batalha/Mob/".$oponenteInfo["img"].".png")
					))
				):(array()),
				e("DIV","id=tabuleiro-personagens",array(
					$tab["tabuleiro"]
				))
			)),
			e("DIV","id=personagens-info",$tab["personagens-info"]),
			e("DIV","id=personagem-click")
		))
	));
	if($tipo=="PvE"){
		if($oponente["hp"]==0){
			$status = "venceu";
		}
		else
			$status = "continua";
		
		if($tab["hpTotal-0"]==0)
			$status = "perdeu";
	}
	else{
		if($tab["hpTotal-".$combateId["equipe"]]<=0)
			$status = "perdeu";
		else if($tab["hpTotal-".$oponente["equipe"]]<=0)
			$status = "venceu";
		else
			$status = "continua";
	}
	
	
	$conteudo["evento"] = 'combate("'.$tipo.'",'.$combateId["equipe"].','.$combate["turno"].','.($combate["tempo"]-atual_segundo()).','.$combate["movimentos"].',"'.$status.'")';
