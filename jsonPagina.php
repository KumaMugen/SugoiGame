<?php
	if(Usuario::$logado && Usuario::$tripAtiva!=0 && !isset($exibeInfoGeral[0])){
		$conteudo["berries"] = round(Usuario::getTrip()->berries,2)."";
		$conteudo["gold"] = Usuario::$gold."";
		
		$conteudo["locate"] = getNomeMar(getMar(Usuario::getTrip()->getCoordAtual()))."<br>";
		if(Usuario::inIlha()!=0)
			$conteudo["locate"] .= getNomeIlha(Usuario::inIlha())." - ";
		$conteudo["locate"] .= formataCoord(Usuario::getTrip()->getCoordAtual());
		
		if(Usuario::inMissao()){
			$conteudo["missoes"] = Usuario::$missaoList;
		}
	}
	
	if(!isset($sessao)) return;
	
	if (!file_exists("Sessoes/".$sessao.".php")) $sessao = "404";
	
	include "menu.php";
	include "tripulantes.php";
	
	$conteudoCorpoTudo = array();
	$conteudoCorpo=array();
	$title = "";
	
	//verifica permissao a pagina
	$restricao = $bd->fazArray(
		"SELECT * FROM tb_sis_restricao_pagina WHERE pagina='p_:0:'",
		array($sessao)
	);
	$include = TRUE;
	if(sizeof($restricao) != 0){
		$restricao = $restricao[0];
		
		processaRestricoes($restricao, $include, $conteudo);
	}
	
	//se acesso autorizado, inclui
	if($include)
		include "Sessoes/$sessao.php";
	
	//monta base da pagina
	$conteudoCorpoTudo["conteudo-borda"] = e("DIV","id=conteudo-borda",array(
		e("DIV","id=conteudo-container",array(
			e("DIV","id=$sessao",$conteudoCorpo),
			e("DIV","id=menu-lateral",array())
		))
	));
	
	//formata o nome da pagina
	unset($_GET["sessao"]);
	unset($_GET["_"]);
	foreach ($_GET as $key => $value) {
		if(preg_match(STR_FORMAT, $key) && preg_match(STR_FORMAT, $value))
			$sessao.="&".$key."=".$value;
	}
	
	//constroi o objeto json
	$conteudo["pagina"] = array(
		"nome" => $sessao,
		"title" => $title,
		"menu" => getMenu(),
		"tripulantes" => getListaTripulantes(),
		"corpo" => $conteudoCorpoTudo,
		"bandeira" => getMenuBandeira(),
		"news" => getNews(),
		"background" => array(
			"img"=>Usuario::getImgBg(),
			"cor"=>Usuario::getCorBg(),
			"horario"=>date("H", time())
		)
	);