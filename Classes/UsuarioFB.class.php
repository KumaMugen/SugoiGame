<?php
class UsuarioFB extends Usuario{
	//construtor
	function __construct($user,$facebook){
		try{
			global $bd;
			$this->bd = &$bd;
			$usr=$this->bd->fazArray(
				"SELECT * FROM tb_usr_conta_facebook ".
				"WHERE facebook_id=':0:'",
				array($user["id"]),array(INT_FORMAT)
			);
			if(sizeof($usr)==1){
				Usuario::setCookieLogin($usr[0]["conta_id"],$bd);
				
				session_destroy();
			}
			else{
				$usr=$this->bd->fazArray(
					"SELECT * FROM tb_usr_conta 
					WHERE email=':0:'",
					array($user["email"]),
					array(EMAIL_FORMAT)
				);
				if(sizeof($usr)==0){
					$this->bd->query(
						"INSERT INTO tb_usr_conta (nome,email) ".
						"VALUES (':0:',':1:')",
						array($user["name"],$user["email"]),
						array(ALL_FORMAT,EMAIL_FORMAT)
					);
					
					$id=$this->bd->lastQuery["insert_id"];
					
					$this->bd->query(
						"INSERT INTO tb_usr_conta_facebook (conta_id,facebook_id) ".
						"VALUES (':0:',':1:')",
						array($id,$user["id"]),
						array(INT_FORMAT,INT_FORMAT)
					);
					
					$facebook->sendPost($user["name"]." começou a jogar Sugoi Game.");
					
					$usr=$this->bd->fazArray(
						"SELECT * FROM tb_usr_conta WHERE conta_id=':0:'",
						array($id),
						array(INT_FORMAT)
					);
					if(sizeof($usr)==1) $this->iniciaParametros($usr[0]);
				}
				else{
					echo("O Email da sua conta do Facebook já está associado a outra conta do Sugoi Game."); 
					session_destroy();
					exit();
				}
			}
		}
		catch(Exception $i){ $this->tException("Tentativa de criar usuario \n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
}