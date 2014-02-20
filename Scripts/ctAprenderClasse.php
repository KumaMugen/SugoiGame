<?php
	if(!isset($_GET["pers"]) OR !isset($_GET["classe"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_GET["pers"]) OR !preg_match(INT_FORMAT, $_GET["classe"])) {
		$conteudo["erro"] = getErroInformacaoInvalida("pers ou classe");
		return;
	}
	$classe = $_GET["classe"];
	
	if($classe != 1 AND $classe != 2 AND $classe !=3){
		$conteudo["erro"] = getErroInformacaoInvalida("Classe");
		return;
	}
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
	if($trip->classe!=0){
		$conteudo["erro"] = "Esse personagem já possui uma classe";
		return;
	}
	try{
		$bd->query(
			"INSERT INTO tb_per_personagem_classe ".
			"(personagem_id, classe_id)".
			"VALUES (':0:',':1:')",
			array(
				$trip->id,
				$classe,
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		$trip->classe = $classe;
		
		$conteudo["realizacao"] = $trip->nome." se tornou um ".$trip->getClasse()."!";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$_GET["sel"] = $trip->id;
	$sessao="ctClasses";
	
	$_GET["tripulantes"] = "";