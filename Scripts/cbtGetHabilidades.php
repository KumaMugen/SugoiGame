<?php
	if(!isset($_GET["id"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_GET["id"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("id");
		return;
	}
	
	//cria objeto personagem
	try{
		$pers = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE personagem_id=':0:'",
			array($_GET["id"]),
			array(INT_FORMAT)
		);
		if(sizeof($pers)==0){
			throw new NotFoundException("Personagem não encontrado");
		}
		
		$trip = new PersonagemCombate($pers[0]);
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
	try{
		$conteudo["retorno"] = $trip->getHabilidades();
		$conteudo["energia"] = $trip->mp;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$exibeInfoGeral[0] = 0;