<?php
class Navio extends Super{
	public
		$hp,
		$skin,
		$lvl,
		$partes = array();
		
	private $bd; //banco de dados
		
	function __construct($id){
		global $bd;
		$this->bd = &$bd;
		try{
			$navio=$this->bd->fazArray(
				"SELECT * FROM tb_usr_navio WHERE tripulacao_id=':0:'",
				array($id),
				array(INT_FORMAT)
			);
		}
		catch(Exception $i){ $this->tException($i->getMessage()); }
		if(sizeof($navio) == 1){
			$this->iniciaParametros($navio[0]);
		}
		else throw new NotFoundException("Navio nao encontrado");
	}
	
	private function iniciaParametros($navio){
		$this->hp = $navio["hp"];
		$this->skin = $navio["skin"];
		$this->lvl = $navio["lvl_navio"];
		$this->partes["conves"] = $navio["lvl_conves"];
		$this->partes["armazem"] = $navio["lvl_armazem"];
		$this->partes["leme"] = $navio["lvl_leme"];
		$this->partes["casco"] = $navio["lvl_casco"];
	}
	
	function getHPMax(){
		return 89+($this->partes["casco"]*11);
	}
	
	function tException($msg){ throw new Exception($msg); }
}
