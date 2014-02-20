<?php
	if (!isset($_POST["login"]) OR !preg_match(EMAIL_FORMAT, $_POST["login"]) OR !isset($_POST["senha"])) {
		$_SESSION["erros"][] = "Você informou algum caracter inválido.";
		header("location:index.php");
		exit();
	}
	$login = $_POST["login"];
	$senha = encriptaSenha($_POST["senha"]);
	
	try{
		$usr = $bd->fazArray(
			"SELECT conta_id, is_ativado, permissao, senha FROM tb_usr_conta ".
			"WHERE email=':0:' LIMIT 1",
			array($login),
			array(EMAIL_FORMAT)
		);
		
		//se nao encontrar o login e senha
		if(sizeof($usr) == 0 OR $usr[0]["senha"]!=$senha){
			$_SESSION["erros"][] = "Usuário e/ou senha não encontrados";
			header("location:index.php");
			exit();
		}
		if($usr[0]["is_ativado"] != "0"){
			$_SESSION["erros"][] = "Essa conta ainda não foi ativada!";
			header("location:game.php?ses=ativacao");
			exit();
		}
		
		//verifica se o sistema esta em manutençao
		$manutencao=$bd->fazArray("SELECT * FROM tb_sis_manutencao");
		if(sizeof($manutencao)==0){
			$manutencao[0]["permissao"] = 2;
		}
		
		if($usr[0]["permissao"]>$manutencao[0]["permissao"]){
			$_SESSION["erros"][] = "O sistema está em manutenção!";
			header("location:index.php");
			exit();
		}
		
		Usuario::setCookieLogin($usr[0]["conta_id"],$bd);
		
		session_destroy();
		
		header("location:game.php");
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
