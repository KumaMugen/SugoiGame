<?php
	//fundo da ilha
	$fundo =  Usuario::inIlha();
	$fundo = $bd->fazArray("SELECT interno FROM tb_mun_ilha WHERE ilha_id='$fundo'");
	$fundo = $fundo[0]["interno"];
	
	//horario do dia
	$hora = date("H", time());
	if($hora>=6 && $hora<=18) $hora = "dia";
	else $hora = "noite";
	
	//aliança chefe
	$lider = $bd->fazArray("SELECT * FROM tb_mun_ilha_lider WHERE ilha_id='".Usuario::inIlha()."'");
	if(sizeof($lider)!=0){
		if($lider[0]["alianca_id"]==0){
			$lider = "GM.png";
			$liderTitle = "Esta ilha está sob o controle do Governo Mundial e não pode ser conquistada por jogadores.";
		}
	}
	else{
		$lider = "disputavel.jpg";
		$liderTitle = "Esta ilha não possui uma Aliança ou Frota controladora.";
	}
	
	//Pega os edificios da ilha
	$edificios = $bd->fazArray(
		"SELECT * FROM tb_mun_ilha_edificio ".
		"INNER JOIN tb_mun_edificio ".
		"ON tb_mun_ilha_edificio.edificio_id = tb_mun_edificio.edificio_id ".
		"WHERE tb_mun_ilha_edificio.ilha_id='".Usuario::inIlha()."'"
	);
	
	//prepara edificios pra montar
	$e=array();
	foreach ($edificios as $key => $value) {
		$quest = "none";
		try{
			$npc = new NPC($value["npc_id"]);
			
			$mis = $npc->getMissoes();
			
			$quantMissoes = sizeof($mis);
			$quantMissoesAndamento = 0;
			
			foreach ($mis as $key2 => $value2) {
				if($value2["status"]==2)$quest = "completa";
				else if($value2["status"]!=0)$quantMissoesAndamento++;
			}
			if($quantMissoesAndamento!=$quantMissoes AND $quest!="completa")$quest = "disponivel";
		}
		catch(NotFoundException $i){
			
		}
		$e[$key]=e("DIV","class=edificio link_content contem-hover edificio-".$value["img"]." slot-".$value["coordenada"],
		"lvl=".$value["lvl"],"href=?ses=npc&n=".$value["npc_id"],array(
			e("DIV","class=quest-".$quest),
			e("DIV","class=hover edificio-info",array(
				e("P",array(texto("<b>".$value["nome"]."</b> nível ".$value["lvl"]))),
				e("P",array(texto($value["descricao"])))
			))
		));
	}
	$e["alianca"] = e("DIV","class=alianca",array(
		e("IMG","src=Imagens/Bandeiras/Aliancas/".$lider,"title=".$liderTitle)
	));
	$e["saida"] = e("a","class=saida link_send","href=ilhaSair",array(
		e("IMG","src=Imagens/Ilhas/Portal.png","title=Saída")
	));
	
	//monta a ilha
	$conteudoCorpo["ilha"] = e("DIV",array(
		"i" => e("DIV","class=ilha ilha-".$fundo,"style=background: url(Imagens/".$hora."/Ilhas/".$fundo.".jpg)",$e)
	));