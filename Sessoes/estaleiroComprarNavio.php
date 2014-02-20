<?php
	$title = "Navio";
	$conteudoCorpo = array();
	
	$conteudoCorpo["cabecalho"] = cabecalho("Navio");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("IMG","src=Imagens/Bandeiras/NaviosG/".Usuario::$faccao.".png"),
		e("DIV",array(texto("10.000,00 "),e("IMG","src=Imagens/Icones/Berries.png"))),
		e("BUTTON",
		"href=estComprarNavio",
		"class=link_".
			((Usuario::getTrip()->berries>=10000 && !Usuario::getTrip()->getNavio())?"":"no_")
		."send_confirm",
		"question=Deseja comprar este navio?",
		array(texto("Comprar"))),
		e("BUTTON","class=link_content","href=?ses=npc&n=1",array(texto("Cancelar")))
	));
