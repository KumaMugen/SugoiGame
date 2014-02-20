<?php
	require "config.php";

	if(!isset($_GET["sessao"]) OR !preg_match("/^[\w]+$/", $_GET["sessao"])) $sessao = "404";
	else $sessao = $_GET["sessao"];
	
	include "jsonPagina.php";
	
	$conteudo["time"] = $erro->getExecutionTime();
	$conteudo["M"] = memory_get_peak_usage(true)/1024;
	
	echo json_encode($conteudo);
?>