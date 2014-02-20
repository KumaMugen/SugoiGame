<?php
class Usuario extends Super{
	static 
		$id, //ID da conta
		$nome,
		$logado=FALSE, //status logado
		$faccao=NULL, //faccao do jogador
		$tripAtiva=0, //tripulaçao selecionada
		$vip=FALSE,
		$gold,
		$permissao=2,
		$combate = NULL,
		$inMissao = NULL,
		$inRecrutamento = NULL,
		$isDerrotado = NULL,
		$missaoList = array();
		
	private static 
		$inIlha = 0,
		$inCombate = NULL,
		$inRota = NULL,
		$tripulacao = NULL;
		
	private $bd; //banco de dados
	//construtor
	function __construct($id,$cookie){
		try{
			global $bd;
			$this->bd = &$bd;
			try{
				$usr = $this->bd->fazArray(
					"SELECT * FROM tb_usr_conta_cookie ".
					"WHERE conta_id=':0:'",
					array($id),
					array(INT_FORMAT)
				);
			}
			catch(Exception $i){
				throw new Exception($i->getMessage());
			}
			
			if(sizeof($usr)==1 && $usr[0]["cookie_id"]==$cookie){
				$usr = controleSessao(
					"conta",
					"SELECT * FROM tb_usr_conta ".
					"WHERE conta_id=':0:'",
					array($usr[0]["conta_id"]),
					array(INT_FORMAT)
				);
				if(sizeof($usr)==1){
					if($usr[0]["is_ativado"]=="0")
						$this->iniciaParametros($usr[0]);
				}
			}
			else{
				throw new NotFoundException("Usuario nao encontrado");
			}
		}
		catch(Exception $i){ $this->tException("Tentativa de criar usuario $id\n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//popula as propriedades do objeto
	function iniciaParametros($usr){
		global $bd;
		$this->bd = &$bd;
		try{
			$this->bd->query(
				"UPDATE tb_usr_conta ".
				"SET data_login=NOW(), ip='".$_SERVER["REMOTE_ADDR"]."' ".
				"WHERE conta_id='".$usr["conta_id"]."'"
			);
			Usuario::$logado = TRUE;
			Usuario::$id = $usr["conta_id"];
			Usuario::$faccao = $usr["faccao"];
			Usuario::$vip = $usr["is_vip"];
			Usuario::$gold = $usr["gold"];
			Usuario::$nome = $usr["nome"];
			Usuario::$permissao = $usr["permissao"];
			$trip = controleSessao(
				"conta_tripulacao",
				"SELECT * FROM tb_usr_conta_tripulacao ".
				"WHERE conta_id=':0:'",
				array($usr["conta_id"]),
				array(INT_FORMAT)
			);
			if(sizeof($trip)!=0){
				$this->bd->query(
					"UPDATE tb_usr_tripulacao ".
					"SET data_login='".time()."', is_logado='1' ".
					"WHERE tripulacao_id='".$trip[0]["tripulacao_id"]."'"
				);
				
				Usuario::$tripAtiva = $trip[0]["tripulacao_id"];
				Usuario::$tripulacao = new Tripulacao($trip[0]["tripulacao_id"]);
				
				setcookie("id_per",Usuario::$tripulacao->getCapitao()->id,time()+80000,'/');
			}
		}
		catch(Exception $i){ $this->tException($i->getMessage()); }
	}
	//
	function getId(){ return $this->id; }
	//
	static function getTrip(){ return Usuario::$tripulacao; }
	//
	static function getBandeira(){
		if(Usuario::$tripAtiva==0) return "Imagens/Bandeiras/deslogado.png";
		else return Usuario::getTrip()->getBandeiraLink();
	}
	//
	static function setCookieLogin($id,$bd){
		$cookie = md5(time());
		
		//inicia sessao
		setcookie("id",$id,time()+80000,'/');
		setcookie("sh",$cookie,time()+80000,'/');
		
		//atualiza o cookie do bd
		try{
			$bd->query(
				"DELETE FROM tb_usr_conta_cookie WHERE conta_id=':0:'",
				array($id),array("//")
			);
			$bd->query(
				"INSERT INTO tb_usr_conta_cookie (cookie_id,conta_id) ".
				"VALUES(':0:', ':1:')",
				array($cookie,$id),array(ALL_FORMAT,ALL_FORMAT)
			);
		}
		catch(Exception $i){ $this->tException($i->getMessage()); }
	}
	//subtrai gold
	static function subGold($gold){
		try{
			if($gold <= Usuario::$gold) Usuario::$gold -= (int)$gold;
			else return false;
			
			global $bd;
			
			$bd->query("UPDATE tb_usr_conta SET gold=':0:' WHERE conta_id='".Usuario::$id."'",array(Usuario::$gold),array(INT_FORMAT));
			setInSessao("conta",0,"gold",Usuario::$gold);
			return true;
		}
		catch(Exception $i){ $this->tException("Tentativa de subtrair gold \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	//
	static function inCombate(){
		if(Usuario::$tripAtiva==0)return FALSE;
		
		if(Usuario::$combate===NULL){
			global $bd;
			$bd = &$bd;
			$mis = $bd->fazArray(
				"SELECT * FROM tb_cbt_combate_tripulacao WHERE tripulacao_id='".Usuario::$tripAtiva."'"
			);
			Usuario::$combate = ((sizeof($mis)>0)?$mis[0]:FALSE);
		}
		return Usuario::$combate;
	}
	//
	static function inIlha(){
		if(!Usuario::$logado OR Usuario::$tripAtiva==0)
			return 0;
		return Usuario::getTrip()->inilha; 
	}
	//
	static function getCorBg(){
		$h = date("H", time());
		if($h>=6 && $h<=18) $h = "dia";
		else $h = "noite";
		if(Usuario::inIlha()==0){
			if($h=="dia")
				return "1d50a9";
			return "000269";
		}
		
		global $bd;
		$bd = &$bd;
		$col = "cor_bg_".$h;
		$img = $bd->fazArray(
			"SELECT $col FROM tb_mun_ilha WHERE ilha_id='".Usuario::inIlha()."'"
		);
		
		return $img[0][$col];
	}
	//
	static function getImgBg(){
		if(Usuario::inIlha()==0)
			return 0;
		
		global $bd;
		$bd = &$bd;
		$img = $bd->fazArray(
			"SELECT bg FROM tb_mun_ilha WHERE ilha_id='".Usuario::inIlha()."'"
		);
		
		return $img[0]["bg"];
	}
	//
	static function inMissao(){
		if(Usuario::$tripAtiva==0)return FALSE;
		
		if(Usuario::$inMissao===NULL){
			global $bd;
			$bd = &$bd;
			$mis = $bd->fazArray(
				"SELECT * FROM tb_mis_missao_andamento WHERE tripulacao_id='".Usuario::$tripAtiva."'"
			);
			Usuario::$inMissao = ((sizeof($mis)>0)?TRUE:FALSE);
			Usuario::$missaoList = $mis;
		}
		return Usuario::$inMissao;
	}
	//
	static function inRecrutamento(){
		if(Usuario::$tripAtiva==0)return FALSE;
		
		if(Usuario::$inRecrutamento===NULL){
			Usuario::$inRecrutamento = FALSE;
			if(Usuario::inMissao()){
				if(Usuario::$missaoList[0]["tipo"]==0)
					Usuario::$inRecrutamento = TRUE;
			}
		}
		return Usuario::$inRecrutamento;
	}
	//
	static function inRota(){
		return FALSE;
	}
	//
	static function isDerrotado(){
		if(Usuario::$tripAtiva==0)return FALSE;
		
		if(Usuario::$isDerrotado===NULL){
			$hpTotal = 0;
			$trip = Usuario::getTrip()->getTripulantes();
			foreach ($trip as $key => $value) {
				$hpTotal += $value->hp;
			}
			Usuario::$isDerrotado = (($hpTotal==0)?TRUE:FALSE);
		}
		return Usuario::$isDerrotado;
	}
	//
	function tException($msg){ throw new Exception($msg); }
}
