<?php
	$title = "Sistema - Gerenciamento de Mapa";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Gerenciamento de Mapa");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("DIV","id=mapa"),
		e("DIV","id=info",array(
			e("DIV","class=sup",array(
				e("SELECT","id=select-modo",array(
					e("OPTION","value=navegavel",array(texto("Navegável"))),
					e("OPTION","value=corrente",array(texto("Correntes"))),
					e("OPTION","value=vento",array(texto("Ventos"))),
					e("OPTION","value=dano",array(texto("Dano"))),
					e("OPTION","value=zona_pve",array(texto("PvE"))),
					e("OPTION","value=zona_mergulho",array(texto("Mergulho")))
				)),
				e("DIV","style=margin:25px 0",array(
					e("A","class=to-top","mod=1","style=display:block",array(texto("P Cima"))),
					e("A","class=to-top","mod=10","style=display:block",array(texto("+10 P Cima"))),
					e("A","class=to-left","mod=1","style=display:block",array(texto("P Esquerda"))),
					e("A","class=to-left","mod=10","style=display:block",array(texto("+10 P Esquerda"))),
					e("A","class=to-right","mod=1","style=display:block",array(texto("P Direita"))),
					e("A","class=to-right","mod=10","style=display:block",array(texto("+10 P Direita"))),
					e("A","class=to-down","mod=1","style=display:block",array(texto("P Baixo"))),
					e("A","class=to-down","mod=10","style=display:block",array(texto("+10 P Baixo")))
				))
			)),
			e("DIV","class=inf",array(
				e("TEXTAREA","id=coordenadas","style=height: 250px;width: 300px;"),
				e("BUTTON","id=setNavegavel","style=width: 180px;",array(texto("Navegável"))),
				e("BUTTON","id=setNaoNavegavel","style=width: 180px;",array(texto("Não Navegável")))
			))
		)),
		e("DIV","class=clear")
	));
	
	$conteudo["evento"] = "sistemaMundi();";