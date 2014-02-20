<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		if(!isset($_GET["ilha"]) OR !isset($_GET["zona"]) OR !isset($_GET["conteudo"])){
			$conteudo["erro"] = "Está faltando dados";
			return;
		}
		$ilha = $_GET["ilha"];
		$zona = $_GET["zona"];
		$cont = $_GET["conteudo"];
		
		if($cont != "coleta" AND $cont != "portal" AND $cont != "mob"){
			$conteudo["erro"] = "Conteúdo inválido";
			return;
		}
		
		$list = $bd->fazArray(
			"SELECT * FROM tb_mun_ilha_zona_:0: ".
			"WHERE ilha_id=':1:' AND zona=':2:'",
			array(
				$cont,
				$ilha,
				$zona
			),
			array(
				STR_FORMAT,
				INT_FORMAT,
				INT_FORMAT
			)
		);
		$conteudo["retorno"] = $list;
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
