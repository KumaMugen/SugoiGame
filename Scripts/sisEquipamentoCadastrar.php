<?php
	if(Usuario::$permissao>PER_sistemaItens){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$missao=array(
			"slot" => $_POST["slot"],
			"lvl" => $_POST["lvl"],
			"nome" => $_POST["nome"],
			"descricao" => $_POST["descricao"],
			"img" => $_POST["img"],
			"categoria" => $_POST["categoria"],
			"tipo_efeito" => $_POST["tipo_efeito"],
			"treino" => $_POST["treino"],
			"requisito_classe" => $_POST["requisito_classe"],
			"preco" => $_POST["preco"],
			"is_negociavel" => $_POST["is_negociavel"],
			"is_armazenavel" => $_POST["is_armazenavel"]
		);
		$missao_tipo=array(
			"slot" => INT_FORMAT,
			"lvl" => ALL_FORMAT,
			"nome" => ALL_FORMAT,
			"descricao" => ALL_FORMAT,
			"img" => INT_FORMAT,
			"categoria" => INT_FORMAT,
			"tipo_efeito" => INT_FORMAT,
			"treino" => INT_FORMAT,
			"requisito_classe" => INT_FORMAT,
			"preco" => INT_FORMAT,
			"is_negociavel" => INT_FORMAT,
			"is_armazenavel" => INT_FORMAT
		);
		
		$indices = array();
		foreach ($missao as $key => $value) {
			$indices[$key] = $key;
		}
		
		$query = "INSERT INTO tb_itn_equipamento ( ";
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
		
		$sessao="sistemaEquipamentosListagem";
	}
	catch(Exception $i){
		$erro->insere($i->getMessage()."\n".$i->getTraceAsString());
		$conteudo["mensagem"] = "ERRO NO CADASTRO!";
	}
	
