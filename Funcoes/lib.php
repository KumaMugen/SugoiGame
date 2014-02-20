<?php
	function encriptaSenha($senha){
		for($x=0;$x<10;$x++)$senha = md5($senha);
		return $senha;
	}
	function getRecompensa($pts){
		return $pts*20000;
	}
	function getMar($coord){
		$coord = explode("_", $coord);
		return 1;
	}
	function formataCoord($coord){
		$coord = explode("_", $coord);
		return $coord[0]."º L, ".$coord[1]."º N";
	}
	function getNomeIlha($ilha){
		global $bd;
		try{
			$i = $bd->fazArray(
				"SELECT nome FROM tb_mun_ilha WHERE ilha_id=':0:'",
				array($ilha),
				array(INT_FORMAT)
			);
		}
		catch(Exception $i){
			global $erro;
			
			$erro->insere($i->getMessage());
			return 0;
		}
		return $i[0]["nome"];
	}
	function getNomeMar($mar){
		switch ($mar) {
			case 1: return "East Blue"; break;
			case 2: return "North Blue"; break;
			case 3: return "South Blue"; break;
			case 4: return "West Blue"; break;
			case 5: return "Grand Line"; break;
			case 7: return "Novo Mundo"; break;
			case 8: return "Calm Belt"; break;
			default: return ""; break;
		}
	}
	function processaRestricoes($restricao,&$include,&$conteudo){
		//logado
		if($restricao["logado"]==0 AND Usuario::$logado){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroDeslogado();
			return;
		}
		if($restricao["logado"]==1 AND !Usuario::$logado){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroLogado();
			return;
		}
		
		//tripulacao selecionada
		if($restricao["tripativa"]==0 AND Usuario::$tripAtiva != 0){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroComTrip();
			return;
		}
		if($restricao["tripativa"]==1 AND Usuario::$tripAtiva == 0){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroSemTrip();
			return;
		}
		
		//combate
		if($restricao["combate"]==0 AND Usuario::inCombate()){
			$include = FALSE;
			$conteudo["combate"] = TRUE;
			return;
		}
		if($restricao["combate"]==1 AND !Usuario::inCombate()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroOutCombate();
			return;
		}
		
		//ilha
		if($restricao["ilha"]==0 AND Usuario::inIlha() != 0){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroInIlha();
			return;
		}
		if($restricao["ilha"]==1 AND Usuario::inIlha() == 0){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroOutIlha();
			return;
		}
		
		//navio
		if($restricao["navio"]==0 AND Usuario::getTrip()->getNavio() != 0){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroInNavio();
			return;
		}
		if($restricao["navio"]==1 AND Usuario::getTrip()->getNavio() == 0){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroOutNavio();
			return;
		}
		
		//missao
		if($restricao["missao"]==0 AND Usuario::inMissao()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroInMissao();
			return;
		}
		if($restricao["missao"]==1 AND !Usuario::inMissao()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroOutMissao();
			return;
		}
		
		//recrutamento
		if($restricao["recrutamento"]==0 AND Usuario::inRecrutamento()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroInRecrutamento();
			return;
		}
		if($restricao["recrutamento"]==1 AND !Usuario::inRecrutamento()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroOutRecrutamento();
			return;
		}
		
		//navegando
		if($restricao["rota"]==0 AND Usuario::inRota()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroInRota();
			return;
		}
		if($restricao["rota"]==1 AND !Usuario::inRota()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroOutRota();
			return;
		}
		
		//derrotado
		if($restricao["derrotado"]==0 AND Usuario::isDerrotado()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroIsDerrotado();
			return;
		}
		if($restricao["derrotado"]==1 AND !Usuario::isDerrotado()){
			$include = FALSE;
			$conteudo["erro"] = getMsgErroNotDerrotado();
			return;
		}
	}
	//verifica se o usuario está no mar indicado de acordo com os codigos de tabela
	function correspondeMar($mar){
		$marEu = getMar(Usuario::getTrip()->getCoordAtual());
		
		if($mar==8)
			return TRUE;
		else if($mar == 7)
			return ($marEu <= 4 && $marEu >= 1)? TRUE : FALSE;
		else if($mar != 0)
			return ($marEu==$mar)? TRUE : FALSE;
		else
			return NULL;
	}
	function controleSessao($indice,$query,$values,$formatos){
		if(!isset($_SESSION[$indice])){
			global $bd;
			$a = $bd->fazArray( $query, $values, $formatos );
			$_SESSION[$indice] = $a;
		}
		return $_SESSION[$indice];
	}
	function setInSessao($indice,$subindice,$campo,$value){
		if(!isset($_SESSION[$indice]))
			return FALSE;
		$_SESSION[$indice][$subindice][$campo] = $value;
		return TRUE;
	}
	function verificaAlcanceHabilidade($alvo,$pers,$hab,$quadros){
		$ok = FALSE;
		foreach ($alvo as $key => $value) {
			if($key == 0){
				if($value=="npc" AND ($pers->quadro->x - $hab["alcance"])<0){
					return TRUE;
				}
				else if($value=="npc")
					return FALSE;
				else{
					$qx = $pers->quadro->x;
					$qy = $pers->quadro->y;
					$c = explode("_", $value);
					
					$dirV = $qx - $c[0];
					$dirH = $qy - $c[1];
					
					$dirV = ($dirV>0)?(-1):(($dirV==0)?(0):(1));
					$dirH = ($dirH>0)?(-1):(($dirH==0)?(0):(1));
					for( $x = $qx+$dirV, $y=$qy+$dirH; 
							($dirV>0 AND $x<=$qx+$hab["alcance"])
							OR ($dirV<0 AND $x>=$qx-$hab["alcance"])
							OR ($dirH>0 AND $y<=$qy+$hab["alcance"])
							OR ($dirH<0 AND $y>=$qy-$hab["alcance"]);
								$x += $dirV, $y += $dirH){
						$coord = $x."_".$y;
						
						if($coord == $value){
							$ok = TRUE;
							$match = $coord;
							break;
						}
						if(in_array($coord, $quadros))
							break;
					}
				}
				if(!$ok)
					return FALSE;
			}
			else{
				$c = array();
				$c = explode("_", $match);
				
				if($c[0]==0 AND $value=="npc")
					return TRUE;
				else if($value=="npc")
					return FALSE;
				
				$v = array();
				$v = explode("_", $value);
				
				if(abs($c[0]-$v[0])>1 OR abs($c[1]-$v[1]>1)){
					return FALSE;
				}
				$match = $value;
			}
		}
		return $ok;
	}

	function calculaDanoAttr($attr){
		return $attr*10;
	}
	function esquivar($agl,$pre,$haki){
		$ch = $agl-$pre;
		if($ch<0)$ch=0;
		if($ch>50)$ch=50;
		
		$ch += $haki;
		
		$sort = rand(1,100);
		return ($sort<=$ch)?TRUE:FALSE;
	}
	function calculaDanoBloqueado($dano,$bloq){
		$dano = (1-($bloq/100))*$dano;
		
		return $dano;
	}
	function bloquear($res,$pre,$haki){
		$ch = $res-$pre;
		if($ch<0)$ch=0;
		if($ch>50)$ch=50;
		
		$ch += $haki;
		
		$sort = rand(1,100);
		if($sort>$ch) return FALSE;
		
		$res = rand(1,$ch);
		
		return $res+20;
	}
	
	function calculaDanoCritado($dano,$cri){
		$dano = ($cri/100*$dano)+$dano;
		
		return $dano;
	}
	function critar($des,$per,$haki){
		$ch = $des-$per;
		if($ch<0)$ch=0;
		if($ch>50)$ch=50;
		
		$ch += $haki;
		
		$sort = rand(1,100);
		if($sort>$ch) return FALSE;
		
		$res = rand(1,$ch);
		
		return $res+25;
	}
	
	function turnoNPC($combateId,$mob,$pers,$log){
		$p = rand(0,sizeof($pers)-1);
		
		$per = new PersonagemCombate($pers[$p]);
		$per->attBuffs();
		
		global $bd;
		
		$logAlvos[0] = array(
			"id" => $per->id,
			"nome" => $per->nome,
			"SkinR" => $per->getSkinR(),
			"quadro" => $per->quadro->toString(),
			"vazio"=>FALSE
		);
		$logDesc[0] = "";
		$logAtacante = array(
			"id"=>"npc",
			"nome"=>$mob["nome"],
			"SkinR"=>0,
			"quadro" => "npc"
		);
		$hab = array(
			"img" => $mob["img_habilidade"],
			"nome" => $mob["nome_habilidade"],
			"descricao" => $mob["descricao_habilidade"],
			"dano" => $mob["dano_habilidade"]
		);
		
		$esq = esquivar($per->attr["agl"], $mob["pre"], $per->hakiMan);
		if(!$esq){
			
			$npc = new MobCombate($mob,$mob);
			
			$d = calculaDanoInCbt($npc, $per, $hab);
			$dano = $d["dano"];
			
			$per->hp -= $dano;
			
			if($per->hp<0)$per->hp=0;
			
			$bd->query(
				"UPDATE tb_cbt_combate_personagem ".
				"SET hp='".$per->hp."' ".
				"WHERE personagem_id='".$per->id."'"
			);
			
			$update["personagens"][$per->id] = array(
				"hp"=> $per->hp,
				"hpM" => $per->getHPMax(),
				"mp"=> $per->mp,
				"mpM" => $per->getMPMax(),
				"quadro" => $per->quadro->toString(),
				"equipe" => $per->equipe
			);
			
			//log
			$bloq = $d["bloq"];
			$cri = $d["cri"];
			if($bloq)
				$logDesc[0] .= SPAN_BLOQUEIO;
			$logDesc[0].=" perdeu <b>".$dano."</b> pontos de vida";
			if($per->hp==0)$logDesc[0].= SPAN_DERROTADO;
			
			if($cri)
				$logDesc[0] .= SPAN_CRITICO;
		}
		else{
			$logDesc[0] .= SPAN_ESQUIVA;
		}
		$update["log"] = $log->formataRegistro($logAtacante,$logAlvos,$hab,$logDesc,1);
		
		$log->insere($update["log"]);
		
		return $update;
	}
	function cbtAtualizaBuffs($id){
		global $bd;
		$bd->query(
			"UPDATE tb_cbt_combate_personagem_buff ".
			"SET duracao=duracao-1 ".
			"WHERE combate_id=':0:'",
			array($id),
			array(INT_FORMAT)
		);
		$bd->query(
			"DELETE FROM tb_cbt_combate_personagem_buff ".
			"WHERE duracao='0'"
		);
	}
	function cbtAtualizaEspera($id){
		global $bd;
		$bd->query(
			"UPDATE tb_cbt_combate_personagem_espera ".
			"SET espera=espera-1 ".
			"WHERE combate_id=':0:'",
			array($id),
			array(INT_FORMAT)
		);
		$bd->query(
			"DELETE FROM tb_cbt_combate_personagem_espera ".
			"WHERE espera='0'"
		);
	}
	function calculaDanoInCbt($atacante,$atingido,$hab){
		$defesa = $atingido->getDefesa();
		
		$dano = $atacante->getDano()-$defesa;
		if($dano<0)$dano=0;
		
		$bloq = bloquear($atingido->attr["res"], $atacante->attr["pre"], $atingido->hakiArm);
		if($bloq)
			$dano = calculaDanoBloqueado($dano,$bloq);
		
		$cri = critar($atacante->attr["des"], $atingido->attr["per"], $atacante->hakiArm);
		if($cri)
			$dano = calculaDanoCritado($dano,$cri);
		
		$dano += $hab["dano"];
		$dano = (Int)$dano;
		
		return array("dano"=>$dano,"bloq"=>$bloq,"cri"=>$cri);
	}
	function getXPByNivel($lvl){
		return (1000+$lvl*1000)*$lvl/2;
	}
	
