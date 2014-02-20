<?php
	$title = "Sistema - Gerenciamento de Ilhas";
	$conteudoCorpo = array();
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	
	include "Sessoes/Menus/sistema.php";
	
	$conteudoCorpo["menu"] = menuInterno($menuInterno);
	$conteudoCorpo["cabecalho"] = cabecalho("Sistema - Gerenciamento de Ilhas");
	
	$conteudoCorpo["bt"] = e("BUTTON","class=link_content","href=&ses=sistemaIlhasExterno",array(texto("Lado Externo")));
	
	$ilhas = $bd->fazArray("SELECT * FROM tb_mun_ilha");
	$e["f"] = e("DIV","style=margin-bottom: 20px",array(
		e("FORM","class=form","action=sisIlhaCadastrar",array(
			texto("Coord:"),
			e("INPUT","class=form-input","name=coordenada"),
			e("BR"),
			texto("Nome:"),
			e("INPUT","class=form-input","name=nome"),
			e("BR"),
			texto("Cor D:"),
			e("INPUT","class=form-input","name=cor_bg_dia"),
			e("BR"),
			texto("Cor N:"),
			e("INPUT","class=form-input","name=cor_bg_noite"),
			e("BR"),
			texto("BG:"),
			e("INPUT","class=form-input","name=bg"),
			e("BR"),
			texto("BG In:"),
			e("INPUT","class=form-input","name=interno"),
			e("BR"),
			e("BUTTON type=\"submit\"",array(texto("Cadastrar")))
		))
	));
	
	$e["t"] = e("TABLE","class=tabela", "style=margin: auto;",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Coord."))),
			e("TD",array(texto("Nome"))),
			e("TD",array(texto("Cor D"))),
			e("TD",array(texto("Cor N"))),
			e("TD",array(texto("BG Out"))),
			e("TD",array(texto("BG In")))
		))
	));
	
	foreach ($ilhas as $key => $value) {
		$e["t"]["c"][] = e("TR", array(
			e("TD",array(texto($value["ilha_id"]))),
			e("TD",array(texto($value["coordenada"]))),
			e("TD",array(texto($value["nome"]))),
			e("TD",array(texto($value["cor_bg_dia"]))),
			e("TD",array(texto($value["cor_bg_noite"]))),
			e("TD",array(texto($value["bg"]))),
			e("TD",array(texto($value["interno"])))
		));
	}
	
	$edificios = $bd->fazArray("SELECT * FROM tb_mun_edificio");
	
	$f["f"] = e("DIV","style=margin-bottom: 20px",array(
		e("FORM","class=form","action=sisEdificioCadastrar",array(
			texto("Img:"),
			e("INPUT","class=form-input","name=img"),
			e("BR"),
			texto("Nome:"),
			e("INPUT","class=form-input","name=nome"),
			e("BR"),
			texto("Descricao:"),
			e("TEXTAREA","class=form-input","name=descricao"),
			e("BR"),
			texto("P C:"),
			e("INPUT","class=form-input","name=preco_construcao"),
			e("BR"),
			texto("P U:"),
			e("INPUT","class=form-input","name=preco_upgrade"),
			e("BR"),
			texto("T C:"),
			e("INPUT","class=form-input","name=tempo_construcao"),
			e("BR"),
			texto("T U:"),
			e("INPUT","class=form-input","name=tempo_upgrade"),
			e("BR"),
			e("BUTTON type=\"submit\"",array(texto("Cadastrar")))
		))
	));
	$f["t"]=e("TABLE","class=tabela", "style=margin: auto;",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("ID"))),
			e("TD",array(texto("Img"))),
			e("TD",array(texto("Nome"))),
			e("TD",array(texto("Descricao"))),
			e("TD",array(texto("P Cons"))),
			e("TD",array(texto("P UP"))),
			e("TD",array(texto("T Cons"))),
			e("TD",array(texto("T UP")))
		))
	));
	
	foreach ($edificios as $key => $value) {
		$f["t"]["c"][] = e("TR", array(
			e("TD",array(texto($value["edificio_id"]))),
			e("TD",array(
				e("IMG","src=Imagens/Edificios/".$value["img"].".png","width=25px")
			)),
			e("TD",array(texto($value["nome"]))),
			e("TD",array(
				e("DIV","style=height:60px; overflow: auto;",array(texto($value["descricao"])))
			)),
			e("TD",array(texto($value["preco_construcao"]))),
			e("TD",array(texto($value["preco_upgrade"]))),
			e("TD",array(texto($value["tempo_construcao"]))),
			e("TD",array(texto($value["tempo_upgrade"])))
		));
	}
	
	$ilhaEdificio = $bd->fazArray("SELECT * FROM tb_mun_ilha_edificio");
	
	$g["f"] = e("DIV","style=margin-bottom: 20px",array(
		e("FORM","class=form","action=sisIlhaEdificioCadastrar",array(
			texto("ID da Ilha:"),
			e("INPUT","class=form-input","name=ilha_id"),
			e("BR"),
			texto("ID do Edificio:"),
			e("INPUT","class=form-input","name=edificio_id"),
			e("BR"),
			texto("Nível:"),
			e("INPUT","class=form-input","name=lvl"),
			e("BR"),
			texto("Coordenada:"),
			e("INPUT","class=form-input","name=coordenada"),
			e("BR"),
			e("BUTTON type=\"submit\"",array(texto("Cadastrar")))
		))
	));
	$g["t"]=e("TABLE","class=tabela", "style=margin: auto;",array(
		0 => e("TR","class=tabela-titulo",array(
			e("TD",array(texto("Ilha_id"))),
			e("TD",array(texto("Edificio_id"))),
			e("TD",array(texto("Nível"))),
			e("TD",array(texto("Coordenada")))
		))
	));
	
	foreach ($ilhaEdificio as $key => $value) {
		$g["t"]["c"][] = e("TR", array(
			e("TD",array(texto($value["ilha_id"]))),
			e("TD",array(texto($value["edificio_id"]))),
			e("TD",array(texto($value["lvl"]))),
			e("TD",array(texto($value["coordenada"]))),
			e("TD",array(
				e("A","href=sisIlhaEdificioRemover&edificio=".$value["edificio_id"]."&ilha=".$value["ilha_id"],"class=link_send",array(
					e("IMG","src=Imagens/Icones/X.png")
				))
			))
		));
	}
	
	$conteudoCorpo["corpo"] = e("DIV",array(
		box($f,"50%","box-interna box-sistemaIlhas"),
		box($e,"50%","box-interna box-sistemaIlhas"),
		box($g,"100%","box-interna clear")
	));
	$conteudoCorpo["clear"] = e("DIV","class=clear");
