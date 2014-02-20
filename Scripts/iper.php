<?php
	if(!isset($_GET["per"]) || !isset($_GET["pag"])
	|| !preg_match(INT_FORMAT, $_GET["per"]) || !preg_match(STR_FORMAT, $_GET["pag"])) {
		$conteudo["erro"] = "Personagem inválido";
		return;
	}
	try{
		$value = new Personagem($_GET["per"]);
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	if($value->codTrip != Usuario::$tripAtiva){
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	try{
		$pag = $_GET["pag"];
		if (!file_exists("Includes/iper/".$pag.".php")) $pag = "404";
		
		include "Includes/iper/".$pag.".php";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	$exibeInfoGeral[0] = 0;