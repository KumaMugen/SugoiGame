<?php
	if(Usuario::$permissao>PER_sistemaAkuma){
		$_SESSION["erros"][] = getMsgErroPermissao();
		header("location:game.php?ses=sistemaAkumaListagem");
		exit();
	}
	
	if(!isset($_POST["akuma_id"])){
		$_SESSION["erros"][] = "Id inválida";
		header("location:game.php?ses=sistemaAkumaListagem");
		exit();
	}
	
	try{
		$bd->query(
			"UPDATE tb_akm_akuma ".
			"SET ".
			"img=':img:',".
			"nome=':nome:',".
			"descricao=':descricao:',".
			"tipo=':tipo:',".
			"categoria=':categoria:',".
			"ataques=':ataques:',".
			"buffs=':buffs:',".
			"passivas=':passivas:',".
			"raridade=':raridade:',".
			"efetividade=':efetividade:' ".
			"WHERE akuma_id=':akuma_id:'",
			$_POST,
			array(
			"img"=>INT_FORMAT,
			"nome"=>ALL_FORMAT,
			"descricao"=>ALL_FORMAT,
			"tipo"=>INT_FORMAT,
			"categoria"=>INT_FORMAT,
			"ataques"=>INT_FORMAT,
			"buffs"=>INT_FORMAT,
			"passivas"=>INT_FORMAT,
			"raridade"=>ALL_FORMAT,
			"efetividade"=>INT_FORMAT,
			"akuma_id"=>INT_FORMAT)
		);
		
		header("location:game.php?ses=sistemaAkumaListagem");
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
