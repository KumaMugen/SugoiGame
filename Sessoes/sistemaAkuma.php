<?php
	$title = "Akuma no Mi";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaAkuma){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Akuma no Mi");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("BUTTON","class=link_content","href=&ses=sistemaAkumaCadastro",array(texto("Cadastro"))),
		e("BUTTON","class=link_content","href=&ses=sistemaAkumaListagem",array(texto("Listagem")))
	));