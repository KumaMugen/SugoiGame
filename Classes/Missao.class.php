<?php
class Missao extends Super{
	public
		$id,
		$nome,
		$texto,
		$textos = array(),
		$recompensaXP,
		$recompensaBerries,
		$isTextoExclusivo,
		$requisitoFaccao,
		$requisitoLVL,
		$requisitoMissao;
	
	private
		$recompensaItens=FALSE,
		$recompensaEquipamentos=FALSE,
		$objetivos = FALSE,
		$NPCInicio = FALSE,
		$NPCConclusao = FALSE,
		$mar;
		
	private $bd; //banco de dados
		
	function __construct($id){
		global $bd;
		$this->bd = &$bd;
		try{
			$missao=$this->bd->fazArray(
				"SELECT * FROM tb_mis_missao WHERE missao_id=':0:'",
				array($id),
				array(INT_FORMAT)
			);
		}
		catch(Exception $i){ $this->tException($i->getMessage()); }
		if(sizeof($missao) == 1){
			$this->iniciaParametros($missao[0]);
		}
		else throw new NotFoundException("Missao nao encontrada");
	}
	
	private function iniciaParametros($missao){
		$this->id = $missao["missao_id"];
		$this->nome = $missao["nome"];
		
		$this->isTextoExclusivo = $missao["is_texto_exclusivo"];
		if($missao["is_texto_exclusivo"])
			$campoTexto = "texto_".($this->colunaMissao(Usuario::$faccao));
		else $campoTexto = "texto_P";
		
		$this->texto["ini"] = $missao[$campoTexto."_iniciacao"];
		$this->texto["and"] = $missao[$campoTexto."_andamento"];
		$this->texto["con"] = $missao[$campoTexto."_conclusao"];
		
		$this->textos = $missao;
		
		$this->recompensaXP = $missao["recompensa_xp"];
		$this->recompensaBerries = $missao["recompensa_berries"];
		
		$this->requisitoFaccao = $missao["requisito_faccao"];
		$this->requisitoLVL = $missao["requisito_lvl"];
		$this->requisitoMissao = $missao["requisito_missao"];
		$this->mar = $missao["mar_inicio"];
		
		
	}
	private function colunaMissao($f){
		if($f==0) return "M";
		else return "P";
	}
	function isDisponivel($tipo,$ilha=0){
		if($tipo!= "inicio" AND $tipo != "conclusao") return FALSE;
		$mOK = FALSE;
		if($this->mar==0){
			if ($ilha!=0 && Usuario::inIlha()==$ilha)$mOK = TRUE;
		}
		else if(correspondeMar($this->mar))$mOK = TRUE;
		
		return $mOK;
	}
	
	function cumpreRequisitos(){
		if(Usuario::$tripAtiva==0) return FALSE;
		$mOk = FALSE;
		if($this->requisitoFaccao===NULL OR $this->requisitoFaccao===Usuario::$faccao)
			if($this->requisitoLVL<= Usuario::getTrip()->getCapitao()->lvl){
				if($this->requisitoMissao==0)
					$mOk = TRUE;
				else{
					$query = $this->bd->fazArray(
						"SELECT missao_id FROM tb_mis_missao_concluida ".
						"WHERE tripulacao_id='".Usuario::$tripAtiva."' ".
						"AND missao_id='".$this->requisitoMissao."'"
					);
					if(sizeof($query)!=0)$mOk = TRUE;
				}
			}
		
		$i = $this->bd->fazArray(
			"SELECT * FROM tb_mis_missao_npc_inicio ".
			"WHERE missao_id='".$this->id."' AND ".
			"(ilha_id='".Usuario::inIlha()."' OR ilha_id='0')"
		);
		if(sizeof($i) == 0)$mOk = FALSE;
		
		return $mOk;
	}
	
	function getStatus(){
		$q = $this->bd->fazArray(
			"SELECT * FROM tb_mis_missao_concluida ".
			"WHERE missao_id='".$this->id."' AND tripulacao_id='".Usuario::$tripAtiva."'",
			array(),
			array(),
			FALSE
		);
		if(sizeof($q)!=0) return 3;
		$q = $this->bd->fazArray(
			"SELECT * FROM tb_mis_missao_andamento ".
			"WHERE missao_id='".$this->id."' AND tripulacao_id='".Usuario::$tripAtiva."'",
			array(),
			array(),
			FALSE
		);
		if(sizeof($q)!=0){
			$u = $this->getObjetivos();
			foreach ($q as $key => $value) {
				if($value["tipo"]==0)
					return ($value["objetivo_quant"]<=atual_segundo())? 2 : 1;
				else if($value["tipo"]==1){
					foreach ($u as $key => $value2) {
						if($value2["tipo"]==$value["tipo"] && $value2["objetivo_id"]==$value["objetivo_id"])
							if($value["objetivo_quant"]<$value2["objetivo_quant"]) return 1;
					}
				}
				else if($value["tipo"]==2){
					$and = $this->bd->fazArray(
						"SELECT * FROM tb_itn_tripulacao_item ".
						"WHERE tripulacao_id='".Usuario::$tripAtiva."' ".
						"AND item_id='".$value["objetivo_id"]."'"
					);
					if(sizeof($and)==0) return 1;
					if($value["objetivo_quant"] > $and[0]["quant"]) return 1;
				}
			}
			return 2;
		}
		return 0;
	}
	//recompensas
	
	//itens com descricao
	function getRecompensaItens(){
		if(!$this->recompensaItens){
			$this->recompensaItens = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_recompensa_item ".
				"INNER JOIN tb_itn_item ".
				"ON tb_mis_missao_recompensa_item.item_id = tb_itn_item.item_id ".
				"WHERE tb_mis_missao_recompensa_item.missao_id='".$this->id."'"
			);
		}
		return $this->recompensaItens;
	}
	//itens sem descricao
	function getRecompensaItensSemDescricao(){
		if(!$this->recompensaItens){
			$this->recompensaItens = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_recompensa_item ".
				"WHERE missao_id='".$this->id."'"
			);
		}
		return $this->recompensaItens;
	}
	
	//equipamentos com descricao
	function getRecompensaEquipamentos(){
		if(!$this->recompensaEquipamentos){
			$this->recompensaEquipamentos = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_recompensa_equipamento ".
				"INNER JOIN tb_itn_equipamento ".
				"ON tb_mis_missao_recompensa_equipamento.equipamento_id = tb_itn_equipamento.equipamento_id ".
				"WHERE tb_mis_missao_recompensa_equipamento.missao_id='".$this->id."'"
			);
		}
		return $this->recompensaEquipamentos;
	}
	//equipamentos sem descricao
	function getRecompensaEquipamentosSemDescricao(){
		if(!$this->recompensaEquipamentos){
			$this->recompensaEquipamentos = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_recompensa_equipamento ".
				"WHERE missao_id='".$this->id."'"
			);
		}
		return $this->recompensaEquipamentos;
	}
	
	//objetivos
	function getObjetivos(){
		if(!$this->objetivos){
			$this->objetivos = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_objetivo ".
				"WHERE missao_id='".$this->id."'"
			);
		}
		return $this->objetivos;
	}
	function getNPCInicio(){
		if(!$this->NPCInicio){
			$this->NPCInicio = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_npc_inicio ".
				"WHERE missao_id='".$this->id."'"
			);
		}
		return $this->NPCInicio;
	}
	function getNPCConclusao(){
		if(!$this->NPCConclusao){
			$this->NPCConclusao = $this->bd->fazArray(
				"SELECT * FROM tb_mis_missao_npc_conclusao ".
				"WHERE missao_id='".$this->id."'"
			);
		}
		return $this->NPCConclusao;
	}
}