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
	if(!isset($_GET["evolucao"])
	|| !preg_match(INT_FORMAT, $_GET["evolucao"])) {
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	if(!isset($_GET["slot_1"])
	|| !preg_match(INT_FORMAT, $_GET["slot_1"])) {
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	if(!isset($_GET["slot_2"])
	|| !preg_match(INT_FORMAT, $_GET["slot_2"])) {
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	
	$equipamento = $_GET["id"];
	$ev = $_GET["evolucao"];
	$s1 = $_GET["slot_1"];
	$s2 = $_GET["slot_2"];
	
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
		//verifica se o usuario tem esse equip
		$eq = Usuario::getTrip()->hasEquipamento($equipamento,$ev,$s1,$s2);
		if(!$eq){
			$conteudo["erro"] = "Você não possui esse equipamento";
			return;
		}
		
		//pega o item no bd
		$equip = $bd->fazArray(
			"SELECT * FROM tb_itn_equipamento ".
			"WHERE equipamento_id=':0:'",
			array($equipamento),
			array(INT_FORMAT)
		);
		if(sizeof($equip)==0){
			$conteudo["mensagem"] = "Equipamento nao encontrado";
			return;
		}
		
		//verifica se o personagem pode equipar o item
		if($equip[0]["lvl"]>$trip->lvl){
			$conteudo["erro"] = "Esse Personagem não tem nível suficiente para usar esse equipamento.";
			return;
		}
		$trip->getClasse();
		if($equip[0]["requisito_classe"]!=0 AND $equip[0]["requisito_classe"]!=$trip->classe){
			$conteudo["erro"] = "Esse Personagem não tem a classe necessária para usar esse equipamento.";
			return;
		}
		
		//ve se ja tem algo equipado no slot
		$equipado = $bd->fazArray(
			"SELECT * FROM tb_per_personagem_equipamento ".
			"WHERE personagem_id=':0:' AND slot=':1:'",
			array(
				$trip->id,
				$equip[0]["slot"]
			),
			array(INT_FORMAT,INT_FORMAT)
		);
		
		if(sizeof($equipado)!=0){
			$e = $equipado[0];
			$bd->query(
				"DELETE FROM tb_per_personagem_equipamento ".
				"WHERE personagem_id=':0:' AND slot=':1:'",
				array(
					$trip->id,
					$equip[0]["slot"]
				),
				array(INT_FORMAT,INT_FORMAT)
			);
			
			Usuario::getTrip()->addEquipamento($e["equipamento_id"],$e["evolucao"],$e["slot_1"],$e["slot_2"]);
		}
		
		$bd->query(
			"INSERT INTO tb_per_personagem_equipamento ".
			"(personagem_id,slot,equipamento_id,evolucao,slot_1,slot_2) ".
			"VALUES (':0:',':1:',':2:',':3:',':4:',':5:')",
			array(
				$trip->id,
				$equip[0]["slot"],
				$equip[0]["equipamento_id"],
				$eq["evolucao"],
				$eq["slot_1"],
				$eq["slot_2"]
			),
			array(
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		Usuario::getTrip()->subEquipamento($equip[0]["equipamento_id"],$eq["evolucao"],$eq["slot_1"],$eq["slot_2"]);
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$_GET["sel"] = $trip->id;
	$sessao="triEquipamentos";