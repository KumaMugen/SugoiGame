<?php
	if(!isset($_GET["missao"])
	|| !preg_match(INT_FORMAT, $_GET["missao"])) {
		$conteudo["erro"] = "Missão inválida";
		return;
	}
	try{
		$m = new Missao($_GET["missao"]);
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	try{
		if($m->getStatus()!=2 ){
			$conteudo["erro"] = "Você não concluiu essa missão.";
			return;
		}
		if(Usuario::getTrip()->getCapCarga() <= Usuario::getTrip()->getCarga()){
			$conteudo["mensagem"] = getMsgErroInventarioLotado();
			return;
		}
		
		//conclusao
		$bd->query(
			"DELETE FROM tb_mis_missao_andamento ".
			"WHERE tripulacao_id='".Usuario::$tripAtiva."' ".
			"AND missao_id='".$m->id."'"
		);
		$bd->query(
			"INSERT INTO tb_mis_missao_concluida ".
			"(missao_id, tripulacao_id)".
			"VALUES ('".$m->id."', '".Usuario::$tripAtiva."')"
		);
		//remove itens objetivos
		$obj = $m->getObjetivos();
		foreach ($obj as $key => $value) {
			if($value["tipo"] == 2){
				Usuario::getTrip()->subItem($value["objetivo_id"],$value["objetivo_quant"]);
			}
		}
		
		//recompensas
		//XP
		$tripulantes = Usuario::getTrip()->getTripulantes();
		
		$rXP = getXPByNivel($m->requisitoLVL)*$m->recompensaXP/1000*RATE_XP;
		foreach ($tripulantes as $key => $value) {
			$value->addXP($rXP);
		}
		
		//Berries
		Usuario::getTrip()->addBerries(($m->recompensaBerries*RATE_BERRIES));
		
		//Itens
		$recItem = $m->getRecompensaItensSemDescricao();
		foreach ($recItem as $key => $value) {
			Usuario::getTrip()->addItem($value["item_id"],$value["quant"]);
		}
		
		//Equipamentos
		$recEquip = $m->getRecompensaEquipamentosSemDescricao();
		foreach ($recEquip as $key => $value) {
			Usuario::getTrip()->addEquipamento($value["equipamento_id"]);
		}
		
		Usuario::$inMissao = FALSE;
		Usuario::$inRecrutamento = FALSE;
		$conteudo["mensagem"] = "Missão Concluida!";
		$sessao = "ilhaGeral";
		$_GET["tripulantes"] = "";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	