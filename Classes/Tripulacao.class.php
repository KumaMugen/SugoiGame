<?php
class Tripulacao extends Super{
	public
		$conta, //codigo da conta
		$trip, //codigo da trip
		$nome, //nome da trip
		$logado=0, //status logado
		$faccao=NULL, //faccao
		$tipoWanted, //ameaça ou gratificacao
		$reputacao, //reputacao
		$berries, //berries
		$vitorias, //nº de vitorias
		$bandeira, //codigo bandeira
		$kai, //status casco kairouseki
		$inilha,//indica se a trip esta no oceano ou dentro de ilha
		$coord, //posicao do barco
		$res; //respown
	
	private
		$capitao = NULL, //objeto personagem capitao
		$tripulantes = NULL, //array de objetos personagem tripulantes
		$navio = NULL; //objeto Navio
	protected
		$bd; //banco de dados
	
	function __construct($trip){
		try{
			global $bd;
			$this->bd = &$bd;
			$trip = ((Int)$trip);
			$trip = $this->bd->fazArray(
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
	
	protected function iniciaParametros($trip){
		$this->conta = $trip["conta_id"];
		$this->trip = ((Int)$trip["tripulacao_id"]);
		$this->nome = $trip["nome"];
		$this->logado = 1;
		$fac = $this->bd->fazArray("SELECT faccao FROM tb_usr_conta WHERE conta_id='".$trip["conta_id"]."'");
		$this->faccao = $fac[0]["faccao"];
		if($this->faccao == 0){
			$this->tipoPtsWanted = "Fama";
			$this->tipoWanted = "Gratificação";
		}
		else{
			$this->tipoPtsWanted = "Ameaça";
			$this->tipoWanted = "Recompensa";
		}
		
		$this->bandeira = $trip["bandeira"];
		$this->kai = $trip["is_kairouseki"];
		
		$this->reputacao = $trip["reputacao"];
		$this->berries = $trip["berries"];
		$this->vitorias = $trip["vitorias"];
		$this->inilha = $trip["in_ilha"];
		if($trip["coordenada_atual"]!="interno"){
			if($this->inilha!=0){
				$coord = explode("_",$trip["coordenada_atual"]);
				$this->coord = array(
					"zona" => $coord[0],
					"coord" => new Vetor($coord[1],$coord[2])
				);
			}
			else{
				$coord = explode("_",$trip["coordenada_atual"]);
				$this->coord = new Vetor($coord[0],$coord[1]);
			}
		}
		else $this->coord = "interno";
		$this->res = $trip["ilha_retorno"];
	}
	//retorna coordenada global (no mapa do oceano)
	function getCoordAtual(){
		if($this->inilha == 0) return $this->coord->toString();
		
		$c = $this->bd->fazArray("SELECT coordenada FROM tb_mun_ilha WHERE ilha_id='".$this->inilha."'");
		return $c[0]["coordenada"];
	}
	function getCapitao(){
		try{
			if(!$this->capitao){
				$cap = $this->bd->fazArray(
					"SELECT personagem_id FROM tb_usr_tripulacao_capitao ".
					"WHERE tripulacao_id='$this->trip'"
				);
				$this->capitao = new Personagem($cap[0]["personagem_id"]);
			}
			
			return $this->capitao;
		}
		catch(NotFoundException $i){
			throw new NotFoundException($i->getMessage(),$i->getDefaultResult());
		}
		catch(Exception $i){
			$this->tException($i->getMessage());
		}
	}
	function getTripulantes(){
		try{
			if(!$this->tripulantes){
				$trip = $this->bd->fazArray(
					"SELECT * FROM tb_per_personagem ".
					"WHERE tripulacao_id='$this->trip'"
				);
				foreach ($trip as $key => $value) {
					$this->tripulantes[] = new Personagem($value);
				}
			}
			return $this->tripulantes;
		}
		catch(NotFoundException $i){
			throw new NotFoundException($i->getMessage(),$i->getDefaultResult());
		}
		catch(Exception $i){
			$this->tException($i->getMessage());
		}
	}
	function getNumTripulantes(){
		if($this->tripulantes){
			$tam = sizeof($this->tripulantes);
		}
		else{
			$tam = $this->bd->fazArray(
				"SELECT personagem_id FROM tb_per_personagem ".
				"WHERE tripulacao_id='$this->trip'"
			);
			$tam = sizeof($tam);
		}
		return $tam;
	}
	function getPatente(){
		$pat = $this->bd->fazArray(
			"SELECT * FROM tb_rnk_patente ".
			"WHERE patente_id='1' "
		);
		return $pat[0]["nome_".$this->faccao];
	}
	function getBandeiraLink(){
		return "Imagens/Bandeiras/Bandeiras/".$this->bandeira.".png";
	}
	//nivel do mais forte
	function getMaisForte(){
		$cap = $this->bd->fazArray(
			"SELECT lvl FROM tb_per_personagem ".
			"WHERE tripulacao_id='$this->trip' ".
			"ORDER BY lvl DESC LIMIT 1"
		);
		return $cap[0]["lvl"];
	}
	//adiciona reputacao
	function addReputacao($rep){
		try{
			$this->reputacao += (int)$rep;
			$this->bd->query("UPDATE tb_usr_tripulacao SET reputacao=':0:' WHERE tripulacao_id='$this->trip'",array($this->reputacao),array(INT_FORMAT));
			setInSessao("tripulacao-".$this->trip,0,"reputacao",$this->reputacao);
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar reputaçao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//subtrai reputacao
	function subReputacao($rep){
		try{
			$this->reputacao -= (int)$rep;
			if($this->reputacao<0)$this->reputacao=0;
			
			$this->bd->query("UPDATE tb_usr_tripulacao SET reputacao=':0:' WHERE tripulacao_id='$this->trip'",array($this->reputacao),array(INT_FORMAT));
			setInSessao("tripulacao-".$this->trip,0,"reputacao",$this->reputacao);
		}
		catch(Exception $i){ $this->tException("Tentativa de subtrair reputaçao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//adiciona berries
	function addBerries($berries){
		try{
			$this->berries += (int)$berries;
			$this->bd->query("UPDATE tb_usr_tripulacao SET berries=':0:' WHERE tripulacao_id='$this->trip'",array($this->berries),array(INT_FORMAT));
			setInSessao("tripulacao-".$this->trip,0,"berries",$this->berries);
		}
		catch(Exception $i){ $this->tException("Tentativa de adicionar berries \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//subtrai berries
	function subBerries($berries){
		try{
			if($berries < $this->berries) $this->berries -= (int)$berries;
			else return false;
			
			$this->bd->query("UPDATE tb_usr_tripulacao SET berries=':0:' WHERE tripulacao_id='$this->trip'",array($this->berries),array(INT_FORMAT));
			setInSessao("tripulacao-".$this->trip,0,"berries",$this->berries);
			return true;
		}
		catch(Exception $i){ $this->tException("Tentativa de subtrair berries \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//seta posiçao do navio
	function setCoord($x,$y,$z=FALSE){
		try{
			if("$x"=="interno"){
				$this->coord = "interno";
				$ncoord = "interno";
			}
			else{
				if($z){
					$this->coord = array(
						"zona" => $z,
						"coord" => new Vetor($x,$y)
					);
					$ncoord = $z."_".$x."_".$y;
				}
				else{
					$this->coord = new Vetor($x,$y);
					$ncoord = $x."_".$y;
				}
			}
			$this->bd->query("UPDATE tb_usr_tripulacao SET coordenada_atual=':0:' WHERE tripulacao_id='$this->trip'",array($ncoord),array(STR_FORMAT));
			
			setInSessao("tripulacao-".$this->trip,0,"coordenada_atual",$ncoord);
		}
		catch(Exception $i){ $this->tException("Tentativa de setar posicao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	function updateCoord($inilha=TRUE,$insert=TRUE){
		try{
			if($inilha){
				$this->bd->query(
					"DELETE FROM tb_mun_ilha_zona_tripulacao ".
					"WHERE tripulacao_id='".$this->trip."'"
				);
				
				if($insert){
					if($this->coord != "interno"){
						$zona = $this->coord["zona"];
						$ncoord = $this->coord["coord"];
						
						$this->bd->query(
							"INSERT INTO tb_mun_ilha_zona_tripulacao ".
							"(ilha_id, tripulacao_id, zona, bandeira, coordenada) ".
							"VALUES ('".$this->inilha."','".$this->trip."','".$zona."',".
							"'".$this->getBandeiraLink()."','".$ncoord->toString()."')"
						);
					}
				}
			}
		}
		catch(Exception $i){ $this->tException("Tentativa de setar posicao \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//funcoes referentes ao navio
	function getNavio(){
		try{
			if(!$this->navio)
				$this->navio = new Navio($this->trip);
		}
		catch(NotFoundException $i){
			return $i->getDefaultResult();
		}
		
		return $this->navio;
	}
	
	function getCapTripulantes(){
		return (!$this->getNavio()) ? 1 : ($this->getNavio()->partes["conves"]*2);
	}
	function getCapCarga(){
		return (!$this->getNavio()) ? 50 : (50+($this->getNavio()->partes["armazem"]*5));
	}
	function getCarga(){
		$it = $this->bd->fazArray(
			"SELECT item_id FROM tb_itn_tripulacao_item WHERE tripulacao_id='".$this->trip."'"
		);
		$eq = $this->bd->fazArray(
			"SELECT equipamento_id FROM tb_itn_tripulacao_equipamento WHERE tripulacao_id='".$this->trip."'"
		);
		
		return sizeof($it)+sizeof($eq);
	}
	
	//adicionar item
	function addItem($itemId,$quant=1){
		$it = $this->bd->fazArray(
			"SELECT * FROM tb_itn_tripulacao_item ".
			"WHERE tripulacao_id='".$this->trip."' AND item_id=':0:'",
			array($itemId),
			array(INT_FORMAT),
			FALSE
		);
		if(sizeof($it)==0){
			$this->bd->query(
				"INSERT INTO tb_itn_tripulacao_item ".
				"(tripulacao_id, item_id, quant) ".
				"VALUES (':0:',':1:',':2:') ",
				array(
					$this->trip,
					$itemId,
					$quant
				),
				array(
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT
				)
			);
			return TRUE;
		}
		else{
			$nquant = $it[0]["quant"] + $quant;
			$this->bd->query(
				"UPDATE tb_itn_tripulacao_item ".
				"SET quant=':0:' ".
				"WHERE tripulacao_id='".$this->trip."' AND item_id=':1:'",
				array(
					$nquant,
					$itemId
				),
				array(
					INT_FORMAT,
					INT_FORMAT
				)
			);
			return TRUE;
		}
	}
	//remover item
	function subItem($itemId,$quant=1){
		$it = $this->bd->fazArray(
			"SELECT * FROM tb_itn_tripulacao_item ".
			"WHERE tripulacao_id='".$this->trip."' AND item_id=':0:'",
			array($itemId),
			array(INT_FORMAT),
			FALSE
		);
		
		if(sizeof($it)==0){
			return FALSE;
		}
		if($it[0]["quant"]<=$quant){
			$this->bd->query(
				"DELETE FROM tb_itn_tripulacao_item ".
				"WHERE tripulacao_id='".$this->trip."' AND item_id=':0:'",
				array(
					$itemId
				),
				array(
					INT_FORMAT
				)
			);
			return TRUE;
		}
		else{
			$nquant = $it[0]["quant"] - $quant;
			$this->bd->query(
				"UPDATE tb_itn_tripulacao_item ".
				"SET quant=':0:' ".
				"WHERE tripulacao_id='".$this->trip."' AND item_id=':1:'",
				array(
					$nquant,
					$itemId
				),
				array(
					INT_FORMAT,
					INT_FORMAT
				)
			);
			return TRUE;
		}
	}
	//adicionar equipamento
	function addEquipamento($equipamentoId,$evolucao=0,$slot1=0,$slot2=0){
		$this->bd->query(
			"INSERT INTO tb_itn_tripulacao_equipamento ".
			"(tripulacao_id, equipamento_id, evolucao, slot_1, slot_2) ".
			"VALUES (':0:',':1:',':2:',':3:',':4:') ",
			array(
				$this->trip,
				$equipamentoId,
				$evolucao,
				$slot1,
				$slot2
			),
			array(
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT
			)
		);
		return TRUE;
	}
	//remover equipamento
	function subEquipamento($equipamentoId,$evolucao=0,$slot1=0,$slot2=0){
		$this->bd->query(
			"DELETE FROM tb_itn_tripulacao_equipamento ".
			"WHERE tripulacao_id=':0:' ".
			"AND equipamento_id=':1:' ".
			"AND evolucao=':2:' ".
			"AND slot_1=':3:' ".
			"AND slot_2=':4:' LIMIT 1",
			array(
				$this->trip,
				$equipamentoId,
				$evolucao,
				$slot1,
				$slot2
			),
			array(
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT
			)
		);
		return TRUE;
	}
	
	function getItens($tb){
		if($tb != "equipamento" AND $tb != "item")
			return FALSE;
		
		$it = $this->bd->fazArray(
			"SELECT * FROM tb_itn_tripulacao_".$tb." ".
			"INNER JOIN tb_itn_".$tb." ".
			"ON tb_itn_tripulacao_".$tb.".".$tb."_id=tb_itn_".$tb.".".$tb."_id ".
			"WHERE tb_itn_tripulacao_".$tb.".tripulacao_id='".$this->trip."'"
		);
		
		return $it;
	}
	function hasItem($item){
		$i = $this->bd->fazArray(
			"SELECT * FROM tb_itn_tripulacao_item ".
			"WHERE item_id=':0:' AND tripulacao_id=':1:' LIMIT 1",
			array(
				$item,
				$this->trip
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		return (sizeof($i)==0)?FALSE:$i[0];
	}
	function hasEquipamento($equipamentoId,$evolucao=0,$slot1=0,$slot2=0){
		$i = $this->bd->fazArray(
			"SELECT * FROM tb_itn_tripulacao_equipamento ".
			"WHERE tripulacao_id=':0:' ".
			"AND equipamento_id=':1:' ".
			"AND evolucao=':2:' ".
			"AND slot_1=':3:' ".
			"AND slot_2=':4:' LIMIT 1",
			array(
				$this->trip,
				$equipamentoId,
				$evolucao,
				$slot1,
				$slot2
			),
			array(
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		return (sizeof($i)==0)?FALSE:$i[0];
	}
	
	//alianca
	function getAlianca(){
		return NULL;
	}
	
	function iniciaCombatePvE($mobID,$bg){
		//insere o combate
		$this->bd->query(
			"INSERT INTO tb_cbt_combate ".
			"(tipo,background) ".
			"VALUES ('0',':0:') ",
			array($bg),
			array(INT_FORMAT)
		);
		$id = $this->bd->lastQuery["insert_id"];
		
		//insere a tripulacao
		$this->bd->query(
			"INSERT INTO tb_cbt_combate_tripulacao ".
			"(combate_id, tripulacao_id) ".
			"VALUES (':0:',':1:') ",
			array(
				$id,
				$this->trip
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		//pega as info do mob
		$mob = $this->bd->fazArray(
			"SELECT * FROM tb_pve_mob ".
			"WHERE mob_id=':0:'",
			array(
				$mobID
			),
			array(
				INT_FORMAT
			)
		);
		//insere o mob
		$this->bd->query(
			"INSERT INTO tb_cbt_combate_mob ".
			"(combate_id, mob_id, hp) ".
			"VALUES (':0:',':1:', ':2:') ",
			array(
				$id,
				$mobID,
				$mob[0]["hp"]
			),
			array(
				INT_FORMAT,
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		//insere os personagens
		$this->insertPersonagensInCombate($id,"PvE",0);
	}
	function iniciaCombatePvP($alvo,$tipo,$bg){
		//insere o combate
		$this->bd->query(
			"INSERT INTO tb_cbt_combate ".
			"(tipo,background,tempo) ".
			"VALUES (':0:',':1:','".(atual_segundo()+TEMPO_TURNO)."') ",
			array($tipo,$bg),
			array(INT_FORMAT,INT_FORMAT)
		);
		$id = $this->bd->lastQuery["insert_id"];
		
		//insere a tripulacao
		$this->bd->query(
			"INSERT INTO tb_cbt_combate_tripulacao ".
			"(combate_id, tripulacao_id, equipe) ".
			"VALUES (':0:',':1:','0') ",
			array(
				$id,
				$this->trip
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		//insere o oponente
		$this->bd->query(
			"INSERT INTO tb_cbt_combate_tripulacao ".
			"(combate_id, tripulacao_id, equipe) ".
			"VALUES (':0:',':1:','1') ",
			array(
				$id,
				$alvo->trip
			),
			array(
				INT_FORMAT,
				INT_FORMAT
			)
		);
		
		//insere os personagens
		$this->insertPersonagensInCombate($id,"PvP",0);
		$alvo->insertPersonagensInCombate($id,"PvP",1);
	}
	
	function hasTatics(){
		return FALSE;
	}
	
	function insertPersonagensInCombate($combateId,$tipo,$equipe){
		$personagens = $this->getTripulantes();
		
		//gera posiçao do pesonagem
		$quadro = array();
		foreach ($personagens as $key => $value) {
			$bonus = $value->getAttrBonus();
			$dano = $value->getDanoArmadura();
			
			if($tipo=="PvE"){
				$ix = 0;
				$iy = 0;
				$lx = 11;
				$ly = 13;
			}
			else{
				$ix = 0;
				$lx = 14;
				if($equipe==0){
					$iy = 0;
					$ly = 5;
				}
				else{
					$iy = 6;
					$ly = 11;
				}
			}
			
			if($this->hasTatics() AND $value->hasTatic($tipo)){
				
			}
			else{
				do{
					$posok=TRUE;
					$pos[$key]["x"] = mt_rand($ix, $lx);
					$pos[$key]["y"]= mt_rand($iy, $ly);
					$posstr = $pos[$key]["x"]."_".$pos[$key]["y"];
					foreach ($quadro as $key2 => $value2) {
						if($posstr==$value2){
							$posok=FALSE;
							break;
						}
					}
				}while($posok==FALSE);
				$quadro[$key]=$posstr;
			}
			
			$this->bd->query(
				"INSERT INTO tb_cbt_combate_personagem ".
				"(combate_id, personagem_id, hp, mp, ".
				"atributo_atk, atributo_def, atributo_agl, atributo_pre, atributo_res, ".
				"atributo_des, atributo_per, atributo_vit, ".
				"dano, armadura, quadro, equipe ) ".
				"VALUES (':0:',':1:', ':2:',':3:',"
				."':4:',':5:',':6:',':7:',':8:',".
				"':9:',':10:',':11:',".
				"':12:',':13:',':14:',':15:') ",
				array(
					$combateId,
					$value->id,
					$value->hp,
					$value->mp,
					($value->attr["atk"]+$bonus["atk"]),
					($value->attr["def"]+$bonus["def"]),
					($value->attr["agl"]+$bonus["agl"]),
					($value->attr["pre"]+$bonus["pre"]),
					($value->attr["res"]+$bonus["res"]),
					($value->attr["des"]+$bonus["des"]),
					($value->attr["per"]+$bonus["per"]),
					($value->attr["vit"]+$bonus["vit"]),
					$dano["dano"],
					$dano["armadura"],
					$quadro[$key],
					$equipe
				),
				array(
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					COORD_FORMAT,
					INT_FORMAT
				)
			);
		}
	}
}
