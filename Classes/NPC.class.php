<?php
Class NPC extends Super{
	public 
		$id,
		$nome,
		$texto,
		$img;
	
	private 
		$bd, //banco de dados
		$mar,
		$compra,
		$vende,
		$coordenada; 
	
	function __construct($cod){
		try{
			global $bd;
			$this->bd = &$bd;
			
			$npc = $this->bd->fazArray("SELECT * FROM tb_mun_npc WHERE npc_id=':0:'",array($cod),array(INT_FORMAT),FALSE);
		}
		catch(Exception $i){ $this->tException("Tentativa de criar NPC $cod\n".$i->getMessage()."\n".$i->getTraceAsString()); }
		if(sizeof($npc)==1){
			$this->iniciaParametros($npc[0]);
		}
		else{
			throw new NotFoundException("NPC não encontrado");
		}
	}
	
	private function iniciaParametros($npc){
		$this->id = $npc["npc_id"];
		$this->nome = $npc["nome"];
		$this->texto = $npc["texto"];
		$this->img = $npc["img"];
		$this->background = $npc["background"];
		$this->mar = $npc["is_mar"];
		$this->coordenada = $npc["coordenada"];
		$this->compra = $npc["is_compra"];
		$this->vende = $npc["is_vende"];
	}
	
	function possivelFalar(){
		$coord = Usuario::getTrip()->coord;
		if($coord!= "interno"){
			if(Usuario::inIlha()==0)
				$coord = $coord->toString();
			else
				$coord = $coord["coord"]->toString();
		}
		
		if($this->coordenada != $coord) return FALSE;
		
		if($this->mar==0){
			$ilha = $this->bd->fazArray(
				"SELECT * FROM tb_mun_npc_ilha WHERE npc_id='".$this->id."'"
			);
			$ilhas = array();
			foreach ($ilha as $key => $value) {
				$ilhas[]=$value["ilha_id"];
			}
			return (in_array(Usuario::inIlha(), $ilhas))? TRUE : FALSE;
		}
		return (correspondeMar($this->mar) && Usuario::inIlha())? TRUE : FALSE;
		
	}
	
	function getFuncoes(){
		$func = array();
		$func = $this->bd->fazArray(
			"SELECT * FROM tb_mun_npc_funcao WHERE npc_id='".$this->id."'"
		);
		if($this->compra)
			$func[] = array("funcao"=>"Ver itens a venda","link"=>"","tipo_link"=>"funcao-compra icon-cursor2");
		if($this->vende)
			$func[] = array("funcao"=>"Vender itens","link"=>"","tipo_link"=>"funcao-venda icon-cursor2");
		return $func;
	}
	private function addMissao(&$missoes,$m){
		$missoes[] = array(
			"nome" => $m->nome,
			"missao_id" => $m->id,
			"texto_I" => $m->texto["ini"],
			"texto_A" => $m->texto["and"],
			"texto_C" => $m->texto["con"],
			"status" => $m->getStatus(),
			"r_xp" => $m->recompensaXP,
			"r_berries" => $m->recompensaBerries,
			"r_item" => $m->getRecompensaItens(),
			"r_equip" => $m->getRecompensaEquipamentos()
		);
	}
	function getMissoes(){
		$MI = array();
		$MI = $this->bd->fazArray(
			"SELECT * FROM tb_mis_missao_npc_inicio ".
			"WHERE npc_id='".$this->id."'"
		);
		$MF = array();
		$MF = $this->bd->fazArray(
			"SELECT * FROM tb_mis_missao_npc_conclusao ".
			"WHERE npc_id='".$this->id."'"
		);
		
		$missoes = array();
		//missoes que podem ser iniciadas aqui
		foreach ($MI as $key => $value) {
			$m = new Missao($value["missao_id"]);
			
			if($m->isDisponivel("inicio",$value["ilha_id"]) && $m->getStatus()==0 && $m->cumpreRequisitos())
				$this->addMissao($missoes,$m);
		}
		//missoes que podem ser concluidas aqui
		foreach ($MF as $key => $value) {
			$m = new Missao($value["missao_id"]);
			
			$s = $m->getStatus();
			if($m->isDisponivel("conclusao",$value["ilha_id"]) && $s!=0 && $s!=3)
				$this->addMissao($missoes,$m);
		}
		
		return $missoes;
	}
}