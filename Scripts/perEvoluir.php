<?php
	if(!isset($_GET["per"])
	|| !preg_match(INT_FORMAT, $_GET["per"])) {
		$conteudo["erro"] = "Personagem inválido";
		return;
	}
	try{
		$trip = new Personagem($_GET["per"]);
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	if($trip->codTrip != Usuario::$tripAtiva){
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	
	if($trip->xp < $trip->getXPMax()){
		$conteudo["erro"] = "Experiência insuficiente";
		return;
	}
	
	if($trip->lvl >= 50){
		$conteudo["erro"] = "Esse personagem já alcançou o nível máximo";
		return;
	}
	if(getNextLvlHabilidade($trip->lvl) == ($trip->lvl + 1)){
		$trip->pontosHabilidade += 1;
	}
	
	$trip->xp -= $trip->getXPMax();
	$trip->lvl += 1;
	$trip->hp = $trip->getHPMax();
	$trip->mp = $trip->getMPMax();
	$trip->pts += 5;
	
	$bd->query(
		"UPDATE tb_per_personagem ".
		"SET lvl=':0:', hp=':1:', mp=':2:', xp=':3:', atributo_sem_distribuir=':4:', pontos_habilidade=':5:'".
		"WHERE personagem_id=':6:'",
		array($trip->lvl, $trip->hp, $trip->mp, $trip->xp, $trip->pts,$trip->pontosHabilidade,$trip->id),
		array(ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT)
	);
	
	$conteudo["realizacao"] = $trip->nome." alcançou o nível ".$trip->lvl."!";
	
	$_GET["sel"] = $trip->id;
	$sessao="tripulacaoStatus";
	
	$_GET["tripulantes"] = "";