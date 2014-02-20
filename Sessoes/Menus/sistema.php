<?php
	$menuInterno = array(
		"sistemaHome"=>array(
			"title"=>"Painel do Sistema",
			"texto"=>"Página Principal",
			"img"=>"Imagens/Icones/Minha_conta.png"
		)
	);
	if(Usuario::$permissao<=PER_sistemaAkuma){
		$menuInterno["sistemaAkuma"]= array(
			"title"=>"Akuma no Mi",
			"texto"=>"Akuma no Mi",
			"img"=>"Imagens/Icones/Akuma.png"
		);
	}
	
	if(Usuario::$permissao<=PER_sistemaRestricoes){
		$menuInterno["sistemaRestricoes"]= array(
			"title"=>"Páginas",
			"texto"=>"Restrições de páginas",
			"img"=>"Imagens/Icones/Minha_conta.png"
		);
	}
	
	if(Usuario::$permissao<=PER_sistemaIlhas){
		$menuInterno["sistemaIlhas"]= array(
			"title"=>"Ilhas",
			"texto"=>"Gerenciar Ilhas",
			"img"=>"Imagens/Icones/Minha_conta.png"
		);
		$menuInterno["sistemaMundi"]= array(
			"title"=>"Mapa Mundi",
			"texto"=>"Mapa Mundi",
			"img"=>"Imagens/Icones/Minha_conta.png"
		);
	}
	
	if(Usuario::$permissao<=PER_sistemaMissoes){
		$menuInterno["sistemaMissoes"]= array(
			"title"=>"Missoes",
			"texto"=>"Missoes",
			"img"=>"Imagens/Icones/Visao_geral.png"
		);
	}
	
	if(Usuario::$permissao<=PER_sistemaItens){
		$menuInterno["sistemaItens"]= array(
			"title"=>"Itens",
			"texto"=>"Itens",
			"img"=>"Imagens/Icones/VIP2.png"
		);
	}
	