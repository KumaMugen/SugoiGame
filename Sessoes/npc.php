<?php
	$loadErro=FALSE;
	if(!isset($_GET["n"]) OR !preg_match(INT_FORMAT,$_GET["n"])){
		$conteudo["erro"] = "Você informou algo inválido";
		return;
	}
	try{
		$npc = new NPC($_GET["n"]);
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	if(!$npc->possivelFalar()){
		$conteudo["erro"] = "Você não pode conversar com esse NPC";
		return;
	}
	
	$title = $npc->nome;
	$conteudoCorpo = array();
	$conteudoCorpo["cabecalho"] = cabecalho($title);
	
	$e = array();
	$n = $npc->getFuncoes();
	foreach ($n as $key => $value) {
		$e[$key] = e("DIV","class=npc-funcao ".$value["tipo_link"],"href=".$value["link"],array(
			texto($value["funcao"])
		));
	}
	
	$f = array();
	$m = $npc->getMissoes();
	foreach ($m as $key => $value) {
		$f[$key] = e("DIV","class=npc-funcao npc-missao icon-cursor2",
		"missao_id=".$value["missao_id"],
		"texto_I=".$value["texto_I"],
		"texto_A=".$value["texto_A"],
		"texto_C=".$value["texto_C"],
		"status=".$value["status"],
		"r_xp=".($value["r_xp"]*RATE_XP),
		"r_berries=".($value["r_berries"]*RATE_BERRIES),
		"r_item=".json_encode($value["r_item"]),
		"r_equip=".json_encode($value["r_equip"]),
		array(
			e("IMG","src=Imagens/NPC/missao-".$value["status"].".png"),
			e("SPAM",array(texto($value["nome"])))
		));
	}
	
	$conteudoCorpo["content"] = e("DIV","id=npc-geral","style=background: url(Imagens/NPC/Fundo/".$npc->background.".jpg)",array(
		e("DIV","id=npc-img","style=background: url(Imagens/NPC/Corpo/".$npc->img.".png)"),
		e("DIV","id=npc-texto",array(
			e("P",array(texto($npc->texto))),
			e("DIV",$e),
			e("DIV",$f),
			e("DIV","class=bt-voltar",array(
				e("A","href=?ses=ilhaGeral","class=link_content",array(texto("Voltar")))
			))
		)),
		e("DIV","class=clear")
	));
	
	$conteudo["evento"] = "npc();";