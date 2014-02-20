<?php
	if(!isset($_GET["per"])
	|| !preg_match(INT_FORMAT, $_GET["per"])) {
		$conteudo["erro"] = getMsgErroPersonagem();
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
		//verifica se ha espaco no inventario
		if(Usuario::getTrip()->getCapCarga()<=Usuario::getTrip()->getCarga()){
			$conteudo["erro"] = getMsgErroInventarioLotado();
			return;
		}
		
		//pega o item equipado
		$equipado = $bd->fazArray(
			"SELECT * FROM tb_per_personagem_acessorio ".
			"WHERE personagem_id=':0:'",
			array(
				$trip->id
			),
			array(INT_FORMAT)
		);
		
		if(sizeof($equipado)==0){
			$_GET["sel"] = $trip->id;
			$sessao="triEquipamentos";
			return;
		}
		
		$bd->query(
			"DELETE FROM tb_per_personagem_acessorio ".
			"WHERE personagem_id=':0:'",
			array(
				$trip->id
			),
			array(INT_FORMAT,INT_FORMAT)
		);
		$e = $equipado[0];
		Usuario::getTrip()->addItem($e["item_id"]);
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$_GET["sel"] = $trip->id;
	$sessao="triEquipamentos";