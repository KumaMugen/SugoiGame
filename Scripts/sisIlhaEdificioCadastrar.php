<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$bd->query(
			"INSERT INTO tb_mun_ilha_edificio ".
			"(ilha_id,edificio_id,lvl,coordenada) ".
			"VALUES ".
			"(':ilha_id:',':edificio_id:',':lvl:',':coordenada:')",
			$_POST,
			array(
			"ilha_id"=>INT_FORMAT,
			"edificio_id"=>INT_FORMAT,
			"lvl"=>INT_FORMAT,
			"coordenada"=>INT_FORMAT)
		);
		
		$sessao="sistemaIlhas";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
