<?php
	$title = "Itens";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaItens){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Itens - Cadastro");
	$f["f"] = e("DIV","style=margin-bottom: 20px",array(
		e("FORM","class=form","action=sisEquipamentoCadastrar",array(
			texto("Slot:"),
			e("SELECT","class=form-input","name=slot",array(
				e("OPTION","value=1",array(texto("Capacete"))),
				e("OPTION","value=2",array(texto("Colete"))),
				e("OPTION","value=3",array(texto("Calças"))),
				e("OPTION","value=4",array(texto("Botas"))),
				e("OPTION","value=5",array(texto("Luvas"))),
				e("OPTION","value=6",array(texto("Capa"))),
				e("OPTION","value=7",array(texto("Arma de 1° mão"))),
				e("OPTION","value=8",array(texto("Item de 2° mão")))
			)),
			e("BR"),
			texto("Nome:"),
			e("INPUT","class=form-input","name=nome"),
			e("BR"),
			texto("Nível:"),
			e("INPUT","class=form-input","name=lvl"),
			e("BR"),
			texto("Descricao:"),
			e("TEXTAREA","class=form-input","name=descricao"),
			e("BR"),
			texto("Imagem:"),
			e("INPUT","class=form-input","name=img"),
			e("BR"),
			texto("Efeito:"),
			e("SELECT","class=form-input","name=tipo_efeito",array(
				e("OPTION","value=0",array(texto("Dano"))),
				e("OPTION","value=1",array(texto("Armadura")))
			)),
			e("BR"),
			texto("Categoria:"),
			e("SELECT","class=form-input","name=categoria",array(
				e("OPTION","value=0",array(texto("Nenhuma"))),
				e("OPTION","value=1",array(texto("Cinza"))),
				e("OPTION","value=2",array(texto("Branco"))),
				e("OPTION","value=3",array(texto("Verde"))),
				e("OPTION","value=4",array(texto("Azul"))),
				e("OPTION","value=5",array(texto("Preto"))),
				e("OPTION","value=6",array(texto("Dourado")))
			)),
			e("BR"),
			texto("Treino por lvl:"),
			e("INPUT","class=form-input","name=treino"),
			e("BR"),
			texto("Requisito Classe:"),
			e("SELECT","class=form-input","name=requisito_classe",array(
				e("OPTION","value=0",array(texto("Nenhuma"))),
				e("OPTION","value=1",array(texto("Espadachim"))),
				e("OPTION","value=2",array(texto("Lutador"))),
				e("OPTION","value=3",array(texto("Atirador")))
			)),
			e("BR"),
			texto("Preço:"),
			e("INPUT","class=form-input","name=preco"),
			e("BR"),
			texto("Negociável?"),
			e("SELECT","class=form-input","name=is_negociavel",array(
				e("OPTION","value=0",array(texto("Não"))),
				e("OPTION","value=1",array(texto("Sim")))
			)),
			e("BR"),
			texto("Armazenável?"),
			e("SELECT","class=form-input","name=is_armazenavel",array(
				e("OPTION","value=0",array(texto("Não"))),
				e("OPTION","value=1",array(texto("Sim")))
			)),
			e("BR"),
			e("BUTTON type=\"submit\"",array(texto("Cadastrar")))
		))
	));
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($f,"100%","box-interna"),
	));