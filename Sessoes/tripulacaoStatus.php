<?php
	$title = "Tripulação";
	$conteudoCorpo = array();
	
	include "Sessoes/Menus/tripulacao.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho(Usuario::getTrip()->nome);
	
	$content = array(
		e("TABLE","style=margin: auto;",array(
			e("TR",array(
				e("TD",array(
					e("DIV",array(
						e("IMG", "src=".Usuario::getBandeira())
					))
				)),
				e("TD",array(
					e("TABLE","class=tabela",array(
						e("TR",array(
							e("TD",array(
								texto("Reputação: ")
							)),
							e("TD",array(
								texto(Usuario::getTrip()->reputacao)
							))
						)),
						e("TR",array(
							e("TD",array(
								texto("Nível do mais forte: ")
							)),
							e("TD",array(
								texto(Usuario::getTrip()->getMaisForte())
							))
						)),
						e("TR",array(
							e("TD",array(
								texto("Vitórias: ")
							)),
							e("TD",array(
								texto(Usuario::getTrip()->vitorias)
							))
						)),
						e("TR",array(
							e("TD",array(
								texto("Patente: ")
							)),
							e("TD",array(
								e("SPAN","class=exibe-patentes",array(
									texto(Usuario::getTrip()->getPatente())
								))
							))
						))
					))
				)),
				e("TD",array(
					e("TABLE","class=tabela",array(
						e("TR",array(
							e("TD",array(
								texto("Rankig Geral: ")
							)),
							e("TD",array(
								texto("1º")
							))
						)),
						e("TR",array(
							e("TD",array(
								texto("Ranking Vitórias: ")
							)),
							e("TD",array(
								texto("1º")
							))
						)),
						e("TR",array(
							e("TD",array(
								texto("Ranking Realizações: ")
							)),
							e("TD",array(
								texto("1º")
							))
						)),
						e("TR",array(
							e("TD",array(
								texto("Ranking Patente: ")
							)),
							e("TD",array(
								texto("1º")
							))
						))
					))
				))
			))
		))
	);
	
	$conteudoCorpo["content"] = e("DIV","id=informacao-geral",array(
		box($content,"100%","box-interna")
	));
	
	
	
	$tripulantes = Usuario::getTrip()->getTripulantes();
	
	if(isset($_GET["sel"]))$selecionado = $_GET["sel"];
	else $selecionado = $tripulantes[0]->id;
	
	$conteudoCorpo["tripulantes"] = e("DIV",array(
		"select" => getPersonagemSeletor($tripulantes,$selecionado)
	));
	
	$info = e("DIV","class=personagem-info",array());
	foreach ($tripulantes as $key => $value) {
		$info["c"][$key] = e("DIV","class=personagem".(($selecionado==$value->id)?" personagem-selecionado":""),"id=layer-personagem-".$value->id);
	}
	$conteudoCorpo["tripulantes"]["c"]["info"] = $info;
	
	$conteudo["evento"] = "tripulacaoStatus();";
	