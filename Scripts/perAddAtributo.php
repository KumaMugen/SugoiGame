<?php
	if(!isset($_GET["attr"])
	|| !preg_match(INT_FORMAT, $_GET["attr"])
	|| $_GET["attr"]>9) {
		$conteudo["erro"] = "Atributo inválido";
		return;
	}
	if(!isset($_GET["pers"])
	|| !preg_match(INT_FORMAT, $_GET["pers"])) {
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	if(!isset($_GET["quant"])
	|| !preg_match(INT_FORMAT, $_GET["quant"])) {
		$quant = 1;
	}
	else $quant = $_GET["quant"];
	
	try{
		$trip = new Personagem($_GET["pers"]);
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
	if($trip->pts<$quant){
		$conteudo["erro"] = "Esse personagem não possui pontos para distribuir.";
		return;
	}
	$att = $_GET["attr"];
	$trip->attr[getAtributoTabela($att)] += $quant;
	$trip->pts -= $quant;
	
	if(getAtributoTabela($att)=="vit"){
		$trip->hp = $trip->getHPMax();
		$trip->mp = $trip->getMPMax();
	}
	try{
		$bd->query(
			"UPDATE tb_per_personagem ".
			"SET ".getAtributoTabelaCompleto($att)."=':0:', ".
			"atributo_sem_distribuir=':1:', ".
			"hp=':2:', ".
			"mp=':3:' ".
			"WHERE personagem_id=':4:'",
			array($trip->attr[getAtributoTabela($att)],$trip->pts, $trip->hp, $trip->mp, $trip->id),
			array(ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT)
		);
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$_GET["sel"] = $trip->id;
	$sessao="tripulacaoStatus";
	
	$_GET["tripulantes"] = "";