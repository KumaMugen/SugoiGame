<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	if(!isset($_GET["str"]) OR !isset($_GET["tipo"]) OR !preg_match(INT_FORMAT,$_GET["tipo"])){
		return;
	}
	
	$str = $_GET["str"];
	$tipo = $_GET["tipo"];
	
	$coords = explode(";", $str);
	$m = new Mapa();
	
	if($tipo==1)
		foreach ($coords as $key => $value) {
			if(!$m->is("naonavegavel", $value,FALSE)){
				$m->insere("naonavegavel", $value);
			}
		}
	else{
		foreach ($coords as $key => $value) {
			if($m->is("naonavegavel", $value)){
				$m->remove("naonavegavel", $value);
			}
		}
	}
