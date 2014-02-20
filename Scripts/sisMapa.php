<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	if(!isset($_GET["x"]) OR !isset($_GET["y"]) OR
	!preg_match(INT_FORMAT,$_GET["x"]) OR !preg_match(INT_FORMAT,$_GET["y"])){
		$x = 1;
		$y = 1;
	}
	else{
		$x = $_GET["x"];
		$y = $_GET["y"];
	}
	
	if($y<0)$y=60;
	if($y>60)$y=1;
	if($x<0)$x=300;
	if($x>300)$x=0;
	
	if(!isset($_GET["tipo"]) OR !preg_match(STR_FORMAT,$_GET["tipo"]))
		$tipo = "naonavegavel";
	else 
		$tipo = $_GET["tipo"];
	
	$mapa = new Mapa();
	
	$conteudo["retorno"]["coords"] = $mapa->getVisao($tipo, $x."_".$y, 5);
