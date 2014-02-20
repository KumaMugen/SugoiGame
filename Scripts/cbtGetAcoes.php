<?php
	$exibeInfoGeral[0] = 0;
	try{
		$combateId = Usuario::inCombate();
		
		$up = new CombateUpdate($combateId["combate_id"]);
		$acoes = $up->getAcoes();
		foreach ($acoes as $key => $value) {
			if($value["tipo"]==3){
				$acoes[$key]["tempo"] = $value["tempo"]-atual_segundo();
			}
		}
		$conteudo["retorno"] = $acoes;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}