<?php
	$title = "Dojô - Classes";
	$conteudoCorpo = array();
	
	include "Sessoes/Menus/ct.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Dojô - Classes");
	
	$tripulantes = Usuario::getTrip()->getTripulantes();
	
	if(isset($_GET["sel"]))$selecionado = $_GET["sel"];
	else $selecionado = $tripulantes[0]->id;
	
	$conteudoCorpo["tripulantes"] = e("DIV",array(
		"select" => getPersonagemSeletor($tripulantes,$selecionado,"ctClasses")
	));
	$info = e("DIV","class=personagem-info",array());
	foreach ($tripulantes as $key => $value) {
			$info["c"][$key] = e("DIV","class=personagem".(($selecionado==$value->id)?" personagem-selecionado":""),"id=layer-personagem-".$value->id);
	}
	$conteudoCorpo["tripulantes"]["c"]["info"] = $info;
	
	$conteudo["evento"] = "addSeletorPersonagem();";