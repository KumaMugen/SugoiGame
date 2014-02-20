<?php
	if(Usuario::$permissao>PER_sistemaRestricoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	try{
		$bd->query(
			"DELETE FROM tb_sis_restricao_pagina ".
			"WHERE pagina=':0:'",
			array($_GET["pagina"]),
			array(STR_FORMAT)
		);
		
		$sessao="sistemaRestricoes";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
