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
		e("FORM","class=form","action=sisItemCadastrar",array(
			texto("Tipo:"),
			e("SELECT","class=form-input","name=tipo",array(
				e("OPTION","value=0",array(texto("Acessório"))),
				e("OPTION","value=1",array(texto("Comida"))),
				e("OPTION","value=2",array(texto("Remédio"))),
				e("OPTION","value=3",array(texto("Material"))),
				e("OPTION","value=4",array(texto("Consumível"))),
				e("OPTION","value=5",array(texto("Akuma")))
			)),
			e("BR"),
			texto("Nome:"),
			e("INPUT","class=form-input","name=nome"),
			e("BR"),
			texto("Descricao:"),
			e("TEXTAREA","class=form-input","name=descricao"),
			e("BR"),
			texto("Nível:"),
			e("INPUT","class=form-input","name=lvl"),
			e("BR"),
			texto("Imagem:"),
			e("INPUT","class=form-input","name=img"),
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
			texto("Consumível?"),
			e("SELECT","class=form-input","name=is_consumivel",array(
				e("OPTION","value=0",array(texto("Não"))),
				e("OPTION","value=1",array(texto("Sim")))
			)),
			e("BR"),
			texto("Descricao do efeito:"),
			e("TEXTAREA","class=form-input","name=descricao_efeito"),
			e("BR"),
			texto("HP Recuperado:"),
			e("INPUT","class=form-input","name=hp_recuperado"),
			e("BR"),
			texto("Energia Recuperada:"),
			e("INPUT","class=form-input","name=mp_recuperado"),
			e("BR"),
			texto("Ataque:"),
			e("INPUT","class=form-input","name=bonus_atk"),
			e("BR"),
			texto("Defesa:"),
			e("INPUT","class=form-input","name=bonus_def"),
			e("BR"),
			texto("Agilidade:"),
			e("INPUT","class=form-input","name=bonus_agl"),
			e("BR"),
			texto("Precisão:"),
			e("INPUT","class=form-input","name=bonus_pre"),
			e("BR"),
			texto("Resistência:"),
			e("INPUT","class=form-input","name=bonus_res"),
			e("BR"),
			texto("destreza:"),
			e("INPUT","class=form-input","name=bonus_des"),
			e("BR"),
			texto("Percepção:"),
			e("INPUT","class=form-input","name=bonus_per"),
			e("BR"),
			texto("Vitalidade:"),
			e("INPUT","class=form-input","name=bonus_vit"),
			e("BR"),
			texto("Preço:"),
			e("INPUT","class=form-input","name=preco"),
			e("BR"),
			texto("Script:"),
			e("INPUT","class=form-input","name=script"),
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