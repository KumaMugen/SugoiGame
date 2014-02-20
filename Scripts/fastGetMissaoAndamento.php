<?php
	try{
		Usuario::inMissao();
		$missao = Usuario::$missaoList;
		$m = $bd->fazArray(
			"SELECT * FROM tb_mis_missao WHERE missao_id='".$missao[0]["missao_id"]."'"
		);
		$missao[0]["nome"] = $m[0]["nome"];
		
		if($missao[0]["tipo"]==0){
			$missao[0]["esperar"] = $missao[0]["objetivo_quant"]-atual_segundo();
		}
		else if($missao[0]["tipo"]==1){
			$it = $bd->fazArray(
				"SELECT * FROM tb_pve_mob WHERE mob_id='".$missao[0]["objetivo_id"]."'"
			);
			$missao[0]["objetivo_descricao"] = $it[0]["nome"];
			
			$m = $bd->fazArray(
				"SELECT * FROM tb_mis_missao_objetivo WHERE missao_id='".$missao[0]["missao_id"]."'"
			);
			
			$missao[0]["progresso"] = $missao[0]["objetivo_quant"];
			$missao[0]["objetivo_quant"] = $m[0]["objetivo_quant"];
		}
		else if($missao[0]["tipo"]==2){
			$it = $bd->fazArray(
				"SELECT * FROM tb_itn_item WHERE item_id='".$missao[0]["objetivo_id"]."'"
			);
			$missao[0]["objetivo_descricao"] = $it[0]["nome"];
			
			$it = $bd->fazArray(
				"SELECT * FROM tb_itn_tripulacao_item ".
				"WHERE item_id='".$missao[0]["objetivo_id"]."' AND tripulacao_id='".Usuario::$tripAtiva."'"
			);
			if(sizeof($it)>0)
				$missao[0]["progresso"] = $it[0]["quant"];
			else 
				$missao[0]["progresso"] = 0;
			
			$m = $bd->fazArray(
				"SELECT * FROM tb_mis_missao_objetivo WHERE missao_id='".$m[0]["missao_id"]."'"
			);
			$missao[0]["objetivo_quant"] = $m[0]["objetivo_quant"];
		}
		$conteudo["retorno"] = $missao[0];
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	