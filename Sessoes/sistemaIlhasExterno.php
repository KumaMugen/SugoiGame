<?php
	$title = "Missoes";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Lado Externo da Ilha");
	
	$ilhas = $bd->fazArray(
		"SELECT * FROM tb_mun_ilha"
	);
	$e = array();
	foreach ($ilhas as $key => $value) {
		$e[] = e("OPTION","value=".$value["externo"]."-".$value["ilha_id"],array(texto($value["nome"])));
	}
	
	$f = array();
	for($c = 1; $c<30; $c++) {
		$f[] = e("OPTION","value=".$c,array(texto($c)));
	}
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("DIV",array(
			e("SELECT","id=externo-select-ilha",$e),
			e("SELECT","id=externo-select-zona",$f),
			e("SELECT","id=externo-select-conteudo",array(
				e("OPTION","value=portal",array(texto("Portais"))),
				e("OPTION","value=coleta",array(texto("Itens"))),
				e("OPTION","value=mob",array(texto("Mobs")))
			)),
			e("BUTTON","id=ilha-externo-filtrar",array(texto("Confirmar")))
		)),
		e("DIV",array(
			e("DIV","id=ilha-externa-visao"),
			e("DIV","id=ilha-externa-editor",array(
				e("SPAN","id=externo-editor-coord"),
				e("BR"),
				e("SPAN","title=item_id/zona_destino/DELETE",array(texto("Atributo 1: "))),
				e("INPUT","id=externo-editor-atributo1"),
				e("BR"),
				e("SPAN","title=tempo_respawn/coordenada_destino/DELETE",array(texto("Atributo 2: "))),
				e("INPUT","id=externo-editor-atributo2"),
				e("BR"),
				e("SPAN","title=requisito_profissao/-/DELETE",array(texto("Atributo 3: "))),
				e("INPUT","id=externo-editor-atributo3"),
				e("BR"),
				e("BR"),
				e("BUTTON","id=externo-editor-bt-alterar",array(texto("Confirmar")))
			))
		))
	));
	
	$conteudo["evento"] = "ilhaExterno();";
