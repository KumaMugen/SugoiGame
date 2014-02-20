<?php
	$ilha = $bd->fazArray(
		"SELECT * FROM tb_mun_ilha WHERE ilha_id='".Usuario::inIlha()."'"
	);
	$bg = "Imagens/Ilhas/".$ilha[0]["externo"]."/".Usuario::getTrip()->coord["zona"].".jpg";
	
	$pvp = $bd->fazArray(
		"SELECT * FROM tb_mun_ilha_zona_pvp ".
		"WHERE ilha_id='".Usuario::inIlha()."' AND zona='".Usuario::getTrip()->coord["zona"]."'"
	);
	
	if(sizeof($pvp)>0)
		$conteudoCorpo["pvp"] = e("DIV","id=ilha-zona-pvp",array(texto("Área PvP")));
	
	$conteudoCorpo["visao"] = e("DIV","id=ilha-externo",array(
		e("DIV","id=ilha-externo-mapa","style=background: url($bg)",array(
			
		)),
		e("DIV","id=ilha-externo-lateral",array(
			e("DIV","class=superior",array(
				e("DIV","id=msg-superior")
			)),
			e("DIV","class=inferior",array(
				e("DIV","id=msg-inferior")
			))
		)),
		e("DIV","class=clear")
	));
	
	$conteudo["evento"] = "ilhaExternoJogador();";
