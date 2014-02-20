<?php
	$title = "NPC";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaNPC){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - NPC - Listagem");
	
	$npc = $bd->fazArray(
		"SELECT * FROM tb_mun_npc"
	);
	$e = array("t"=>e("TABLE","class=tabela",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Nome"))),
			e("TD","title=0-Ilha Específica; 1-East; 2-North; 3-South; 4-West; 5-GL; 6-NW; 7-All Blues; 8-todos",
				array(texto("Mar"))),
			e("TD",array(texto("Coordenada"))),
			e("TD",array(texto("Img"))),
			e("TD",array(texto("Background"))),
			e("TD",array(texto("Texto Padrão"))),
			e("TD",array(texto("Compra itens?"))),
			e("TD",array(texto("Vende itens?"))),
			e("TD",array(texto(" ")))
		))
	)));
	foreach ($npc as $key => $value) {
		$e["t"]["c"][] = e("TR",array(
			e("TD",array(texto($value["npc_id"]))),
			e("TD",array(texto($value["nome"]))),
			e("TD",array(texto($value["is_mar"]))),
			e("TD",array(texto($value["coordenada"]))),
			e("TD",array(texto($value["img"]))),
			e("TD",array(texto($value["background"]))),
			e("TD",array(texto($value["texto"]))),
			e("TD",array(texto((($value["is_compra"]==1)?"sim":"não")))),
			e("TD",array(texto((($value["is_vende"]==1)?"sim":"não")))),
			e("TD",array(
				e("A","href=?ses=sistemaNPCEdicao&npc_id=".$value["npc_id"],"class=link_content",array(
					e("IMG","src=Imagens/Icones/oficina.png")
				))
			))
		));
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($e,"100%","box-interna")
	));