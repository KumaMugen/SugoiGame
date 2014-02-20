<?php
Class Personagem extends Super{
	public
		$codTrip, //codigo da tripulacao do personagem
		$id, //codigo do personagem
		$nome, //nome do personagem
		$img,  //img do personagem
		$imgR, //Skin rosto do personagem
		$imgC, //Skin corpo do personagem
		$hp, //hp
		$hpMax, //hp maxima
		$mp, //energia
		$mpMax, //energia maxima
		$xp, //experiencia
		$xpMax, //experiencia maxima
		$FA, //fama / ameaça
		$procurado, //possui cartaz de procurado
		$lvl, //nivel
		$classe = NULL, //classe 0 = sem, 1 = Espadachim, 2 = Lutador, 3 = atirador
		$classeScore = NULL, //Score de classe
		$prof = NULL, //Profissao
		$profLvl = NULL, //nivel de profissao
		$profXp = NULL, //xp de profissao
		$profXpMax = NULL, // xp maxima de profissao
		$attr = array(
			"atk" =>0,
			"def" =>0,
			"agl" =>0,
			"res" =>0,
			"pre" =>0,
			"des" =>0,
			"per" =>0,
			"vit" =>0
		), 
		$attrBonus = array(
			"atk" =>0,
			"def" =>0,
			"agl" =>0,
			"res" =>0,
			"pre" =>0,
			"des" =>0,
			"per" =>0,
			"vit" =>0
		),
		$dano = NULL, //dano de equip
		$armadura = NULL, //armadura de equip
		$tratamento = NULL, //Tratamento Hospital
		$descansando = NULL, //Tratamento pousada
		$pts, //atributos
		$hakiLvl, $hakiXp, $hakiXpMax, $hakiPts, $hakiMan, $hakiArm, //haki
		$pontosHabilidade,//skilss
		$habilidades = NULL,//array com as habilidades (id e nome)
		$habilidadesPontos = NULL, //array com os pontos em habilidades
		$equipamentos = NULL,//equipamentos
		$acessorio;//Acessorio
	
	private $bd; //banco de dados
	
	function __construct($cod){
		global $bd;
		$this->bd = &$bd;
		if(gettype($cod)!="array"){
			try{
				$personagem = $this->bd->fazArray("SELECT * FROM tb_per_personagem WHERE personagem_id=':0:'",array($cod),array(INT_FORMAT),FALSE);
			}
			catch(Exception $i){ $this->tException("Tentativa de criar personagem $cod\n".$i->getMessage()."\n".$i->getTraceAsString()); }
		}
		else{
			$personagem[] = $cod;
		}
		if(sizeof($personagem)==1){
			$this->iniciaParametros($personagem[0]);
		}
		else{
			throw new NotFoundException("Personagem $cod nao encontrado");
		}
	}
	
	private function iniciaParametros($trip){
		$this->codTrip = $trip["tripulacao_id"];
		$this->id = $trip["personagem_id"];
		$this->nome = $trip["nome"];
		
		$this->img = $trip["imagem"];
		$this->imgR =$trip["skin_rosto"];
		$this->imgC = $trip["skin_corpo"];
		
		$this->xp = $trip["xp"];
		$this->lvl = $trip["lvl"];
		$this->hp = $trip["hp"];
		$this->mp = $trip["mp"];
		
		$this->FA = $trip["fama_ameaca"];
		$this->procurado = ($trip["is_procurado"] == 1) ? TRUE : FALSE;
		
		$this->attr["atk"] = $trip["atributo_atk"];
		$this->attr["def"] = $trip["atributo_def"];
		$this->attr["agl"] = $trip["atributo_agl"];
		$this->attr["res"] = $trip["atributo_res"];
		$this->attr["pre"] = $trip["atributo_pre"];
		$this->attr["des"] = $trip["atributo_des"];
		$this->attr["per"] = $trip["atributo_per"];
		$this->attr["vit"] = $trip["atributo_vit"];
		$this->pts = $trip["atributo_sem_distribuir"];
		
		$this->hakiLvl = $trip["haki_lvl"];
		$this->hakiXp = $trip["haki_xp"];
		$this->hakiPts = $trip["haki_pontos_sem_distribuir"];
		$this->hakiMan = $trip["haki_pontos_mantra"];
		$this->hakiArm = $trip["haki_pontos_armamento"];
		$this->pontosHabilidade = $trip["pontos_habilidade"];
	}
	//pega string de img do personagem
	function getSkinR(){ return $this->img."(".$this->imgR.")"; }
	function getSkinC(){ return $this->img."(".$this->imgC.")"; }
	function getHPMax(){
		return 100*$this->lvl + 900 + ($this->attr["vit"]-1+$this->attrBonus["vit"])*15;
	}
	function getMPMax(){
		return 15*$this->lvl + 85 + ($this->attr["vit"]-1+$this->attrBonus["vit"])*7;
	}
	function getXPMax(){
		return (1000+$this->lvl*1000)*$this->lvl/2;
	}
	//addXP
	function addXp($quant){
		try{
			$this->xp += (INT)$quant;
			$this->bd->query("UPDATE tb_per_personagem SET xp=':0:' WHERE personagem_id='$this->id'",array($this->xp),array(INT_FORMAT));
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar xp \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//aumenta fama/ameaca
	function addFA($quant){
		try{
			$this->FA += (INT)$quant;
			$this->bd->query("UPDATE tb_personagens SET fama_ameaca=':0:' WHERE cod='$this->id'",array($this->FA),array(INT_FORMAT));
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar FA \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//get Classe
	function getClasse(){
		try{
			if($this->classe === NULL){
				$class= $this->bd->fazArray("SELECT * FROM tb_per_personagem_classe WHERE personagem_id='$this->id'",array(),array(),FALSE);
				if(sizeof($class)==0)$this->classe = 0;
				else{
					$this->classe = $class[0]["classe_id"];
					$this->classeScore = $class[0]["score"];
				}
			}
			return getClasse($this->classe);
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function getClasseScore(){
		try{
			if($this->classeScore === NULL){
				$class= $this->bd->fazArray("SELECT * FROM tb_per_personagem_classe WHERE personagem_id='$this->id'",array(),array(),FALSE);
				if(sizeof($class)==0)$this->classeScore = 0;
				else{
					$this->classe = $class[0]["classe_id"];
					$this->classeScore = $class[0]["score"];
				}
			}
			return (INT)$this->classeScore;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function setScore($add,$scoreAdv){
		try{
			if($this->classe!=0){
				if($add){
					$score = $this->classeScore;
					if($score < 3000)
						$score = (pow((3000-$score),(1/2))/2);
					else
						$score = (1/pow(($score/1000),(2)));
					
					$mod_score = $scoreAdv - $this->classeScore;
					$mod_score /= 1000;
					$mod_score *= 0.3;
					$mod_score += 1;
					
					$score *= $mod_score;
					if($score < 0)$score = 0;
					
					$this->classeScore += $score;
				}
				else{
					$score = pow((4*$this->classeScore),(1/2));
					
					$mod_score = $scoreAdv - $this->classeScore;
					$mod_score /= 1000;
					$mod_score *= 0.3;
					$mod_score = 1 - $mod_score;
					
					$score *= $mod_score;
					if($score<0)$score=0;
					
					$this->classeScore -= $score;
				}
				$this->bd->query("UPDATE tb_per_personagem_classe SET score=':0:' WHERE personagem_id='$this->id'",array($this->classeScore),array("//"));
			}
		}
		catch(Exception $i){ $this->tException("Tentativa de alterar score \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function getProf(){
		try{
			if($this->prof === NULL){
				$class= $this->bd->fazArray("SELECT profissao_id FROM tb_per_personagem_profissao WHERE personagem_id='$this->id'");
				if(sizeof($class)==0)$this->prof = 0;
				else $this->prof = $class[0]["classe_id"];
			}
			return getProfissao($this->prof);
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function getProfXP(){
		try{
			if($this->profXp === NULL){
				$class= $this->bd->fazArray("SELECT xp FROM tb_per_personagem_profissao WHERE personagem_id='$this->id'");
				if(sizeof($class)==0)$this->profXp = 0;
				else $this->profXp = $class[0]["xp"];
			}
			return $this->profXp;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function getProfXPMax(){
		try{
			if($this->profXpMax === NULL){
				$class= $this->bd->fazArray("SELECT xp_max FROM tb_per_personagem_profissao WHERE personagem_id='$this->id'");
				if(sizeof($class)==0)$this->profXpMax = 0;
				else $this->profXpMax = $class[0]["xp_max"];
			}
			return $this->profXpMax;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function getProfLVL(){
		try{
			if($this->profLvl === NULL){
				$class= $this->bd->fazArray("SELECT lvl FROM tb_per_personagem_profissao WHERE personagem_id='$this->id'");
				if(sizeof($class)==0)$this->profLvl = 0;
				else $this->profLvl = $class[0]["lvl"];
			}
			return $this->profLvl;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	function addXpProfissao($quant){
		try{
			$this->profXp += (INT)$quant;
			if($this->profXp > $this->profXpMax) $this->profXp = $this->profXpMax;
			$this->bd->query("UPDATE tb_per_personagem_profissao SET xp=':0:' WHERE personagem_id='$this->id'",array($this->profXp),array(INT_FORMAT));
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar xp de profissao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	function getHabilidades(){
		try{
			if($this->habilidades === NULL){
				$has = $this->bd->fazArray(
					"SELECT * FROM tb_per_personagem_habilidade ".
					"INNER JOIN tb_per_habilidade ".
					"ON tb_per_personagem_habilidade.habilidade_id=tb_per_habilidade.habilidade_id ".
					"WHERE tb_per_personagem_habilidade.personagem_id='$this->id' "
				);
				$has[] = getHabilidadeSoco();
				$has[] = getHabilidadeChute();
				
				$this->habilidades = $has;
			}
			return $this->habilidades;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	function hasHabilidade($habilidadeId){
		if($habilidadeId == "soco" OR $habilidadeId == "chute")
			return TRUE;
			
		try{
			$hab = $this->getHabilidades();
			
			foreach ($hab as $key => $value) {
				if($habilidadeId == $value["habilidade_id"])
					return TRUE;
			}
			
			return FALSE;
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar xp de profissao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	function getArvoreHabilidade(){
		try{
			if($this->habilidadesPontos === NULL){
				$has = $this->bd->fazArray(
					"SELECT * FROM tb_per_personagem_habilidade_ponto ".
					"WHERE personagem_id='$this->id' "
				);
				
				$this->habilidadesPontos = $has;
			}
			return $this->habilidadesPontos;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	function getPontosInHabilidade($habilidadeId){
		try{
			$hab = $this->getArvoreHabilidade();
			$quant = 0;
			foreach ($hab as $key => $value) {
				if($habilidadeId == $value["habilidade_id"]){
					$quant = $value["pontos"];
					break;
				}
			}
			
			return $quant;
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar xp de profissao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	//equipamentos
	function getEquipamentos(){
		try{
			if($this->equipamentos === NULL){
				$has = $this->bd->fazArray(
					"SELECT * FROM tb_per_personagem_equipamento ".
					"INNER JOIN tb_itn_equipamento ".
					"ON tb_per_personagem_equipamento.equipamento_id=tb_itn_equipamento.equipamento_id ".
					"WHERE tb_per_personagem_equipamento.personagem_id='$this->id' "
				);
				
				$this->equipamentos = $has;
			}
			return $this->equipamentos;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	function getAcessorio(){
		try{
			if($this->acessorio === NULL){
				$has = $this->bd->fazArray(
					"SELECT * FROM tb_per_personagem_acessorio ".
					"INNER JOIN tb_itn_item ".
					"ON tb_per_personagem_acessorio.item_id=tb_itn_item.item_id ".
					"WHERE tb_per_personagem_acessorio.personagem_id='$this->id' "
				);
				
				$this->acessorio = $has;
			}
			return $this->acessorio;
		}
		catch(Exception $i){ $this->tException($i->getMessage()."\n".$i->getTraceAsString()); }
	}
	
	function getAttrBonus(){
		$habilidades = $this->getHabilidades();
		$equipamentos = $this->getEquipamentos();
		$acessorio = $this->getAcessorio();
		
		if(sizeof($acessorio)!=0){
			for ($x=1; $x < 9; $x++) { 
				$this->attrBonus[getAtributoTabela($x)] += $acessorio[0]["bonus_".getAtributoTabela($x)];
			}
		}
		
		foreach ($habilidades as $key => $value) {
			if($value["tipo"]==0){
				$this->attrBonus[getAtributoTabela($value["bonus_attr"])] += $value["bonus_attr_quant"];
			}
		}
		
		foreach ($equipamentos as $key => $value) {
			if($value["slot_1"]!=0){
				$this->attrBonus[getAtributoTabela($value["slot_1"])] += 1;
			}
			
			if($value["slot_2"]!=0){
				$this->attrBonus[getAtributoTabela($value["slot_2"])] += 1;
			}
		}
		return $this->attrBonus;
	}
	
	function getDanoArmadura(){
		if($this->dano === NULL){
			$this->dano = 0;
			$this->armadura = 0;
			
			$equipamentos = $this->getEquipamentos();
			
			foreach ($equipamentos as $key => $value) {
				if($value["tipo_efeito"]==0)
					$this->dano += calculaEfeitoEquipamento($value);
				else
					$this->armadura += calculaEfeitoEquipamento($value);
			}
		}
		return array("dano"=>$this->dano,"armadura"=>$this->armadura);
	}
	
	function hasTatic($tipo){
		return FALSE;
	}
	
	function inTratamento(){
		if($this->tratamento === NULL){
			$t = $this->bd->fazArray(
				"SELECT * FROM tb_hos_personagem ".
				"WHERE personagem_id='".$this->id."'"
			);
			
			$this->tratamento=(sizeof($t)==0)?FALSE:$t[0]["finalizacao"];
		}
		return $this->tratamento;
	}
}
