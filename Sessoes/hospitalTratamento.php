<?php
	$title = "Hospital - Tratamento";
	$conteudoCorpo = array();
	
	//include "Sessoes/Menus/ct.php";
	
	//$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Hospital - Tratamento");
	
	$tripulantes = Usuario::getTrip()->getTripulantes();
	
	if(isset($_GET["sel"]))$selecionado = $_GET["sel"];
	else $selecionado = $tripulantes[0]->id;
	
	$info = e("DIV","id=personagens-tratamento",array());
	foreach ($tripulantes as $key => $value) {
		$tRest = $value->inTratamento();
		$info["c"][$key] = e("DIV","class=personagem-tratamento",array(
			e("DIV","class=per-trat-img",array(
				e("IMG","src=Imagens/Personagens/Icons/".$value->getSkinR().".jpg"),
				barra(100,"red",($value->hp/$value->getHPMax()),"green",($value->hp." / ".$value->getHPMax()),1)
			)),
			e("DIV","class=per-trat-check",array(
				e('INPUT type="checkbox"',"class=hosp-check","id=check-".$value->id,"perId=".$value->id),
				texto(htmlspecialchars("< Selecione o personagem"))
			)),
			e("DIV","class=per-trat-time",array(
				($tRest)?(
					($tRest-atual_segundo()>0)?(
						e("DIV",array(
							e('INPUT type="hidden"',"readonly=readonly","class=t-restante",
								"id=tRestante-".$value->id,"value=".((Int)($tRest-atual_segundo()))),
							e("SPAN","id=tRestante-".$value->id."-t")
						))
					)
					:(
						e('SPAN',array(texto("Recuperado")))
					)
				)
				:(
					e('SPAN')
				)
			))
		));
	}
	$info["c"][] = e("DIV","class=personagem-tratamento-bt clear",array(
		e("BUTTON","id=hosTratar",array(texto("Tratar selecionados"))),
		e("BUTTON","id=hosFinalizar",array(texto("Finalizar tratamento"))),
		e("BUTTON","id=hosCancelar",array(texto("Cancelar tratamento")))
	));
	$conteudoCorpo["tripulantes"]["c"]["info"] = $info;
	
	$conteudo["evento"] = "hospitalTratamento();";
