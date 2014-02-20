<?php
	$title = "Akuma no Mi - Listagem";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaAkuma){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Akuma no Mi - Listagem");
	
	$akumas = $bd->fazArray(
		"SELECT akuma_id FROM tb_akm_akuma"
	);
	$e = array("t"=>e("TABLE","class=tabela",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Img"))),
			e("TD",array(texto("Akuma"))),
			e("TD",array(texto("Descrição"))),
			e("TD",array(texto("Tipo"))),
			e("TD",array(texto("Categoria"))),
			e("TD",array(texto("At."))),
			e("TD",array(texto("Bf."))),
			e("TD",array(texto("Ps."))),
			e("TD",array(texto("Rar."))),
			e("TD",array(texto("Efe."))),
			e("TD",array(texto("Alt.")))
		))
	)));
	foreach ($akumas as $key => $value) {
		$akuma = new Akuma($value["akuma_id"]);
		$e["t"]["c"][] = e("TR",array(
			e("TD",array(texto($akuma->id))),
			e("TD",array(e("IMG","src=".$akuma->getImgLink()))),
			e("TD",array(texto($akuma->nome))),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($akuma->descricao)))
			)),
			e("TD",array(texto($akuma->getTipo()))),
			e("TD",array(texto($akuma->getCategoria()))),
			e("TD",array(texto($akuma->qntAtaques))),
			e("TD",array(texto($akuma->qntBuffs))),
			e("TD",array(texto($akuma->qntPassivas))),
			e("TD",array(texto($akuma->raridade))),
			e("TD",array(texto($akuma->efetividade))),
			e("TD",array(
				e("A","href=?ses=sistemaAkumaEdicao&akuma_id=".$akuma->id,"class=link_content",array(
					e("IMG","src=Imagens/Icones/oficina.png")
				))
			))
		));
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($e,"100%","box-interna")
	));
