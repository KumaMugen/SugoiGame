<?php
	try{
		if(!isset($_GET["tipo"])){
			$conteudo["erro"] = getErroFormularioIncompleto();
			return;
		}
		
		$t = $_GET["tipo"];
		
		if(!preg_match(INT_FORMAT, $t)
		OR ($t != 0 AND $t != 1)){
			$conteudo["erro"] = getErroInformacaoInvalida();
			return;
		}
		
		if($t==0)$tb = "item";
		else $tb = "equipamento";
		
		$conteudo["retorno"]["itens"] = Usuario::getTrip()->getItens($tb);
		$conteudo["retorno"]["info"] =  Usuario::getTrip()->getCarga()."/".Usuario::getTrip()->getCapCarga();
		
		$exibeInfoGeral[0] = 0;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}