<?php
	if(!isset($_GET["missao"])
	|| !preg_match(INT_FORMAT, $_GET["missao"])) {
		$conteudo["erro"] = "Missão inválida";
		return;
	}
	try{
		$m = new Missao($_GET["missao"]);
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	try{
		if(!$m->cumpreRequisitos() OR $m->getStatus()!=0 ){
			$conteudo["erro"] = "Você não cumpre os requisitos necessários para iniciar essa missão.";
			return;
		}
		$obj = $m->getObjetivos();
		foreach ($obj as $key => $value) {
			if($value["tipo"]==0)
				$value["objetivo_quant"] = $value["objetivo_quant"]*60 + atual_segundo();
			else if($value["tipo"]==1)
				$value["objetivo_quant"] = 0;
			
			$bd->query(
				"INSERT INTO tb_mis_missao_andamento ".
				"(missao_id, tripulacao_id, tipo, objetivo_id, objetivo_quant) ".
				"VALUES ".
				"(':0:',':1:',':2:',':3:',':4:')",
				array(
					$m->id,
					Usuario::$tripAtiva,
					$value["tipo"],
					$value["objetivo_id"],
					$value["objetivo_quant"]
				),
				array(
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
				)
			);
		}
		Usuario::$inMissao[] = array(
			"missao_id" => $m->id,
			"tripulacao_id" => Usuario::$tripAtiva,
			"tipo" => $value["tipo"],
			"objetivo_id" => $value["objetivo_id"],
			"objetivo_quant" => $value["objetivo_quant"]
		);
		
		$conteudo["mensagem"] = "Missão iniciada!<br><br>".$m->texto["and"];
		$sessao = "ilhaGeral";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	