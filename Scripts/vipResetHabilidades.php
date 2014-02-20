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
	
	try{
		$preco_reset = 5;
		
		if(Usuario::$gold < $preco_reset){
			$conteudo["erro"] = getMsgErroGold();
			return;
		}
		
		if(!Usuario::subGold($preco_reset,$bd)){
			$conteudo["erro"] = getMsgErroGold();
			return;
		}
		$bd->query("INSERT INTO tb_vip_reset_habilidade (personagem_id) VALUES (':0:')",array($trip->id));
		
		$bd->query(
			"DELETE FROM tb_per_personagem_habilidade ".
			"WHERE personagem_id=':0:' AND habilidade_id<99",
			array($trip->id),
			array(INT_FORMAT)
		);
		
		$bd->query(
			"DELETE FROM tb_per_personagem_habilidade_ponto ".
			"WHERE personagem_id=':0:'",
			array($trip->id),
			array(INT_FORMAT)
		);
		$bd->query(
			"UPDATE tb_per_personagem ".
			"SET pontos_habilidade=':0:' ".
			"WHERE personagem_id=':1:'",
			array(getPtsHabilidadeLvl($trip->lvl),$trip->id),
			array(INT_FORMAT,INT_FORMAT)
		);
	}
	catch(Exception $i){
		$erro->insere($i->getMessage()."\n".$i->getTraceAsString());
	}
	$_GET["sel"] = $trip->id;
	$sessao="ctHabilidades";
