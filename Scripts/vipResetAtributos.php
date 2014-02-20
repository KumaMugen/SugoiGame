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
		$preco_reset = $bd->fazArray("SELECT * FROM tb_vip_reset_atributos WHERE personagem_id=':0:'",array($trip->id));
		$preco_reset = sizeof($preco_reset)*10;
		if($preco_reset<2)$preco_reset=2;
		if($preco_reset>50)$preco_reset=50;
		
		if(Usuario::$gold < $preco_reset){
			$conteudo["erro"] = getMsgErroGold();
			return;
		}
		
		if(!Usuario::subGold($preco_reset,$bd)){
			$conteudo["erro"] = getMsgErroGold();
			return;
		}
		$bd->query("INSERT INTO tb_vip_reset_atributos (personagem_id) VALUES (':0:')",array($trip->id));
		
		$trip->pts = ($trip->lvl-1)*5+20;
		
		foreach ($trip->attr as $key => $value) {
			$trip->attr[$key] = 1;
		}
		
		$trip->hp = $trip->getHPMax();
		$trip->mp = $trip->getMPMax();
		
		$bd->query(
			"UPDATE tb_per_personagem ".
			"SET hp=':0:', mp=':1:', ".
			"atributo_atk='1', atributo_def='1', atributo_agl='1', atributo_res='1', ".
			"atributo_pre='1', atributo_des='1', atributo_per='1', atributo_vit='1', ".
			"atributo_sem_distribuir=':2:' ".
			"WHERE personagem_id=':3:'",
			array($trip->hp, $trip->mp, $trip->pts,$trip->id),
			array(ALL_FORMAT,ALL_FORMAT,ALL_FORMAT,ALL_FORMAT)
		);
	}
	catch(Exception $i){
		$erro->insere($i->getMessage()."\n".$i->getTraceAsString());
	}
	$_GET["sel"] = $trip->id;
	$sessao="tripulacaoStatus";
