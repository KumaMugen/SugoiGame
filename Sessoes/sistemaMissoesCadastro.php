<?php
	$title = "Missoes";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaMissoes){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Missoes - Cadastro");
	$f["f"] = e("DIV","style=margin-bottom: 20px",array(
		e("FORM","class=form","action=sisMissaoCadastrar",array(
			//basicas
			texto("Nome:"),
			e("INPUT","class=form-input","name=nome"),
			e("BR"),
			
			//requisitos
			texto("Disponível para faccoes:"),
			e("SELECT","class=form-input","name=requisito_faccao",array(
				e("OPTION","value=2",array(texto("Ambas"))),
				e("OPTION","value=0",array(texto("Marines"))),
				e("OPTION","value=1",array(texto("Piratas")))
			)),
			e("BR"),
			texto("Missão requerida:"),
			e("INPUT","class=form-input","name=requisito_missao"),
			e("BR"),
			texto("Nível do capitão requerido:"),
			e("INPUT","class=form-input","name=requisito_lvl"),
			e("BR"),
			
			//recompensas
			texto("Recompensa XP:"),
			e("INPUT","class=form-input","name=recompensa_xp"),
			e("BR"),
			texto("Recompensa Berries:"),
			e("INPUT","class=form-input","name=recompensa_berries"),
			//Itens
			box(array(
				"p"=>e("DIV",array(
					texto("Recompensas (Itens):"),
					e("BR"),
					e("BR"),
					e("DIV","class=lista-recompensa-item","quant=1"),
					e("BR"),
					e("a","class=add-recompensa-item",array(texto("Adicionar Item"))),
				))
			),"100%","box-interna box-sistemaMissoes"),
			//equipamentos
			box(array(
				"p"=>e("DIV",array(
					texto("Recompensas (Equipamentos):"),
					e("BR"),
					e("BR"),
					e("DIV","class=lista-recompensa-equip","quant=1"),
					e("BR"),
					e("a","class=add-recompensa-equip",array(texto("Adicionar Equipamento"))),
				))
			),"100%","box-interna box-sistemaMissoes"),
			
			//disponibilidade
			texto("Disponível para ilhas:"),
			e("SELECT","class=form-input","name=mar_inicio",array(
				e("OPTION","value=0",array(texto("Apenas Ilhas específicas"))),
				e("OPTION","value=1",array(texto("Todas as Ilhas do East Blue"))),
				e("OPTION","value=2",array(texto("Todas as Ilhas do North Blue"))),
				e("OPTION","value=3",array(texto("Todas as Ilhas do South Blue"))),
				e("OPTION","value=4",array(texto("Todas as Ilhas do West Blue"))),
				e("OPTION","value=5",array(texto("Todas as Ilhas da Grand Line"))),
				e("OPTION","value=6",array(texto("Todas as Ilhas do Novo Mundo"))),
				e("OPTION","value=7",array(texto("Todas as Ilhas de todos os Blues"))),
				e("OPTION","value=8",array(texto("Todas as Ilhas")))
			)),
			e("BR"),
			//inicio
			box(array(
				"p"=>e("DIV",array(
					texto("NPC's de início / Ilhas específicas:"),
					e("BR"),
					e("BR"),
					e("DIV","class=lista-ilhas-npcs","quant=2",array(
						e("INPUT","class=form-input","name=npc-1"),
						e("INPUT","class=form-input","name=ilha-1")
					)),
					e("BR"),
					e("a","class=add-ilha-npc",array(texto("Adicionar NPC/Ilha"))),
				))
			),"100%","box-interna box-sistemaMissoes"),
			//conclusao
			box(array(
				"p"=>e("DIV",array(
					texto("NPC's de Conclusão / Ilhas específicas:"),
					e("BR"),
					e("BR"),
					e("DIV","class=lista-ilhas-npcs-c","quant=2",array(
						e("INPUT","class=form-input","name=npc-c-1"),
						e("INPUT","class=form-input","name=ilha-c-1")
					)),
					e("BR"),
					e("BR"),
					e("a","class=add-ilha-npc-c",array(texto("Adicionar NPC/Ilha"))),
				))
			),"100%","box-interna box-sistemaMissoes"),
			
			//textos
			texto("Texto Exclusivo:"),
			e("SELECT","class=form-input","name=is_texto_exclusivo",array(
				e("OPTION","value=1",array(texto("Sim"))),
				e("OPTION","value=0",array(texto("Não")))
			)),
			//piratas
			box(array(
				"p"=>e("DIV","class=textos-piratas",array(
					texto("Piratas:"),
					e("BR"),
					texto("Inicial:"),
					e("TEXTAREA","class=form-input","name=texto_P_iniciacao"),
					e("BR"),
					texto("Andamento:"),
					e("TEXTAREA","class=form-input","name=texto_P_andamento"),
					e("BR"),
					texto("Conclusão:"),
					e("TEXTAREA","class=form-input","name=texto_P_conclusao"),
					e("BR"),
				)),
			),"100%","box-interna box-sistemaMissoes"),
			//marinehiros
			box(array(
				"m"=>e("DIV",array(
					texto("Marinheiros:"),
					e("BR"),
					texto("Inicial:"),
					e("TEXTAREA","class=form-input","name=texto_M_iniciacao"),
					e("BR"),
					texto("Andamento:"),
					e("TEXTAREA","class=form-input","name=texto_M_andamento"),
					e("BR"),
					texto("Conclusão:"),
					e("TEXTAREA","class=form-input","name=texto_M_conclusao"),
					e("BR"),
				)),
			),"100%","box-interna box-sistemaMissoes textos-marines"),
			
			//objetivos
			box(array(
				"p"=>e("DIV",array(
					e("SPAM","title=tipos: 0-Tempo(min), 1-Matar Mob, 2-Coletar Itens",array(texto("Objetivos (Tipo/ID/Quantidade):"))),
					e("BR"),
					e("BR"),
					e("DIV","class=lista-objetivo","quant=2",array(
						e("INPUT","class=form-input","name=objetivo-1"),
						e("INPUT","class=form-input","name=objetivo-id-1"),
						e("INPUT","class=form-input","name=objetivo-quant-1")
					)),
					e("BR"),
					e("a","class=add-objetivo",array(texto("Adicionar objetivo"))),
				))
			),"100%","box-interna box-sistemaMissoes"),
			e("BR"),
			
			//Cadastrar
			e("BUTTON type=\"submit\"",array(texto("Cadastrar")))
		))
	));
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($f,"100%","box-interna box-sistemaMissoes"),
	));
	
	$conteudo["evento"] = "missaoCadastrar();";