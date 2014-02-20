<?php
	$title = "Itens";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaItens){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Itens - Listagem");
	
	$npc = $bd->fazArray(
		"SELECT * FROM tb_itn_item"
	);
	$e = array("t"=>e("TABLE","class=tabela",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Img"))),
			e("TD",array(texto("Nome"))),
			e("TD","title=0-Acessório; 1-Comida; 2-Remédio; 3-Material; 4-Consumível; 5-Akuma",
				array(texto("Tipo"))),
			e("TD",array(texto("Descricao"))),
			e("TD",array(texto("lvl"))),
			e("TD",array(texto("Categoria"))),
			e("TD",array(texto("Cons."))),
			e("TD",array(texto("Descrição de efeito"))),
			e("TD",array(texto("HP Rec."))),
			e("TD",array(texto("Ener. Rec."))),
			e("TD",array(texto("Ataque"))),
			e("TD",array(texto("Defesa"))),
			e("TD",array(texto("Agilidade"))),
			e("TD",array(texto("Precisao"))),
			e("TD",array(texto("Resistência"))),
			e("TD",array(texto("Destreza"))),
			e("TD",array(texto("Percepção"))),
			e("TD",array(texto("Vitalidade"))),
			e("TD",array(texto("Preço"))),
			e("TD",array(texto("Script"))),
			e("TD",array(texto("Negociável"))),
			e("TD",array(texto("Armazenável"))),
			e("TD",array(texto(" ")))
		))
	)));
	foreach ($npc as $key => $value) {
		$e["t"]["c"][] = e("TR",array(
			e("TD",array(texto($value["item_id"]))),
			e("TD",array(
				e("IMG","src=Imagens/Itens/".$value["img"].".png")
			)),
			e("TD",array(texto($value["nome"]))),
			e("TD",array(texto($value["tipo"]))),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["descricao"])))
			)),
			e("TD",array(texto($value["lvl"]))),
			e("TD",array(texto($value["categoria"]))),
			e("TD",array(texto($value["is_consumivel"]))),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["descricao_efeito"])))
			)),
			e("TD",array(texto($value["hp_recuperado"]))),
			e("TD",array(texto($value["mp_recuperado"]))),
			e("TD",array(texto($value["bonus_atk"]))),
			e("TD",array(texto($value["bonus_def"]))),
			e("TD",array(texto($value["bonus_agl"]))),
			e("TD",array(texto($value["bonus_pre"]))),
			e("TD",array(texto($value["bonus_res"]))),
			e("TD",array(texto($value["bonus_des"]))),
			e("TD",array(texto($value["bonus_per"]))),
			e("TD",array(texto($value["bonus_vit"]))),
			e("TD",array(texto($value["preco"]))),
			e("TD",array(texto($value["script"]))),
			e("TD",array(texto($value["is_negociavel"]))),
			e("TD",array(texto($value["is_armazenavel"]))),
			e("TD",array(
				e("A","href=?ses=sistemaItemEdicao&item_id=".$value["item_id"],"class=link_content",array(
					e("IMG","src=Imagens/Icones/oficina.png")
				))
			))
		));
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($e,"100%","box-interna")
	));