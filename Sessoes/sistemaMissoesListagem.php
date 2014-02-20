<?php
	$title = "Missoes";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaMissoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Missoes - Listagem");
	
	$missoes = $bd->fazArray(
		"SELECT * FROM tb_mis_missao"
	);
	$e = array("t"=>e("TABLE","class=tabela",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Nome"))),
			e("TD","title=0-Ilha Específica; 1-East; 2-North; 3-South; 4-West; 5-GL; 6-NW; 7-All Blues; 8-todos",
				array(texto("Mar"))),
			e("TD",array(texto("T. Exc."))),
			e("TD",array(texto("Inicio_P"))),
			e("TD",array(texto("Andamento_P"))),
			e("TD",array(texto("Conclusao_P"))),
			e("TD",array(texto("Inicio_M"))),
			e("TD",array(texto("Andamento_M"))),
			e("TD",array(texto("Conclusao_M"))),
			e("TD",array(texto("Facção"))),
			e("TD",array(texto("Req. lvl"))),
			e("TD",array(texto("Req. Missão"))),
			e("TD",array(texto("Reco. XP"))),
			e("TD",array(texto("Reco. Berries"))),
			e("TD",array(texto("Objetivos"))),
			e("TD",array(texto("NPC Inicio"))),
			e("TD",array(texto("NPC Conclusao"))),
			e("TD",array(texto("Reco. Itens"))),
			e("TD",array(texto("Reco. Equips"))),
			e("TD",array(texto(" ")))
		))
	)));
	foreach ($missoes as $key => $value) {
		$missao = new Missao($value["missao_id"]);
		$ob = $missao->getObjetivos();
		$npcI = $missao->getNPCInicio();
		$npcC = $missao->getNPCConclusao();
		$recopI = $missao->getRecompensaItens();
		$recopE = $missao->getRecompensaEquipamentos();
		
		$o = array();
		foreach ($ob as $key => $value2) {
			$o[] = e("OPTION",array(texto($value2["tipo"]."-".$value2["objetivo_id"]."-".$value2["objetivo_quant"])));
		}
		$ni = array();
		foreach ($npcI as $key => $value2) {
			$ni[] = e("OPTION",array(texto($value2["npc_id"]."-".$value2["ilha_id"])));
		}
		$nc = array();
		foreach ($npcC as $key => $value2) {
			$nc[] = e("OPTION",array(texto($value2["npc_id"]."-".$value2["ilha_id"])));
		}
		$ri = array();
		foreach ($recopI as $key => $value2) {
			$ri[] = e("OPTION",array(texto($value2["item_id"])));
		}
		$re = array();
		foreach ($recopE as $key => $value2) {
			$re[] = e("OPTION",array(texto($value2["equipamento_id"])));
		}
		
		$e["t"]["c"][] = e("TR",array(
			e("TD",array(texto($missao->id))),
			e("TD",array(texto($missao->nome))),
			e("TD",array(texto($value["mar_inicio"]))),
			e("TD",array(texto(($value["is_texto_exclusivo"])?"Sim":"Não"))),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["texto_P_iniciacao"])))
			)),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["texto_P_andamento"])))
			)),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["texto_P_conclusao"])))
			)),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["texto_M_iniciacao"])))
			)),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["texto_M_andamento"])))
			)),
			e("TD",array(
				e("DIV","style=height:60px;overflow:auto;",array(texto($value["texto_M_conclusao"])))
			)),
			e("TD",array(texto($value["requisito_faccao"]))),
			e("TD",array(texto($value["requisito_lvl"]))),
			e("TD",array(texto($value["requisito_missao"]))),
			e("TD",array(texto($value["recompensa_xp"]))),
			e("TD",array(texto($value["recompensa_berries"]))),
			e("TD",array(e("SELECT",$o))),
			e("TD",array(e("SELECT",$ni))),
			e("TD",array(e("SELECT",$nc))),
			e("TD",array(e("SELECT",$ri))),
			e("TD",array(e("SELECT",$re))),
			e("TD",array(
				e("A","href=?ses=sistemaMissaoEdicao&missao_id=".$missao->id,"class=link_content",array(
					e("IMG","src=Imagens/Icones/oficina.png")
				))
			))
		));
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($e,"100%","box-interna")
	));