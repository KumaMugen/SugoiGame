<?php
	try{
		if(!isset($_GET["id"])){
			$conteudo["erro"] = getErroFormularioIncompleto();
			return;
		}
		if(!preg_match(INT_FORMAT,$_GET["id"])){
			$conteudo["erro"] = getErroInformacaoInvalida("id");
			return;
		}
		
		$item = $bd->fazArray(
			"SELECT * FROM tb_itn_item ".
			"WHERE item_id=':0:'",
			array(
				$_GET["id"]
			),
			array(
				INT_FORMAT
			)
		);
		
		$conteudo["retorno"] = $item[0];
		$exibeInfoGeral[0] = 0;
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }