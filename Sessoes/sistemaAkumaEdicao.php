<?php
	$title = "Akuma no Mi - Edição";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaAkuma){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Akuma no Mi - Edição");
	
	$invalid = FALSE;
	if(!isset($_GET["missao_id"]))
		$invalid = TRUE;
	
	try{
		$akuma = new Akuma($_GET["akuma_id"]);
	}
	catch(NotFoundException $i){
		$invalid = TRUE;
	}
	
	if($invalid){
		$conteudoCorpo["corpo"] = e("DIV",array(texto("Id inválida")));
		return;
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("FORM","action=runRedir.php?script=sisAkumaEditar","method=POST",array(
			e("INPUT","name=akuma_id","value=".$akuma->id,"class=no-display"),
			e("TABLE","style=margin:auto;","class=tabela",array(
				e("TR",array(
					e("TD",array(texto("Imagem:"))),
					e("TD",array(
						e("INPUT","name=img","value=".$akuma->img)
					))
				)),
				e("TR",array(
					e("TD",array(texto("Nome:"))),
					e("TD",array(
						e("INPUT","name=nome","value=".$akuma->nome)
					))
				)),
				e("TR",array(
					e("TD",array(texto("Descrição:"))),
					e("TD",array(
						e("TEXTAREA","name=descricao",array(texto($akuma->descricao)))
					))
				)),
				e("TR",array(
					e("TD",array(texto("Tipo:"))),
					e("TD",array(
						e("SELECT","name=tipo",array(
							e("OPTION","value=1",array(texto("Paramecia"))),
							e("OPTION","value=2",array(texto("Zoan"))),
							e("OPTION","value=3",array(texto("Logia")))
						))
					))
				)),
				e("TR",array(
					e("TD",array(texto("Categoria:"))),
					e("TD",array(
						e("SELECT","name=categoria",array(
							e("OPTION","value=0",array(texto("Neutra"))),
							e("OPTION","value=1",array(texto("Mística")))
						))
					))
				)),
				e("TR",array(
					e("TD",array(texto("Ataques:"))),
					e("TD",array(
						e("INPUT","name=ataques","value=".$akuma->qntAtaques)
					))
				)),
				e("TR",array(
					e("TD",array(texto("Buffs:"))),
					e("TD",array(
						e("INPUT","name=buffs","value=".$akuma->qntBuffs)
					))
				)),
				e("TR",array(
					e("TD",array(texto("Passivas:"))),
					e("TD",array(
						e("INPUT","name=passivas","value=".$akuma->qntPassivas)
					))
				)),
				e("TR",array(
					e("TD",array(texto("Raridade:"))),
					e("TD",array(
						e("INPUT","name=raridade","value=".$akuma->raridade)
					))
				)),
				e("TR",array(
					e("TD",array(texto("Efetividade:"))),
					e("TD",array(
						e("INPUT","name=efetividade","value=".$akuma->efetividade)
					))
				))
			)),
			e("BUTTON type=submit",array(texto("Editar"))),
			e("BUTTON type=reset",array(texto("Limpar")))
		))
	));