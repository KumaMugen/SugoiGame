<?php
class TripulacaoAlheia extends Tripulacao{
	function __construct($trip){
		try{
			global $bd;
			$this->bd = &$bd;
			
			$trip = $bd->fazArray( 
				"SELECT * FROM tb_usr_tripulacao ".
				"WHERE tripulacao_id=':0:'", 
				array($trip),
				array(INT_FORMAT)
			);
		}
		catch(Exception $i){ $this->tException("Tentativa de criar tripulacao $trip\n".$i->getMessage()."\n".$i->getTraceAsString()); }
		if(sizeof($trip)==1){
			$this->iniciaParametros($trip[0]);
		}
		else{
			throw new NotFoundException("Tripulacao nao encontrada");
		}
	}
}
