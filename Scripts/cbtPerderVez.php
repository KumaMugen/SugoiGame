<?php
	$exibeInfoGeral[0] = 0;
	try{
		$combateId = Usuario::inCombate();
		$combate = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate ".
			"WHERE combate_id='".$combateId["combate_id"]."'"
		);
		$combate = $combate[0];
		
		if($combate["tempo"]>atual_segundo()){
			$conteudo["retorno"] = array(
				"turno"=>$combate["turno"],
				"tempo"=>TEMPO_TURNO,
				"movimentos"=>MOVIMENTOS_TURNO
			);
			return;
		}
		
		if($combate["turno"]==0)$turno=1;
		else $turno=0;
		
		$tempo=atual_segundo()+TEMPO_TURNO;
		
		//finaliza Turno
		$bd->query(
			"UPDATE tb_cbt_combate ".
			"SET movimentos='5', turno='$turno', rodadas=rodadas+1, tempo='$tempo' ".
			"WHERE combate_id='".$combate["combate_id"]."'"
		);
		
		$bd->query(
			"UPDATE tb_cbt_combate_tripulacao ".
			"SET rodadas_perdidas=rodadas_perdidas+1 ".
			"WHERE combate_id='".$combate["combate_id"]."' ".
			"AND equipe='".$combate["turno"]."'"
		);
		
		cbtAtualizaEspera($combate["combate_id"]);
		cbtAtualizaBuffs($combate["combate_id"]);
		
		$conteudo["retorno"] = array(
			"turno"=>$turno,
			"tempo"=>TEMPO_TURNO,
			"movimentos"=>MOVIMENTOS_TURNO
		);
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}