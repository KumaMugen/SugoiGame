<?php
	require "config.php";
	
	//verifica existencia de script
	if(!isset($_GET["script"]) OR !preg_match("/^[\w]+$/", $_GET["script"])) $script = "404";
	else $script = $_GET["script"];
	if (!file_exists("Scripts/".$script.".php")) $script = "404";
	
	$conteudo = array();
	$menuRealizacao = FALSE;
	
	//verifica permissao a pagina
	$restricao = $bd->fazArray(
		"SELECT * FROM tb_sis_restricao_pagina WHERE pagina='s_:0:'",
		array($script)
	);
	$include = TRUE;
	if(sizeof($restricao) != 0){
		$restricao = $restricao[0];
		
		processaRestricoes($restricao, $include, $conteudo);
	}
	
	//se acesso autorizado, inclui
	if($include)
		include "Scripts/$script.php";
	
	//se o script fizer chamada a uma pagina inclui o codigo para o objeto da pagina
	include "jsonPagina.php";
	
	$conteudo["time"] = $erro->getExecutionTime();
	$conteudo["M"] = memory_get_peak_usage(true) / 1024;
	
	echo json_encode($conteudo);