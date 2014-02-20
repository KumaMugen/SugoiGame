<?php
	if(!isset($_GET["pers"]) OR !isset($_GET["alvo"]) OR !isset($_GET["hab"])) {
		$conteudo["erro"] = getErroFormularioIncompleto();
		return;
	}
	if(!preg_match(INT_FORMAT, $_GET["pers"]) 
	OR (!preg_match(INT_FORMAT, $_GET["hab"]) AND $_GET["hab"]!="soco" AND $_GET["hab"]!="chute")) {
		$conteudo["erro"] = getErroInformacaoInvalida("pers");
		return;
	}
	
	$alvo = explode(";",$_GET["alvo"]);
	$habilidade = $_GET["hab"];
	
	if($alvo[sizeof($alvo)-1]==""){
		unset($alvo[sizeof($alvo)-1]);
	}
	
	foreach ($alvo as $key => $value) {
		if(!preg_match(COORD_FORMAT, $value) AND $value != "npc"){
			$conteudo["erro"] = "Coordenada invalida1";
			return;
		}
	}
	
	$combateId = Usuario::inCombate();
	$combate = $bd->fazArray(
		"SELECT * FROM tb_cbt_combate ".
		"WHERE combate_id='".$combateId["combate_id"]."'"
	);
	$combate = $combate[0];
	if($combate["turno"]!=$combateId["equipe"]){
		$conteudo["erro"] = "Não é a sua vez";
		return;
	}
	
	if($combate["tipo"]==0){
		$mob = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_mob ".
			"WHERE combate_id='".$combate["combate_id"]."'"
		);
		$mob = $mob[0];
		if($mob["hp"]<=0){
			$conteudo["erro"] = "Essa batalha ja acabou";
			return;
		}
		
		$mobInfo = $bd->fazArray(
			"SELECT * FROM tb_pve_mob ".
			"WHERE mob_id='".$mob["mob_id"]."'"
		);
		$mobInfo = $mobInfo[0];
	}
	//cria objeto personagem
	try{
		$pers = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE personagem_id=':0:'",
			array($_GET["pers"]),
			array(INT_FORMAT)
		);
		if(sizeof($pers)==0){
			throw new NotFoundException("Personagem não encontrado");
		}
		
		$trip = new PersonagemCombate($pers[0]);
		$trip->attBuffs();
	}
	catch(NotFoundException $i){
		$conteudo["erro"] = $i->getMessage();
		return;
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	if($trip->codTrip != Usuario::$tripAtiva){
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	if($trip->hp <= 0){
		$conteudo["erro"] = getMsgErroPersonagem();
		return;
	}
	$hab = $trip->hasHabilidade($habilidade);
	
	if(!$hab){
		$conteudo["erro"] = "O personagem não possui essa habilidade";
		return;
	}
	if($hab["esperaRestante"]!=0){
		$conteudo["erro"] = "Habilidade em Cooldown";
		return;
	}
	if($hab["consumo"]>$trip->mp){
		$conteudo["erro"] = "Energia insuficiente";
		return;
	}
	if(sizeof($alvo)>$hab["area"]){
		$conteudo["erro"] = "Area de ataque invalida";
		return;
	}
	try{
		//inicia variaveis de log
		$update = array("log"=>"","personagens"=>array());
		$logDesc = array();
		$logAlvos = array();
		
		$trip->mp -= $hab["consumo"];
		$bd->query(
			"UPDATE tb_cbt_combate_personagem ".
			"SET mp='".$trip->mp."' ".
			"WHERE personagem_id='".$trip->id."'"
		);
		$update["personagens"][$trip->id] = array(
			"hp"=> $trip->hp,
			"hpM" => $trip->getHPMax(),
			"mp"=> $trip->mp,
			"mpM" => $trip->getMPMax(),
			"quadro" => $trip->quadro->toString(),
			"equipe" => $trip->equipe
		);
		if($combate["tipo"]!=0){
			$up = new CombateUpdate($combate["combate_id"]);
		}
		
		$allpers = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE combate_id='".$combate["combate_id"]."' AND hp>0"
		);
		$quadrosOcupados = array();
		$personagensAtingidos = array();
		foreach ($allpers as $key => $value) {
			$quadrosOcupados[] = $value["quadro"];
			
			if(in_array($value["quadro"], $alvo))
				$personagensAtingidos[] = $value;
		}
		//inicia a rodada
		if(!verificaAlcanceHabilidade($alvo,$trip,$hab,$quadrosOcupados)){
			$conteudo["erro"] = "Coordenada inválida";
			return;
		}
		
		//causa dano aos personagens
		foreach ($personagensAtingidos as $key => $value) {
			$perAtingido = new PersonagemCombate($value);
			$logAlvos[$key] = array(
				"id" => $perAtingido->id,
				"nome" => $perAtingido->nome,
				"SkinR" => $perAtingido->getSkinR(),
				"quadro" => $perAtingido->quadro->toString(),
				"vazio"=>FALSE
			);
			$logDesc[$key]="";
			if($hab["tipo"]==1){
				$perAtingido->attBuffs();
				
				$esq = esquivar($perAtingido->attr["agl"], $trip->attr["pre"], $perAtingido->hakiMan);
				if(!$esq){
					$d = calculaDanoInCbt($trip, $perAtingido, $hab);
					$dano = $d["dano"];
					
					$perAtingido->hp -= $dano;
					
					if($perAtingido->hp<0)$perAtingido->hp=0;
					
					$bd->query(
						"UPDATE tb_cbt_combate_personagem ".
						"SET hp='".$perAtingido->hp."' ".
						"WHERE personagem_id='".$perAtingido->id."'"
					);
					
					//informacao de update para jogador
					$update["personagens"][$perAtingido->id] = array(
						"hp"=> $perAtingido->hp,
						"hpM" => $perAtingido->getHPMax(),
						"mp"=> $perAtingido->mp,
						"mpM" => $perAtingido->getMPMax(),
						"quadro" => $perAtingido->quadro->toString(),
						"equipe" => $perAtingido->equipe
					);
					//informacao de update para oponente
					if($combate["tipo"]!=0){
						$acao = array(
							"tipo"=>0,
							"equipe"=>$perAtingido->equipe,
							"pers"=>$perAtingido->id,
							"hp"=> $perAtingido->hp,
							"hpM" => $perAtingido->getHPMax(),
							"mp"=> $perAtingido->mp,
							"mpM" => $perAtingido->getMPMax(),
							"quadro" => $perAtingido->quadro->toString(),
						);
						
						$up->addAcao($acao);
					}
					
					//log
					$bloq = $d["bloq"];
					$cri = $d["cri"];
					if($bloq)
						$logDesc[$key] .= SPAN_BLOQUEIO;
					$logDesc[$key].=" perdeu <b>".$dano."</b> pontos de vida";
					if($perAtingido->hp==0){
						$logDesc[$key].= SPAN_DERROTADO;
						
						if($combate["tipo"]!=0){
							//$trip->setScore(true,$perAtingido->getClasseScore());
							//$perAtingido->setScore(false,$trip->getClasseScore());
						}
					}
					
					if($cri)
						$logDesc[$key] .= SPAN_CRITICO;
				}
				else{
					$logDesc[$iLogNPC] .= SPAN_ESQUIVA;
				}
			}
			else if($hab["tipo"]==2){
				$bd->query(
					"INSERT INTO tb_cbt_combate_personagem_buff ".
					"(combate_id, personagem_id, bonus_attr, bonus_attr_quant, duracao) ".
					"VALUES ".
					"('".$combate["combate_id"]."','".$value["personagem_id"]."',".
					"'".$hab["bonus_attr"]."','".$hab["bonus_attr_quant"]."','".($hab["duracao"]+1)."')"
				);
				
				$logDesc[$key].=" Recebeu <b>".$hab["bonus_attr_quant"]."</b> pontos em ".getAtributoNome($hab["bonus_attr"]);
			}
		}
		if(in_array("npc", $alvo)){
			$iLogNPC = sizeof($logAlvos);
			$logAlvos[$iLogNPC] = array(
				"id" => "npc",
				"nome" => $mobInfo["nome"],
				"SkinR" => 0,
				"quadro" => "npc",
				"vazio"=>FALSE
			);
			$logDesc[$iLogNPC] = "";
			if($hab["tipo"]==1){
				$esq = esquivar($mobInfo["agl"], $trip->attr["pre"], 0);
				if(!$esq){
					$npc = new MobCombate($mobInfo,$mob);
					
					$d = calculaDanoInCbt($trip, $npc, $hab);
					$dano = $d["dano"];
					
					$npc->hp -= $dano;
					
					if($npc->hp<0)$npc->hp=0;
					$mob["hp"]=$npc->hp;
					
					$bd->query(
						"UPDATE tb_cbt_combate_mob ".
						"SET hp='".$npc->hp."' ".
						"WHERE combate_id='".$combate["combate_id"]."'"
					);
					
					$update["npc"] = array(
						"hp"=> $npc->hp,
						"hpM" => $mobInfo["hp"]
					);
					
					//log
					$bloq = $d["bloq"];
					$cri = $d["cri"];
					if($bloq)
						$logDesc[$iLogNPC] .= SPAN_BLOQUEIO;
					$logDesc[$iLogNPC].=" perdeu <b>".$dano."</b> pontos de vida";
					if($npc->hp==0)$logDesc[$iLogNPC].= SPAN_DERROTADO;
					
					if($cri)
						$logDesc[$iLogNPC] .= SPAN_CRITICO;
				}
				else{
					$logDesc[$iLogNPC] .= SPAN_ESQUIVA;
				}
			}
			else{
				$logDesc[$iLogNPC].=" Recebeu <b>0</b> pontos em ".getAtributoNome($hab["bonus_attr"]);
			}
		}
		if($combate["tipo"]==0){
			$turno=0;
			$tempo=0;
		}
		else{
			if($combateId["equipe"]==0)$turno=1;
			else $turno=0;
			
			$tempo=atual_segundo()+TEMPO_TURNO;
		}
		//insere cd de skill
		if($hab["espera"]>0){
			$bd->query(
				"INSERT INTO tb_cbt_combate_personagem_espera ".
				"(combate_id, personagem_id, habilidade_id, espera) ".
				" VALUES (':0:',':1:',':2:',':3:')",
				array(
					$combate["combate_id"],
					$trip->id,
					$hab["habilidade_id"],
					$hab["espera"]+1
				),
				array(
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT,
					INT_FORMAT
				)
			);
		}
		
		//finaliza Turno
		$bd->query(
			"UPDATE tb_cbt_combate ".
			"SET movimentos='5', turno='$turno', rodadas=rodadas+1, tempo='$tempo' ".
			"WHERE combate_id='".$combate["combate_id"]."'"
		);
		
		//insere log
		$logAtacante = array(
			"id"=>$trip->id,
			"nome"=>$trip->nome,
			"SkinR"=>$trip->getSkinR(),
			"quadro" => $trip->quadro->toString()
		);
		foreach ($alvo as $key => $value) {
			if($value!="npc")
				if(!in_array($value, $quadrosOcupados)){
					$i = sizeof($logAlvos);
					$logAlvos[$i] = array(
						"id" => "0",
						"nome" => "",
						"SkinR" => 0,
						"quadro" => $value,
						"vazio"=>TRUE
					);
					$logDesc[$i] = "";
				}
		}
		
		$log = new CombateLog($combate["combate_id"],($combate["tipo"]==0)?"PvE":"PvP");
		
		$update["log"] = $log->formataRegistro($logAtacante,$logAlvos,$hab,$logDesc,$combateId["equipe"]);
		
		$log->insere($update["log"]);
		
		if($combate["tipo"]==0 && $mob["hp"]>0){
			$a = turnoNPC($combate["combate_id"],array_merge($mob,$mobInfo), $allpers,$log);
			$update["log"] = $a["log"].$update["log"];
			$update["personagens"] = array_merge($update["personagens"],$a["personagens"]);
		}
		if($combate["tipo"]!=0){
			$acao = array(
				"tipo"=>2,
				"log"=>$update["log"]
			);
			
			$up->addAcao($acao);
			
			$acao = array(
				"tipo"=>3,
				"turno"=>$turno,
				"movimentos"=>5,
				"tempo"=>$tempo,
			);
			
			$up->addAcao($acao);
		}
		
		$conteudo["retorno"] = $update;
		
		cbtAtualizaEspera($combate["combate_id"]);
		cbtAtualizaBuffs($combate["combate_id"]);
	}
	catch(Exception $i){
		$conteudo["mensagem"] = $i->getMessage();
		return;
	}
	$exibeInfoGeral[0] = 1;