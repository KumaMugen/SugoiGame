<?php
	if(!isset($_GET["pers"]) OR !isset($_GET["habi"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_GET["pers"]) OR !preg_match(INT_FORMAT, $_GET["habi"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("pers ou classe");
		return;
	}
	$habilidade = $_GET["habi"];
	
	//cria objeto personagem
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
	$trip->getClasse();
	if($trip->classe==0){
		$conteudo["erro"] = "Esse personagem não possui uma classe";
		return;
	}
	
	//pontos insuficientes
	if($trip->pontosHabilidade <= 0){
		$conteudo["erro"] = "Voce não possui pontos de habilidade a distribuir";
		return;
	}
	try{
		$habilidadeInfo = $bd->fazArray(
			"SELECT * FROM tb_per_habilidade ".
			"WHERE habilidade_id=':0:'",
			array(
				$habilidade,
			),
			array(
				INT_FORMAT
			)
		);
		//habilidade nao encontrada
		if(sizeof($habilidadeInfo)==0){
			$conteudo["erro"] = "Habilidade não encontrada";
			return;
		}
		//classe diferente
		if($habilidadeInfo[0]["requisito_classe"]!=$trip->classe){
			$conteudo["erro"] = "Esse personagem não possui a classe adequada";
			return;
		}
		
		//verifica se o edifico pode treinar essa habilidade
		$edifico = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_edificio ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND edificio_id='5'"
		);
		
		if(sizeof($edifico) == 0 OR $edifico[0]["lvl"] < ($habilidadeInfo[0]["sequencia"]-1)){
			$conteudo["erro"] = "Essa ilha não possui um Centro de Treinamento evoluído o suficiente para lhe ensinar esta habilidade.";
			return;
		}
		
		//veririfica se a senquencia foi feita
		if($habilidadeInfo[0]["sequencia"]>1){
			$habilidadeAnterior = $bd->fazArray(
				"SELECT * FROM tb_per_personagem_habilidade_ponto ".
				"WHERE personagem_id=':0:' AND habilidade_id=':1:'",
				array(
					$trip->id,
					(((Int)$habilidade)-1),
				),
				array(
					INT_FORMAT,
					INT_FORMAT
				)
			);
			//nao gastou ponto na habilidade anterior
			if(sizeof($habilidadeAnterior)==0){
				$conteudo["erro"] = "Esse personagem não cumpre os requisitos";
				return;
			}
		}
		
		$pontos = $bd->fazArray(
			"SELECT * FROM tb_per_personagem_habilidade_ponto ".
			"WHERE personagem_id=':0:' AND habilidade_id=':1:'",
			array(
				$trip->id,
				$habilidade,
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		if(sizeof($pontos)==0){
			$bd->query(
				"INSERT INTO tb_per_personagem_habilidade_ponto ".
				"(personagem_id, habilidade_id)".
				"VALUES (':0:',':1:')",
				array(
					$trip->id,
					$habilidade,
				),
				array(
					INT_FORMAT,
					INT_FORMAT
				)
			);
		}
		else{
			if($pontos[0]["pontos"]>=$habilidadeInfo[0]["requisito_pontos"]){
				$conteudo["erro"] = "Voce ja colocou a quantidade máxima de pontos nessa habilidade";
				return;
			}
			$bd->query(
				"UPDATE tb_per_personagem_habilidade_ponto ".
				"SET pontos=pontos+1 ".
				"WHERE personagem_id=':0:' AND habilidade_id=':1:'",
				array(
					$trip->id,
					$habilidade,
				),
				array(
					INT_FORMAT,
					INT_FORMAT
				)
			);
		}
		
		$trip->pontosHabilidade -= 1;
		
		$bd->query(
			"UPDATE tb_per_personagem ".
			"SET pontos_habilidade='".$trip->pontosHabilidade."' ".
			"WHERE personagem_id='".$trip->id."'"
		);
		
		$conteudo["mensagem"] = "Você gastou 1 ponto para destravar a árvore.<br>Quando você gastar todos os pontos necessários para uma habilidade, você precisa clicar nela novamente para aprende-la.";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$_GET["sel"] = $trip->id;
	$sessao="ctHabilidades";