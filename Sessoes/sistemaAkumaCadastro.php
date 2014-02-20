<?php
	$title = "Akuma no Mi - Cadastro";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaAkuma){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Akuma no Mi - Cadastro");
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		e("FORM","action=runRedir.php?script=sisAkumaCadastrar","method=POST",array(
			e("TABLE","style=margin:auto;","class=tabela",array(
				e("TR",array(
					e("TD",array(texto("Imagem:"))),
					e("TD",array(
						e("INPUT","name=img")
					))
				)),
				e("TR",array(
					e("TD",array(texto("Nome:"))),
					e("TD",array(
						e("INPUT","name=nome")
					))
				)),
				e("TR",array(
					e("TD",array(texto("Descrição:"))),
					e("TD",array(
						e("TEXTAREA","name=descricao")
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
						e("INPUT","name=ataques")
					))
				)),
				e("TR",array(
					e("TD",array(texto("Buffs:"))),
					e("TD",array(
						e("INPUT","name=buffs")
					))
				)),
				e("TR",array(
					e("TD",array(texto("Passivas:"))),
					e("TD",array(
						e("INPUT","name=passivas")
					))
				)),
				e("TR",array(
					e("TD",array(texto("Raridade:"))),
					e("TD",array(
						e("INPUT","name=raridade")
					))
				)),
				e("TR",array(
					e("TD",array(texto("Efetividade:"))),
					e("TD",array(
						e("INPUT","name=efetividade")
					))
				))
			)),
			e("BUTTON type=submit",array(texto("Cadastrar"))),
			e("BUTTON type=reset",array(texto("Limpar")))
		))
	));