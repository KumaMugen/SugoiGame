<?php
	function getListaTripulantes(){
		if(!Usuario::$logado OR Usuario::$tripAtiva==0 OR !isset($_GET["tripulantes"]))
			return FALSE;
		
		$tripulantes = Usuario::getTrip()->getTripulantes();
		
		$t = array();
		
		$text=(Usuario::$faccao==0)?"Fama: ":"Ameaça: ";
		
		foreach ($tripulantes as $key => $value) {
			$t[$key] = array(
				"status" => 0,
				"nome" => $value->nome,
				"procurado" => $value->procurado,
				"cartaz" => $value->id,
				"img" => $value->getSkinR(),
				"lvl" => $value->lvl,
				"fa" => $text.$value->FA,
				"armamento" => $value->hakiArm,
				"mantra" => $value->hakiMan,
				"hp" => $value->hp,
				"hpM" => $value->getHPMax(),
				"mp" => $value->mp,
				"mpM" => $value->getMPMax(),
				"xp" => $value->xp,
				"xpM" => $value->getXPMax(),
				"razao" => ($value->hp/$value->getHPMax()),
				"classe" => $value->getClasse(),
				"score" => $value->classeScore
			);
		}
		
		for( $x=sizeof($t) ; $x < Usuario::getTrip()->getCapTripulantes() ; $x++){
			$t[$x] = array(
				"status" => 1
			);
			
		}
		for( $x=Usuario::getTrip()->getCapTripulantes() ; $x < 20 ; $x++ ){
			$t[$x] = array(
				"status" => 2
			);
		}
		return $t;
	}
