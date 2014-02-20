<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$bd->query(
			"INSERT INTO tb_mun_edificio ".
			"(img,nome,descricao,preco_construcao,preco_upgrade,tempo_construcao,tempo_upgrade) ".
			"VALUES ".
			"(':img:',':nome:',':descricao:',':preco_construcao:',':preco_upgrade:',':tempo_construcao:',':tempo_upgrade:')",
			$_POST,
			array(
			"img"=>STR_FORMAT,
			"nome"=>ALL_FORMAT,
			"descricao"=>ALL_FORMAT,
			"preco_construcao"=>INT_FORMAT,
			"preco_upgrade"=>INT_FORMAT,
			"tempo_construcao"=>INT_FORMAT,
			"tempo_upgrade"=>INT_FORMAT)
		);
		
		$sessao="sistemaIlhas";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
