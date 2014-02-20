<?php
	function getMenu(){
		$conteudoMenu = array(
			"principal" => TRUE,
			"tripulacao" => FALSE,
			"navio" => FALSE,
			"ilha" => FALSE,
			"oceano" => FALSE,
			"alianca" => FALSE,
			"frota" => FALSE,
			"combate" => FALSE,
			"cadastro" => TRUE,
			"deslogar" => TRUE,
			"desconectarTrip" => FALSE,
			"sistema" => FALSE,
			"questTracker" => FALSE,
			"bau" => FALSE
		);
		
		if(Usuario::$logado){
			$conteudoMenu["cadastro"] = FALSE;
			if(Usuario::$tripAtiva!=0){
				$conteudoMenu["tripulacao"] = TRUE;
				$conteudoMenu["desconectarTrip"] = TRUE;
				$conteudoMenu["bau"] = TRUE;
				if(Usuario::getTrip()->getNavio())
					$conteudoMenu["navio"] = TRUE;
				
				if(Usuario::inIlha()!=0)
					$conteudoMenu["ilha"] = TRUE;
				
				if(Usuario::inMissao())
					$conteudoMenu["questTracker"] = TRUE;
				
				if(Usuario::inCombate()){
					$conteudoMenu["combate"] = TRUE;
					$conteudoMenu["ilha"] = FALSE;
					$conteudoMenu["navio"] = FALSE;
					$conteudoMenu["bau"] = FALSE;
					$conteudoMenu["desconectarTrip"] = FALSE;
					$conteudoMenu["tripulacao"] = FALSE;
				}
			}
			else{
			}
			if(Usuario::$permissao<2){
				$conteudoMenu["sistema"] = TRUE;
			}
		}
		else{
			$conteudoMenu["deslogar"] = FALSE;
		}
		return $conteudoMenu;
	}
	
	function getNews(){
		global $bd;
		
		$news = $bd->fazArray("SELECT announcement FROM cometchat_announcements ORDER BY time DESC LIMIT 1");
		$menuNews = $news[0]["announcement"];
		
		return $menuNews;
	}
	
	function getMenuBandeira(){
		return (Usuario::$logado)?Usuario::getBandeira():"Imagens/Bandeiras/deslogado.png";
	}
