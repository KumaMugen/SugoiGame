<?php
Class PersonagemCombate extends Personagem{
	private $bd; //banco de dados
	
	function __construct($pers){
		try{
			global $bd;
			$this->bd = &$bd;
			
			$personagem = $this->bd->fazArray("SELECT * FROM tb_per_personagem WHERE personagem_id=':0:'",array($pers["personagem_id"]),array(INT_FORMAT),FALSE);
		}
		catch(Exception $i){ $this->tException("Tentativa de criar personagem $cod\n".$i->getMessage()."\n".$i->getTraceAsString()); }
		if(sizeof($personagem)==1){
			$this->iniciaParametros($pers,$personagem[0]);
		}
		else{
			throw new NotFoundException("Personagem $cod nao encontrado");
		}
	}
	
	private function iniciaParametros($perC,$trip){
		$this->codTrip = $trip["tripulacao_id"];
		$this->id = $trip["personagem_id"];
		$this->nome = $trip["nome"];
		
		$this->img = $trip["imagem"];
		$this->imgR =$trip["skin_rosto"];
		$this->imgC = $trip["skin_corpo"];
		
		$this->xp = $trip["xp"];
		$this->lvl = $trip["lvl"];
		$this->hp = $perC["hp"];
		$this->mp = $perC["mp"];
		
		$this->FA = $trip["fama_ameaca"];
		$this->procurado = ($trip["is_procurado"] == 1) ? TRUE : FALSE;
		
		$this->attr["atk"] = $perC["atributo_atk"];
		$this->attr["def"] = $perC["atributo_def"];
		$this->attr["agl"] = $perC["atributo_agl"];
		$this->attr["res"] = $perC["atributo_res"];
		$this->attr["pre"] = $perC["atributo_pre"];
		$this->attr["des"] = $perC["atributo_des"];
		$this->attr["per"] = $perC["atributo_per"];
		$this->attr["vit"] = $perC["atributo_vit"];
		$this->pts = $trip["atributo_sem_distribuir"];
		
		$this->hakiLvl = $trip["haki_lvl"];
		$this->hakiXp = $trip["haki_xp"];
		$this->hakiPts = $trip["haki_pontos_sem_distribuir"];
		$this->hakiMan = $trip["haki_pontos_mantra"];
		$this->hakiArm = $trip["haki_pontos_armamento"];
		$this->pontosHabilidade = $trip["pontos_habilidade"];
		
		$this->dano = $perC["dano"];
		$this->armadura = $perC["armadura"];
		
		$this->equipe = $perC["equipe"];
		
		$quadro = explode("_",$perC["quadro"]);
		$this->quadro = new Vetor($quadro[0],$quadro[1]);
	}
	
	function attBuffs(){
		$b = $this->bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem_buff ".
			"WHERE personagem_id='".$this->id."'"
		);
		foreach ($b as $key => $value) {
			$this->attr[getAtributoTabela($value["bonus_attr"])] += $value["bonus_attr_quant"];
		}
	}
	
	function setCoord($x,$y){
		$this->quadro = new Vetor($x,$y);
		
		$this->bd->query(
			"UPDATE tb_cbt_combate_personagem ".
			"SET quadro=':0:' ".
			"WHERE personagem_id='".$this->id."'",
			array($this->quadro->toString()),
			array(COORD_FORMAT)
		);
	}
	function getDano(){
		return calculaDanoAttr($this->attr["atk"])+$this->dano;
	}
	function getDefesa(){
		return calculaDanoAttr($this->attr["def"])+$this->armadura;
	}
	
	function hasHabilidade($habilidadeId){
		try{
			if($habilidadeId == "soco"){
				return getHabilidadeSoco();
			}
			else if($habilidadeId == "chute"){
				return getHabilidadeChute();
			}
			
			$has = $this->bd->fazArray(
				"SELECT * FROM tb_per_personagem_habilidade ".
				"INNER JOIN tb_per_habilidade ".
				"ON tb_per_personagem_habilidade.habilidade_id=tb_per_habilidade.habilidade_id ".
				"WHERE tb_per_personagem_habilidade.personagem_id='$this->id' AND tb_per_personagem_habilidade.habilidade_id=':0:'",
				array($habilidadeId),
				array(INT_FORMAT)
			);
			
			if(sizeof($has)==0)
				return FALSE;
			
			$cd = $this->bd->fazArray(
				"SELECT * FROM tb_cbt_combate_personagem_espera ".
				"WHERE personagem_id='".$this->id."' AND habilidade_id=':0:'",
				array($habilidadeId),
				array(INT_FORMAT)
			);
			$espera = (sizeof($cd)==0)?0:$cd[0]["espera"];
			
			$has = $has[0];
			$has["esperaRestante"] = $espera;
			return $has;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	function getHabilidades(){
		try{
			if($this->habilidades == NULL){
				$has = $this->bd->fazArray(
					"SELECT * FROM tb_per_personagem_habilidade ".
					"INNER JOIN tb_per_habilidade ".
					"ON tb_per_personagem_habilidade.habilidade_id=tb_per_habilidade.habilidade_id ".
					"WHERE tb_per_personagem_habilidade.personagem_id='$this->id' "
				);
				$cd = $this->bd->fazArray(
					"SELECT * FROM tb_cbt_combate_personagem_espera ".
					"WHERE personagem_id='".$this->id."'"
				);
				foreach ($has as $key => $value) {
					if($has[$key]["tipo"]==0){
						unset($has[$key]);
					}
					else{
						$espera = 0;
						foreach ($cd as $key2 => $value2) {
							if($value["habilidade_id"]==$value2["habilidade_id"]){
								$espera = $value2["espera"];
								break;
							}
						}
						$has[$key]["esperaRestante"] = $espera;
					}
				}
				
				$has[] = getHabilidadeSoco();
				$has[] = getHabilidadeChute();
				
				$has[] = array(
					"habilidade_id" => "movimento",
					"nome" => "Mover",
					"descricao" => "Movimenta o personagem em 1 quadro pelo tabuleiro.",
					"img" => "movimento",
					"esperaRestante" =>0
				);
				
				$this->habilidades = $has;
			}
			return $this->habilidades;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
}
