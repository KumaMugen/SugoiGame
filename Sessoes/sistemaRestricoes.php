<?php
	$title = "Sistema - Restrições de Páginas";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaRestricoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Restrições de Páginas");
	
	$restricoes = $bd->fazArray("SELECT * FROM tb_sis_restricao_pagina");
	
	
	$e = array("t"=>e("TABLE","class=tabela", "style=margin: auto;",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("Página"))),
			e("TD",array(texto("Logado"))),
			e("TD",array(texto("Tripulação"))),
			e("TD",array(texto("Combate"))),
			e("TD",array(texto("Ilha"))),
			e("TD",array(texto("Navio"))),
			e("TD",array(texto("Missao"))),
			e("TD",array(texto("Recrutamento"))),
			e("TD",array(texto("Rota"))),
			e("TD",array(texto("Derrotado")))
		))
	)));
	
	foreach ($restricoes as $key => $value) {
		$e["t"]["c"][] = e("TR", array(
			e("TD",array(texto($value["pagina"]))),
			e("TD",array(texto($value["logado"]))),
			e("TD",array(texto($value["tripativa"]))),
			e("TD",array(texto($value["combate"]))),
			e("TD",array(texto($value["ilha"]))),
			e("TD",array(texto($value["navio"]))),
			e("TD",array(texto($value["missao"]))),
			e("TD",array(texto($value["recrutamento"]))),
			e("TD",array(texto($value["rota"]))),
			e("TD",array(texto($value["derrotado"]))),
			e("TD",array(
				e("A","href=sisRestricoesRemover&pagina=".$value["pagina"],"class=link_send",array(
					e("IMG","src=Imagens/Icones/X.png")
				))
			))
		));
	}
	
	$f = array("t"=>e("FORM","class=form","action=sisRestricoesAdicionar",array(
		e("INPUT","class=form-input","minlenght=5","name=pagina"),
		e("BR"),
		e("SELECT","class=form-input","name=logado",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=0",array(texto("Deslogado - 0"))),
			e("OPTION","value=1",array(texto("Logado - 1")))
		)),
		e("SELECT","class=form-input","name=tripativa",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Trip Selecionada - 1"))),
			e("OPTION","value=0",array(texto("Trip ñ Selecionada - 0")))
		)),
		e("SELECT","class=form-input","name=combate",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Em Combate - 1"))),
			e("OPTION","value=0",array(texto("Fora de Combate - 0")))
		)),
		e("SELECT","class=form-input","name=ilha",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Em Ilha - 1"))),
			e("OPTION","value=0",array(texto("Fora de Ilha - 0")))
		)),
		e("SELECT","class=form-input","name=navio",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Em Navio - 1"))),
			e("OPTION","value=0",array(texto("Fora de Navio - 0")))
		)),
		e("SELECT","class=form-input","name=missao",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Em Missão - 1"))),
			e("OPTION","value=0",array(texto("Fora de Missão - 0")))
		)),
		e("SELECT","class=form-input","name=recrutamento",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Em Recrutamento - 1"))),
			e("OPTION","value=0",array(texto("Fora de Recrutamento - 0")))
		)),
		e("SELECT","class=form-input","name=rota",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Navegando - 1"))),
			e("OPTION","value=0",array(texto("Ñ Navegando - 0")))
		)),
		e("SELECT","class=form-input","name=derrotado",array(
			e("OPTION","value=2",array(texto("Ambos - 2"))),
			e("OPTION","value=1",array(texto("Derrotado - 0"))),
			e("OPTION","value=0",array(texto("Ñ Derrotado - 1")))
		)),
		e("BR"),
		e("BUTTON type=\"Submit\"",array(texto("Cadastrar"))),
	)));
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($f,"100%","box-interna"),
		box($e,"100%","box-interna")
	));