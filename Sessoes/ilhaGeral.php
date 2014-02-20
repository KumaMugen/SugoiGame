<?php
	$title = "Ilha";
	$conteudoCorpo = array();
	
	$conteudoCorpo["cabecalho"] = cabecalho("Ilha Atual");
	
	//dentro da ilha
	if(Usuario::getTrip()->coord=="interno"){
		include "Includes/ilhaGeralInterno.php";
	}
	//fora da ilha
	else{
		include "Includes/ilhaGeralExterno.php";
	}

