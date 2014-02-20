<?php
	$title = "Criação de tripulação";
	$conteudoCorpo = array();
	
	$conteudoCorpo["conteudo"] = e("DIV","id=nova-trip","class=content-steps",array(
		"step-1" => e("DIV","class=step","o=1",array(
			"faccao" => e("DIV","id=faccao",array(
				e("DIV",array(
					cabecalho("Escolha sua facção:")
				)),
				"faccao-sel" => e("DIV",array(
					1 =>e("IMG","src=Imagens/Bandeiras/marinha.jpg","f=Marinheiro","class=tripulacao-select"),
					0 =>e("IMG","src=Imagens/Bandeiras/pirata.jpg","f=Pirata","class=tripulacao-select")
				))
			))
		)),
		"step-2" => e("DIV","class=step","o=2",array(
			cabecalho("Escolha seu capitão:"),
			"div" => e("DIV",array(
				"table" => e("TABLE","id=informacoes-trip",array(
					"faccao" => e("TR",array(
						e("TD",array(
							texto("Facção:")
						)),
						e("TD",array(
							e("INPUT","id=n-trip-faccao","readonly=readonly")
						))
					)),
					"capitao" => e("TR",array(
						e("TD",array(
							texto("Nome do capitão:")
						)),
						e("TD",array(
							e("INPUT","id=n-trip-capitao"),
							e( "IMG", "id=status-n-trip-capitao", "src=Imagens/Icones/3.gif" )
						))
					)),
					"mar" => e("TR",array(
						e("TD",array(
							texto("Mar de origem:")
						)),
						e("TD",array(
							e("SELECT","id=n-trip-mar",array(
								e("OPTION","value=0","checked=checked",array(texto("Aleatório"))),
								e("OPTION","value=1",array(texto("East Blue"))),
								e("OPTION","value=2",array(texto("North Blue"))),
								e("OPTION","value=3",array(texto("South Blue"))),
								e("OPTION","value=4",array(texto("West Blue")))
							))
						))
					)),
					"bt" => e("TR",array(
						e("TD"),
						e("TD",array(
							e("BUTTON","id=n-trip-bt-confirmar",array(texto("Confirmar")))
						))
					)),
				)),
				e("INPUT","id=n-trip-capitao-img","readonly=readonly", "class=no-display"),
				"table2" => e("DIV","id=seletor-capitao",array(
					e("DIV","id=seletor-capitao-div",array(
						e("DIV","class=pageMenos icon-cursor",array(texto("<"))),
						texto(" || "),
						e("DIV","class=pageMais icon-cursor",array(texto(">")))
					))
				))
			))
		)),
		"clear" => e("DIV","class=step-seletor",array(
			e("DIV","class=stepMenos step-switch icon-cursor",array(texto("< Voltar"))),
			texto(" || "),
			e("DIV","class=stepMais step-switch icon-cursor",array(texto("Avançar >")))
		))
	));
	if(Usuario::$faccao!=NULL){
		$conteudoCorpo["conteudo"]["c"]["step-1"]["c"]["faccao"]["c"]["faccao-sel"]["c"][Usuario::$faccao]="";
	}
	
	$conteudo["evento"] = "stepsNovaTrip(2,".QNT_PERSONAGENS.");";
