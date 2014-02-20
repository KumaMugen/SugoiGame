<?php
	$title = "NPC's";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaNPC){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - NPC - Cadastro");
	$f["f"] = e("DIV","style=margin-bottom: 20px",array(
		e("FORM","class=form","action=sisNPCCadastrar",array(
			texto("Nome:"),
			e("INPUT","class=form-input","name=nome"),
			e("BR"),
			texto("Disponível para ilhas:"),
			e("SELECT","class=form-input","name=is_mar",array(
				e("OPTION","value=0",array(texto("Apenas Ilhas específicas"))),
				e("OPTION","value=1",array(texto("Todas as Ilhas do East Blue"))),
				e("OPTION","value=2",array(texto("Todas as Ilhas do North Blue"))),
				e("OPTION","value=3",array(texto("Todas as Ilhas do South Blue"))),
				e("OPTION","value=4",array(texto("Todas as Ilhas do West Blue"))),
				e("OPTION","value=5",array(texto("Todas as Ilhas da Grand Line"))),
				e("OPTION","value=6",array(texto("Todas as Ilhas do Novo Mundo"))),
				e("OPTION","value=7",array(texto("Todas as Ilhas de todos os Blues"))),
				e("OPTION","value=8",array(texto("Todas as Ilhas")))
			)),
			e("BR"),
			texto("Coordenada:"),
			e("INPUT","class=form-input","name=coordenada"),
			e("BR"),
			texto("Img:"),
			e("INPUT","class=form-input","name=img"),
			e("BR"),
			texto("Background:"),
			e("INPUT","class=form-input","name=background"),
			e("BR"),
			texto("Vende itens?"),
			e("SELECT","class=form-input","name=is_vende",array(
				e("OPTION","value=0",array(texto("Não"))),
				e("OPTION","value=1",array(texto("Sim")))
			)),
			e("BR"),
			texto("Compra itens?"),
			e("SELECT","class=form-input","name=is_compra",array(
				e("OPTION","value=0",array(texto("Não"))),
				e("OPTION","value=1",array(texto("Sim")))
			)),
			e("BR"),
			texto("Texto Padrão:"),
			e("TEXTAREA","class=form-input","name=texto"),
			e("BR"),
			e("BUTTON type=\"submit\"",array(texto("Cadastrar")))
		))
	));
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($f,"100%","box-interna"),
	));