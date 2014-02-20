<?php
	if(!isset($_POST["capitao"])
	|| !preg_match(STR_FORMAT, $_POST["capitao"]) 
	|| strlen($_POST["capitao"])<5 ) {
		$conteudo["erro"] = "Nome do capitão inválido";
		return;
	}
	if(strlen($_POST["capitao"])>15) {
		$conteudo["erro"] = "O Nome do capitão não pode ter mais de 15 characteres.";
		return;
	}
	if(!isset($_POST["img"])
	|| !preg_match(INT_FORMAT, $_POST["img"])
	|| $_POST["img"] > QNT_PERSONAGENS ) {
		$conteudo["erro"] = "Imagem inválida para o capitão";
		return;
	}
	if(!isset($_POST["faccao"])
	|| ( strtolower( $_POST["faccao"] ) != "marinheiro" && strtolower( $_POST["faccao"] ) != "pirata" )){
		$conteudo["erro"] = "Facção inválida";
		return;
	}
	if(!isset($_POST["mar"])
	|| !preg_match(INT_FORMAT, $_POST["mar"])
	|| $_POST["mar"] > 4){
		$conteudo["erro"] = "Mar de origem inválido";
		return;
	}
	
	try{
		//formata valores recebidos
		$nomeCapitao = mysql_real_escape_string($_POST["capitao"]);
		$imgCapitao = mysql_real_escape_string($_POST["img"]);
		
		$coordenadas = array(1 => "1", 2 => "8", 3 => "15", 4 => "22");
		if($_POST["mar"]!=0) $coordenada = $coordenadas[$_POST["mar"]];
		else $coordenada = $coordenadas[rand(1,4)];
		
		if(Usuario::$faccao != NULL) $faccao = Usuario::$faccao;
		else{
			if(strtolower( $_POST["faccao"] ) == "marinheiro")$faccao = 0;
			else $faccao = 1; 
		}
		
		if( $faccao ==0 )$nomeTrip = "Marinheiros";
		else $nomeTrip = "Piratas";
		
		$nomeTrip .= $nomeCapitao;
		
		//verifica se existe tripulaçao com msm nome
		$trip = $bd->fazArray(
			"SELECT nome FROM tb_usr_tripulacao WHERE nome=':0:'",
			array($nomeTrip),
			array(STR_FORMAT)
		);
		if(sizeof($trip)!=0){
			$conteudo["mensagem"] = "Já existe uma tripulação com este nome.";
			return;
		}
		
		//verifica se nao atingiu limite de tripulacoes nessa conta
		$max = $bd->fazArray(
			"SELECT nome FROM tb_usr_tripulacao WHERE conta_id=':0:'",
			array(Usuario::$id),
			array(INT_FORMAT)
		);
		if(Usuario::$vip)$maxTrip = 6;
		else $maxTrip = 3;
		if(sizeof($max) >= $maxTrip){
			$conteudo["mensagem"] = "Você não pode criar mais tripulações nesta conta.";
			return;
		}
		
		//verifica se existe personagem com mesmo nome
		$per = $bd->fazArray(
			"SELECT nome FROM tb_per_personagem WHERE nome=':0:'",
			array($nomeCapitao),
			array(STR_FORMAT)
		);
		
		if(sizeof($per)!=0){
			$conteudo["mensagem"] = "Já existe um personagem com este nome.";
			return;
		}
		
		//efetua cadastro
		$bd->query(
			"INSERT INTO tb_usr_tripulacao (conta_id, nome, in_ilha, coordenada_atual, ilha_retorno, bandeira) ".
			"VALUES(':0:', ':1:','$coordenada','interno','$coordenada',':2:')",
			array(Usuario::$id, $nomeTrip, strtolower($_POST["faccao"])),
			array(INT_FORMAT, STR_FORMAT, STR_FORMAT, STR_FORMAT, STR_FORMAT)
		);
		
		$tripulacaoId = $bd->lastQuery["insert_id"];
		
		$bd->query(
			"INSERT INTO tb_per_personagem (tripulacao_id, imagem, nome) ".
			"VALUES (':0:',':1:',':2:')",
			array($tripulacaoId, $imgCapitao, $nomeCapitao),
			array(INT_FORMAT, INT_FORMAT, STR_FORMAT)
		);
		
		$capitaoId = $bd->lastQuery["insert_id"];
		
		$bd->query(
			"INSERT INTO tb_usr_tripulacao_capitao (tripulacao_id, personagem_id) ".
			"VALUES (':0:',':1:')",
			array($tripulacaoId, $capitaoId),
			array(INT_FORMAT, INT_FORMAT)
		);
		
		$bd->query("UPDATE tb_usr_conta SET faccao='$faccao' WHERE conta_id='".Usuario::$id."'");
		
		$menuRealizacao = "Tripulação criada com sucesso!";
		$conteudo["redirect"] = "game.php?ses=home"; 
	}
	catch(Exception $i){
		$conteudo["mensagem"] = "Erro ao criar nova tripulação, tente novamente mais tarde.";
		$erro->insere("Erro durante cadastro\n".$i->getMessage()."\n".$i->getTraceAsString());
	}
