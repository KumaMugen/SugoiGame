<?php
class CombateUpdate extends Super{
	private $bd,
		$combateId;
	
	/*
	 * Tipos de acoes
	 * 0- ataque
	 * 1- movimento
	 * 2- log
	 * 3- info do combate
	 */
	public $atualizacoes = array();
	
	function __construct($combateId){
		global $bd;
		$this->bd = &$bd;
		try{
			$update = $this->bd->fazArray(
				"SELECT * FROM tb_cbt_combate_update ".
				"WHERE combate_id=':0:'",
				array($combateId),
				array(INT_FORMAT)
			);
			if(sizeof($update)==0){
				$this->bd->query(
					"INSERT INTO tb_cbt_combate_update ".
					"(combate_id) VALUES ".
					"(':0:')",
					array($combateId),
					array(INT_FORMAT)
				);
			}
			else if(strlen($update[0]["update"])>0)
				$this->atualizacoes = unserialize($update[0]["update"]);
			
			$this->combateId = $combateId;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	function addAcao($acao=array()){
		$this->atualizacoes[] = $acao;
	}
	
	function getAcoes(){
		try{
			$this->bd->query(
				"UPDATE `tb_cbt_combate_update` ".
				"SET `update`='' ".
				"WHERE `combate_id`='".$this->combateId."'"
			);
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
		
		$a =  $this->atualizacoes;
		$this->atualizacoes = array();
		return $a;
	}
	
	function __destruct(){
		$ob = serialize($this->atualizacoes);
		
		$this->bd->query(
			"UPDATE `tb_cbt_combate_update` ".
			"SET `update`=':0:' ".
			"WHERE `combate_id`='".$this->combateId."'",
			array($ob),
			array(ALL_FORMAT)
		);
	}
}