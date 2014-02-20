<?php
class Mapa extends Super{
	private $bd;
	
	function __construct(){
		global $bd;
		$this->bd = &$bd;
	}
	
	function getTabela($tipo){
		switch ($tipo) {
			case 'naonavegavel':
				return "tb_mun_mapa_naonavegavel";
				break;
			default:
				return NULL;
				break;
		}
	}
	
	function getVisao($tipo,$centro,$alcance){
		$coord = explode("_",$centro);
		
		$tb = $this->getTabela($tipo);
		if(!$tb) return FALSE;
		
		$minx = $coord[0]-$alcance;
		$maxx = $coord[0]+$alcance;
		$miny = $coord[1]-$alcance;
		$maxy = $coord[1]+$alcance;
		
		$coords = $this->bd->fazArray(
			"SELECT * FROM $tb WHERE `x`>=$minx AND `x`<=$maxx ".
			"AND `y`>=$miny AND `y`<=$maxy"
		);
		
		$visao=array();
		foreach ($coords as $key => $value) {
			$visao[($value["x"]-$coord[0]+$alcance)."_".($value["y"]-$coord[1]+$alcance)]
				=$value["x"]."_".$value["y"];
		}
		
		return $visao;
	}
	
	function is($tipo,$coordenada,$par=TRUE){
		$coord = explode("_",$coordenada);
		
		$tb = $this->getTabela($tipo);
		if(!$tb) return FALSE;
		
		$coordenada = array();
		$coordenada = $this->bd->fazArray(
			"SELECT * FROM `$tb` WHERE `x`=':0:' AND `y`=':1:'",
			array($coord[0],$coord[1]),
			array(INT_FORMAT,INT_FORMAT),
			$par
		);
		return (sizeof($coordenada)>0)?TRUE:FALSE;
	}
	
	function insere($tipo,$coordenada,$complementos=array()){
		$coord = explode("_",$coordenada);
		
		$tb = $this->getTabela($tipo);
		if(!$tb) return FALSE;
		
		$query= "INSERT INTO $tb (x,y";
		
		foreach ($complementos as $key => $value) {
			$query.=",".$key;
		}
		$query.=") VALUES (':0:',':1:'";
		foreach ($complementos as $key => $value) {
			$query.=",'".$value."'";
		}
		$query.=")";
		
		$this->bd->query(
			$query,
			array($coord[0],$coord[1]),
			array(INT_FORMAT,INT_FORMAT)
		);
	}
	
	function remove($tipo,$coordenada){
		$coord = explode("_",$coordenada);
		
		$tb = $this->getTabela($tipo);
		if(!$tb) return FALSE;
		
		$this->bd->query(
			"DELETE FROM $tb WHERE x=':0:' AND y=':1:'",
			array($coord[0],$coord[1]),
			array(INT_FORMAT,INT_FORMAT)
		);
	}
}
