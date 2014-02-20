<?php
	if(Usuario::$permissao>PER_sistemaItens){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$missao=array(
			"tipo" => $_POST["tipo"],
			"lvl" => $_POST["lvl"],
			"nome" => $_POST["nome"],
			"descricao" => $_POST["descricao"],
			"img" => $_POST["img"],
			"categoria" => $_POST["categoria"],
			"is_consumivel" => $_POST["is_consumivel"],
			"descricao_efeito" => $_POST["descricao_efeito"],
			"hp_recuperado" => $_POST["hp_recuperado"],
			"mp_recuperado" => $_POST["mp_recuperado"],
			"bonus_atk" => $_POST["bonus_atk"],
			"bonus_def" => $_POST["bonus_def"],
			"bonus_agl" => $_POST["bonus_agl"],
			"bonus_pre" => $_POST["bonus_pre"],
			"bonus_res" => $_POST["bonus_res"],
			"bonus_des" => $_POST["bonus_des"],
			"bonus_per" => $_POST["bonus_per"],
			"bonus_vit" => $_POST["bonus_vit"],
			"preco" => $_POST["preco"],
			"script" => $_POST["script"],
			"is_negociavel" => $_POST["is_negociavel"],
			"is_armazenavel" => $_POST["is_armazenavel"]
		);
		$missao_tipo=array(
			"tipo" => INT_FORMAT,
			"lvl" => ALL_FORMAT,
			"nome" => ALL_FORMAT,
			"descricao" => ALL_FORMAT,
			"img" => INT_FORMAT,
			"categoria" => INT_FORMAT,
			"is_consumivel" => INT_FORMAT,
			"descricao_efeito" => ALL_FORMAT,
			"hp_recuperado" => INT_FORMAT,
			"mp_recuperado" => INT_FORMAT,
			"bonus_atk" => INT_FORMAT,
			"bonus_def" => INT_FORMAT,
			"bonus_agl" => INT_FORMAT,
			"bonus_pre" => INT_FORMAT,
			"bonus_res" => INT_FORMAT,
			"bonus_des" => INT_FORMAT,
			"bonus_per" => INT_FORMAT,
			"bonus_vit" => INT_FORMAT,
			"preco" => INT_FORMAT,
			"script" => ALL_FORMAT,
			"is_negociavel" => INT_FORMAT,
			"is_armazenavel" => INT_FORMAT
		);
		
		$indices = array();
		foreach ($missao as $key => $value) {
			$indices[$key] = $key;
		}
		
		$query = "INSERT INTO tb_itn_item ( ";
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
		
		$sessao="sistemaItensListagem";
	}
	catch(Exception $i){
		$erro->insere($i->getMessage()."\n".$i->getTraceAsString());
		$conteudo["mensagem"] = "ERRO NO CADASTRO!";
	}
	
