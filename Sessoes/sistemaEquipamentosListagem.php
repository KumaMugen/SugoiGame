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
		"SELECT * FROM tb_itn_equipamento"
	);
	$e = array("t"=>e("TABLE","class=tabela",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Img"))),
			e("TD",array(texto("Nome"))),
			e("TD",array(texto("Descricao"))),
			e("TD","title=0-Acessório; 1-Comida; 2-Remédio; 3-Material; 4-Consumível; 5-Akuma",
				array(texto("Slot"))),
			e("TD",array(texto("Tipo de Efeito:"))),
			e("TD",array(texto("Categoria"))),
			e("TD",array(texto("lvl"))),
			e("TD",array(texto("Treino"))),
			e("TD",array(texto("Classe"))),
			e("TD",array(texto("Preço"))),
			e("TD",array(texto("Negociável"))),
			e("TD",array(texto("Armazenável"))),
			e("TD",array(texto(" ")))
		))
	)));
	foreach ($npc as $key => $value) {
		$e["t"]["c"][] = e("TR",array(
			e("TD",array(texto($value["equipamento_id"]))),
			e("TD",array(
				e("IMG","src=Imagens/Itens/".$value["img"].".png")
			)),
			e("TD",array(texto($value["nome"]))),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["descricao"])))
			)),
			e("TD",array(texto(getNomeSlotEquipamento($value["slot"])))),
			e("TD",array(texto(($value["tipo_efeito"]==0)?"Dano":"Armadura"))),
			e("TD",array(texto($value["categoria"]))),
			e("TD",array(texto($value["lvl"]))),
			e("TD",array(texto($value["treino"]))),
			e("TD",array(texto($value["requisito_classe"]))),
			e("TD",array(texto($value["preco"]))),
			e("TD",array(texto($value["is_negociavel"]))),
			e("TD",array(texto($value["is_armazenavel"]))),
			e("TD",array(
				e("A","href=?ses=sistemaEquipamentoEdicao&item_id=".$value["equipamento_id"],"class=link_content",array(
					e("IMG","src=Imagens/Icones/oficina.png")
				))
			))
		));
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($e,"100%","box-interna")
	));