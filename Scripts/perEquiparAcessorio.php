<?php
	if(!isset($_GET["id"])
	|| !preg_match(INT_FORMAT, $_GET["id"])) {
		$conteudo["erro"] = "Atributo inválido";
		return;
	}
	if(!isset($_GET["per"])
	|| !preg_match(INT_FORMAT, $_GET["per"])) {
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	
	$id = $_GET["id"];
	
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
		//verifica se o usuario tem esse item
		$it = Usuario::getTrip()->hasItem($id);
		if(!$it){
			$conteudo["erro"] = "Você não possui esse item";
			return;
		}
		
		//pega o item no bd
		$item = $bd->fazArray(
			"SELECT * FROM tb_itn_item ".
			"WHERE item_id=':0:'",
			array($id),
			array(INT_FORMAT)
		);
		if(sizeof($item)==0){
			$conteudo["mensagem"] = "Item nao encontrado";
			return;
		}
		//ve se ja tem algo equipado no slot
		$equipado = $bd->fazArray(
			"SELECT * FROM tb_per_personagem_acessorio ".
			"WHERE personagem_id=':0:'",
			array(
				$trip->id
			),
			array(INT_FORMAT)
		);
		if(sizeof($equipado)!=0){
			//verifica se ha espaco no inventario
			if(Usuario::getTrip()->getCapCarga()<=Usuario::getTrip()->getCarga()){
				$conteudo["erro"] = getMsgErroInventarioLotado();
				return;
			}
			
			$e = $equipado[0];
			$bd->query(
				"DELETE FROM tb_per_personagem_acessorio ".
				"WHERE personagem_id=':0:'",
				array(
					$trip->id
				),
				array(INT_FORMAT)
			);
			
			Usuario::getTrip()->addItem($e["item_id"]);
		}
		
		$bd->query(
			"INSERT INTO tb_per_personagem_acessorio ".
			"(personagem_id,item_id) ".
			"VALUES (':0:',':1:')",
			array(
				$trip->id,
				$id
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		Usuario::getTrip()->subItem($id);
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$_GET["sel"] = $trip->id;
	$sessao="triEquipamentos";