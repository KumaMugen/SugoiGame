<?php
	require "config.php";
	
	//verifica existencia de script
	if(!isset($_GET["script"]) OR empty($_GET["script"]) OR !preg_match("/^[\w]+$/", $_GET["script"])) $script = "404";
	else $script = strip_tags(htmlspecialchars($_GET["script"]));
	if (!file_exists("Scripts/".$script.".php")) $script = "404";
	
	//verifica acesso a pagina
	$restricao = $bd->fazArray(
		"SELECT * FROM tb_sis_restricao_pagina WHERE pagina='s_:0:'",
		array($script),
		array(STR_FORMAT)
	);
	$include = TRUE;
	if(sizeof($restricao) != 0){
		$restricao = $restricao[0];
		processaRestricoes($restricao, $include, $_SESSION["erros"]);
	}
	
	//se acesso autorizado, inclui
	if($include)
		include "Scripts/$script.php";