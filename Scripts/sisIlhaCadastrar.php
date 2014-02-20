<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$bd->query(
			"INSERT INTO tb_mun_ilha ".
			"(coordenada,nome,cor_bg_dia,cor_bg_noite,bg,interno) ".
			"VALUES ".
			"(':coordenada:',':nome:',':cor_bg_dia:',':cor_bg_noite:',':bg:',':interno:')",
			$_POST,
			array(
			"coordenada"=>STR_FORMAT,
			"nome"=>ALL_FORMAT,
			"cor_bg_dia"=>STR_FORMAT,
			"cor_bg_noite"=>STR_FORMAT,
			"bg"=>INT_FORMAT,
			"interno"=>INT_FORMAT)
		);
		
		$sessao="sistemaIlhas";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
