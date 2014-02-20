<?php
	if(Usuario::$permissao>PER_sistemaNPC){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$missao=array(
			"nome" => $_POST["nome"],
			"is_mar" => $_POST["is_mar"],
			"coordenada" => $_POST["coordenada"],
			"img" => $_POST["img"],
			"background" => $_POST["background"],
			"is_compra" => $_POST["is_compra"],
			"is_vende" => $_POST["is_vende"],
			"texto" => $_POST["texto"]
		);
		$missao_tipo=array(
			"nome" => ALL_FORMAT,
			"is_mar" => INT_FORMAT,
			"coordenada" => ALL_FORMAT,
			"img" => INT_FORMAT,
			"background" => INT_FORMAT,
			"is_compra" => INT_FORMAT,
			"is_vende" => INT_FORMAT,
			"texto" => ALL_FORMAT
		);
		
		$indices = array();
		foreach ($missao as $key => $value) {
			$indices[$key] = $key;
		}
		
		$query = "INSERT INTO tb_mun_npc ( ";
		$query .= implode(" , ", $indices);
		$query .= " ) VALUES ( ";
		foreach ($indices as $key => $value) {
			$indices[$key] = "':".$value.":'";
		}
		$query .= implode(" , ", $indices);
		$query .= " ) ";
		
		$bd->query(
			$query,
			$missao,
			$missao_tipo
		);
		
		$sessao="sistemaNPCListagem";
	}
	catch(Exception $i){
		$erro->insere($i->getMessage()."\n".$i->getTraceAsString());
		$conteudo["mensagem"] = "ERRO NO CADASTRO!";
	}
	
