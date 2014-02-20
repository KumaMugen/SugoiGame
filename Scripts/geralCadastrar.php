<?php
	if(!isset($_POST["nome"]) || !isset($_POST["email"]) || !isset($_POST["senha"])){
		$conteudo["erro"] = "Formulário incompleto";
		return;
	}
	$_POST["email"] = strtolower($_POST["email"]);
	if(!preg_match(EMAIL_FORMAT, $_POST["email"]) || strlen($_POST["nome"])<5 || strlen($_POST["senha"])<6){
		$conteudo["erro"] = "Você informou algo inválido";
		return;
	}
	
	try{
		$tam = sizeof($bd->fazArray(
			"SELECT conta_id FROM tb_usr_conta ".
			"WHERE email=':0:'",
			array($_POST["email"]),
			array(EMAIL_FORMAT))
		);
		if($tam!=0){
			$conteudo["mensagem"] = "O email informado já está cadastrado.";
			$conteudo["evento"] = "emailCadastrado();";
			return;
		}
		
		$senha = encriptaSenha($_POST["senha"]);
		
		$ativacao = substr($senha,8,8);
		
		$bd->query("INSERT INTO tb_usr_conta ".
			"(nome,email,senha,is_ativado)".
			"VALUES (':0:',':1:',':2:',':3:')",
			array($_POST["nome"],$_POST["email"],$senha,$ativacao),
			array(ALL_FORMAT,EMAIL_FORMAT,ALL_FORMAT,ALL_FORMAT)
		);
		$id=$bd->lastQuery["insert_id"];
		
		if(isset($_POST["padrinho"])){
			$padrinho = $bd->fazArray(
				"SELECT conta_id FROM tb_usr_conta ".
				"WHERE conta_id=':0:'",
				array($_POST["padrinho"]),
				array(INT_FORMAT)
			);
			if(sizeof($tam) != 0){
				$padrinho = $padrinho[0];
				
				$bd->query(
					"INSERT INTO tb_usr_conta_afilhado (conta_id,afilhado_id)".
					"VALUES (':0:',':1:')"
					,array($padrinho["conta_id"],$id),
					array(INT_FORMAT,INT_FORMAT)
				);
			}
		}
		
		$sessao = "ativacao";
		$conteudo["mensagem"] = "Um Email com um código de ativação foi enviado para o endereço informado.<br /><br />".
		"Informe o código de ativação contido no email para começar a jogar.";
	}
	catch (Exception $i){
		$erro->insere("Erro durante cadastro\n".$i->getMessage()."\n".$i->getTraceAsString());
	}
