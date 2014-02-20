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
		if($m->getStatus()!=1 ){
			return;
		}
		$bd->query(
			"DELETE FROM tb_mis_missao_andamento ".
			"WHERE tripulacao_id=':0:' ".
			"AND missao_id=':1:'",
			array(
				Usuario::$tripAtiva,
				$m->id
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		Usuario::$inMissao = FALSE;
		Usuario::$inRecrutamento = FALSE;
		$conteudo["mensagem"] = "Missão cancelada.";
		$sessao = "ilhaGeral";
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	