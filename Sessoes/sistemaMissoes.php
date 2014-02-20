<?php
	$title = "Missoes";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaMissoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Missoes");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("BUTTON","class=link_content","href=&ses=sistemaMissoesCadastro",array(texto("Cadastro de Missões"))),
		e("BUTTON","class=link_content","href=&ses=sistemaMissoesListagem",array(texto("Listagem de Missões"))),
		e("BR"),
		e("BR"),
		e("BUTTON","class=link_content","href=&ses=sistemaNPCCadastro",array(texto("Cadastro de NPC's"))),
		e("BUTTON","class=link_content","href=&ses=sistemaNPCListagem",array(texto("Listagem de NPC's")))
	));