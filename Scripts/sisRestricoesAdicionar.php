<?php
	if(Usuario::$permissao>PER_sistemaRestricoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	try{
		$bd->query(
			"INSERT INTO tb_sis_restricao_pagina ".
			"(pagina,logado,tripativa,combate,ilha,navio,missao,recrutamento,rota,derrotado) ".
			"VALUES ".
			"(':pagina:',':logado:',':tripativa:',':combate:',':ilha:',':navio:',':missao:',':recrutamento:',':rota:',':derrotado:')",
			$_POST,
			array(
			"pagina"=>STR_FORMAT,
			"logado"=>INT_FORMAT,
			"tripativa"=>INT_FORMAT,
			"combate"=>INT_FORMAT,
			"ilha"=>INT_FORMAT,
			"navio"=>INT_FORMAT,
			"missao"=>INT_FORMAT,
			"recrutamento"=>INT_FORMAT,
			"rota"=>INT_FORMAT,
			"derrotado"=>INT_FORMAT)
		);
		
		$sessao="sistemaRestricoes";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
