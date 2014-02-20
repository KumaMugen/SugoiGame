<?php
	if(Usuario::$permissao>PER_sistemaAkuma){
		$_SESSION["erros"][] = getMsgErroPermissao();
		header("location:game.php?ses=sistemaAkumaListagem");
		exit();
	}
	try{
		$bd->query(
			"INSERT INTO tb_akm_akuma ".
			"(img,nome,descricao,tipo,categoria,ataques,buffs,passivas,raridade,efetividade) ".
			"VALUES ".
			"(':img:',':nome:',':descricao:',':tipo:',':categoria:',':ataques:',':buffs:',':passivas:',':raridade:',':efetividade:')",
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
			"efetividade"=>INT_FORMAT)
		);
		
		header("location:game.php?ses=sistemaAkumaListagem");
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
