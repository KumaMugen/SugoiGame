<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	try{
		$bd->query(
			"DELETE FROM tb_mun_ilha_edificio ".
			"WHERE ilha_id=':0:' AND edificio_id=':1:'",
			array($_GET["ilha"],$_GET["edificio"]),
			array(INT_FORMAT,INT_FORMAT)
		);
		
		$sessao="sistemaIlhas";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
