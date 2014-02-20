<?php
	if(!isset($_GET["pers"]) OR !isset($_GET["x"]) OR !isset($_GET["y"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_GET["pers"]) OR !preg_match(INT_FORMAT, $_GET["x"]) OR !preg_match(INT_FORMAT, $_GET["y"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("pers");
		return;
	}
	
	$combateId = Usuario::inCombate();
	$combate = $bd->fazArray(
		"SELECT * FROM tb_cbt_combate ".
		"WHERE combate_id='".$combateId["combate_id"]."'"
	);
	$combate = $combate[0];
	if($combate["turno"]!=$combateId["equipe"]){
		$conteudo["erro"] = "Não é a sua vez";
		return;
	}
	if($combate["movimentos"]<=0){
		$conteudo["erro"] = "Você não pode se movimentar";
		return;
	}
	//cria objeto personagem
	try{
		$pers = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE personagem_id=':0:'",
			array($_GET["pers"]),
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
		$x = $_GET["x"];
		$y = $_GET["y"];
		if(abs($trip->quadro->x-$x)>1 OR abs($trip->quadro->y-$y)>1){
			$conteudo["retorno"] = FALSE;
			return;
		}
		$q = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE combate_id='".$combate["combate_id"]."' AND quadro=':0:' AND hp>0",
			array($x."_".$y),
			array(COORD_FORMAT)
		);
		if(sizeof($q)!=0){
			$conteudo["retorno"] = FALSE;
			return;
		}
		$origem = $trip->quadro;
		
		$trip->setCoord($x,$y);
		
		$destino = $trip->quadro;
		
		$mov = $combate["movimentos"]-1;
		
		$bd->query(
			"UPDATE tb_cbt_combate ".
			"SET movimentos='$mov' ".
			"WHERE combate_id='".$combate["combate_id"]."'"
		);
		
		if($combate["tipo"]!=0){
			$up = new CombateUpdate($combate["combate_id"]);
			$acao = array(
				"tipo"=>1,
				"equipe"=>$trip->equipe,
				"pers"=>$trip->id,
				"origem_x"=>$origem->x,
				"origem_y"=>$origem->y,
				"destino_x"=>$destino->x,
				"destino_y"=>$destino->y
			);
			
			$up->addAcao($acao);
		}
		
		$conteudo["retorno"] = TRUE;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$exibeInfoGeral[0] = 0;