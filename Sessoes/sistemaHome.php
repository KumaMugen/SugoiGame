<?php
	$title = "Sistema - Página Principal";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaHome){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Página Principal");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("DIV",array(
			texto("Contas cadastradas: ".$bd->getReg("tb_usr_conta"))
		)),
		e("DIV",array(
			texto("Personagens criados: ".$bd->getReg("tb_per_personagem"))
		)),
		e("DIV",array(
			texto("Contas cadastradas: ")
		)),
		e("DIV",array(
			texto("Personagens criados: ")
		)),
		e("DIV",array(
			texto("Personagens criados: ")
		)),
		e("DIV",array(
			texto("Personagens criados: ")
		)),
		e("DIV",array(
			texto("Personagens criados: ")
		)),
		e("DIV",array(
			texto("Personagens criados: ")
		))
	));
