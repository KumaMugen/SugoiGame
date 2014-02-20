<?php
	if(!isset($_GET["trip"])
	|| !preg_match(INT_FORMAT, $_GET["trip"])){
		$conteudo["erro"] = "Tripulação inválida";
		return;
	}
	try{
		$trip = new Tripulacao($_GET["trip"],$bd);
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	
	if($trip->conta != Usuario::$id){
		$conteudo["erro"] = "Tripulação inválida";
		return;
	}
	if(Usuario::$tripAtiva!=0){
		$conteudo["erro"] = getMsgErroComTrip();
		return;
	}
	
	try{
		$bd->query(
			"INSERT INTO tb_usr_conta_tripulacao (conta_id, tripulacao_id) ".
			"VALUES ('".Usuario::$id."','".$trip->trip."')"
		);
		session_destroy();
		$conteudo["redirect"] = "game.php";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = "Erro ao iniciar sessão nova tripulação, tente novamente mais tarde.";
		$erro->insere("Erro durante seleçao de trip\n".$i->getMessage()."\n".$i->getTraceAsString());
	}
