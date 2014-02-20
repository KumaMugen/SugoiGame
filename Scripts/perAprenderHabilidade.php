<?php
	if(!isset($_POST["personagem"]) 
	OR !isset($_POST["habilidade"])
	OR !isset($_POST["img"])
	OR !isset($_POST["nome"])
	OR !isset($_POST["descricao"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_POST["personagem"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("personagem");
		return;
	}
	if(!preg_match(INT_FORMAT, $_POST["habilidade"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("habilidade");
		return;
	}
	if(!preg_match(INT_FORMAT, $_POST["img"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("Icone");
		return;
	}
	if(strlen($_POST["nome"])<5) {
		$conteudo["erro"] = getErroInformacaoInvalida("nome");
		return;
	}
	if(strlen($_POST["descricao"])<5) {
		$conteudo["erro"] = getErroInformacaoInvalida("descricao");
		return;
	}
	
	$pers = strip_tags($_POST["personagem"]);
	$habilidade = strip_tags($_POST["habilidade"]);
	$img = strip_tags($_POST["img"]);
	$nome = htmlspecialchars($_POST["nome"]);
	$descricao = htmlspecialchars($_POST["descricao"]);
	
	//cria objeto personagem
	try{
		$trip = new Personagem($pers);
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
	try{
		//habilidade ja aprendida
		$habilidadePersonagem = $bd->fazArray(
			"SELECT * FROM tb_per_personagem_habilidade ".
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
		if(sizeof($habilidadePersonagem)!=0){
			$conteudo["erro"] = "Voce já aprendeu essa habilidade";
			return;
		}
		
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
		
		//verifica se o edifico pode treinar essa habilidade
		$edifico = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_edificio ".
			"WHERE ilha_id='".Usuario::inIlha()."' AND edificio_id='5'"
		);
		
		if(sizeof($edifico) == 0 OR $edifico[0]["lvl"] < ($habilidadeInfo[0]["sequencia"]-1)){
			$conteudo["erro"] = "Essa ilha não possui um Centro de Treinamento evoluído o suficiente para lhe ensinar esta habilidade.";
			return;
		}
		
		if($habilidadeInfo[0]["categoria"]==1){
			//veririfica se o ponto foi atribuido
			$habilidadePonto = $bd->fazArray(
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
			//nao gastou ponto na habilidade
			if(sizeof($habilidadePonto)==0){
				$conteudo["erro"] = "Esse personagem não cumpre os requisitos";
				return;
			}
		}
		
		$bd->query(
			"INSERT INTO tb_per_personagem_habilidade ".
			"(personagem_id, habilidade_id, img, nome, descricao)".
			"VALUES (':0:',':1:',':2:',':3:',':4:')",
			array(
				$trip->id,
				$habilidade,
				$img,
				$nome,
				$descricao,
			),
			array(
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				ALL_FORMAT,
				ALL_FORMAT
			)
		);
		
		$conteudo["mensagem"] = $trip->nome." aprendeu uma nova habilidade!";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$_GET["sel"] = $trip->id;
	$sessao="ctHabilidades";