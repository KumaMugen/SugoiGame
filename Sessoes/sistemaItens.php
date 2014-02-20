<?php
	$title = "Itens";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaItens){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Itens");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("BUTTON","class=link_content","href=&ses=sistemaItensCadastro",array(texto("Cadastro de Itens"))),
		e("BUTTON","class=link_content","href=&ses=sistemaItensListagem",array(texto("Listagem de Itens"))),
		e("BR"),
		e("BUTTON","class=link_content","href=&ses=sistemaEquipamentosCadastro",array(texto("Cadastro de Equipamentos"))),
		e("BUTTON","class=link_content","href=&ses=sistemaEquipamentosListagem",array(texto("Listagem de Equipamentos")))
	));