<?php
	if(Usuario::$permissao>PER_sistemaMissoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		$missao=array(
			"nome" => $_POST["nome"],
			"requisito_faccao" => (($_POST["requisito_faccao"]!=2)?$_POST["requisito_faccao"]:"NULL"),
			"requisito_missao" => $_POST["requisito_missao"],
			"requisito_lvl" => $_POST["requisito_lvl"],
			"recompensa_xp" => $_POST["recompensa_xp"],
			"recompensa_berries" => $_POST["recompensa_berries"],
			"mar_inicio" => $_POST["mar_inicio"],
			"is_texto_exclusivo" => $_POST["is_texto_exclusivo"],
			"texto_P_iniciacao" => $_POST["texto_P_iniciacao"],
			"texto_P_andamento" => $_POST["texto_P_andamento"],
			"texto_P_conclusao" => $_POST["texto_P_conclusao"],
			"texto_M_iniciacao" => $_POST["texto_M_iniciacao"],
			"texto_M_andamento" => $_POST["texto_M_andamento"],
			"texto_M_conclusao" => $_POST["texto_M_conclusao"]
		);
		$missao_tipo=array(
			"nome" => ALL_FORMAT,
			"requisito_faccao" => STR_FORMAT,
			"requisito_missao" => INT_FORMAT,
			"requisito_lvl" => INT_FORMAT,
			"recompensa_xp" => INT_FORMAT,
			"recompensa_berries" => INT_FORMAT,
			"mar_inicio" => INT_FORMAT,
			"is_texto_exclusivo" => INT_FORMAT,
			"texto_P_iniciacao" => ALL_FORMAT,
			"texto_P_andamento" => ALL_FORMAT,
			"texto_P_conclusao" => ALL_FORMAT,
			"texto_M_iniciacao" => ALL_FORMAT,
			"texto_M_andamento" => ALL_FORMAT,
			"texto_M_conclusao" => ALL_FORMAT
		);
		
		$indices = array();
		foreach ($missao as $key => $value) {
			$indices[$key] = $key;
		}
		
		$query = "INSERT INTO tb_mis_missao ( ";
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
		
		$id=$bd->lastQuery["insert_id"];
		
		$q = "npc-";
		$p = "ilha-";
		for($x=1;isset($_POST[$q.$x]);$x++){
			if(!empty($_POST[$q.$x]))
				$bd->query(
					"INSERT INTO tb_mis_missao_npc_inicio (missao_id, npc_id, ilha_id) ".
					"VALUES (':0:',':1:',':2:')",
					array($id,$_POST[$q.$x],$_POST[$p.$x]),
					array(INT_FORMAT,INT_FORMAT,INT_FORMAT)
				);
		}
		$q = "npc-c-";
		$p = "ilha-c-";
		for($x=1;isset($_POST[$q.$x]);$x++){
			if(!empty($_POST[$q.$x]))
				$bd->query(
					"INSERT INTO tb_mis_missao_npc_conclusao (missao_id, npc_id, ilha_id) ".
					"VALUES (':0:',':1:',':2:')",
					array($id,$_POST[$q.$x],$_POST[$p.$x]),
					array(INT_FORMAT,INT_FORMAT,INT_FORMAT)
				);
		}
		
		$q = "recompensa-item-";
		for($x=1;isset($_POST[$q.$x]);$x++){
			if(!empty($_POST[$q.$x]))
				$bd->query(
					"INSERT INTO tb_mis_missao_recompensa_item (missao_id, item_id) ".
					"VALUES (':0:',':1:')",
					array($id,$_POST[$q.$x]),
					array(INT_FORMAT,INT_FORMAT)
				);
		}
		
		$q = "recompensa-equip-";
		for($x=1;isset($_POST[$q.$x]);$x++){
			if(!empty($_POST[$q.$x]))
				$bd->query(
					"INSERT INTO tb_mis_missao_recompensa_equipamento (missao_id, equipamento_id) ".
					"VALUES (':0:',':1:')",
					array($id,$_POST[$q.$x]),
					array(INT_FORMAT,INT_FORMAT)
				);
		}
		
		$q = "objetivo-";
		$p = "objetivo-id-";
		$r = "objetivo-quant-";
		for($x=1;isset($_POST[$q.$x]);$x++){
			if(!empty($_POST[$q.$x]) OR !empty($_POST[$r.$x]))
				$bd->query(
					"INSERT INTO tb_mis_missao_objetivo (missao_id, tipo, objetivo_id, objetivo_quant) ".
					"VALUES (':0:',':1:',':2:',':3:')",
					array($id,$_POST[$q.$x],$_POST[$p.$x],$_POST[$r.$x]),
					array(INT_FORMAT,INT_FORMAT,INT_FORMAT,INT_FORMAT)
				);
		}
		
		$sessao="sistemaMissoesListagem";
	}
	catch(Exception $i){
		$erro->insere($i->getMessage()."\n".$i->getTraceAsString());
		$conteudo["mensagem"] = $i->getMessage();
	}
	
