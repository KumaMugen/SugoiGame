<?php
class Erro{
	private $arquivoNome="Logs/erros.log",$arquivo;
	static $msgErro,$msgMsgs;
	private $timeStart=NULL, $timeEnd=NULL;
	
	//construtor carrega arquivo e povoa os arrays de mensagens para tela
	function __construct(){
		if (!session_id()) {
			session_start();
		}
		$this->arquivo = fopen($this->arquivoNome, "a");
		if(isset($_SESSION["erros"])){
			foreach ($_SESSION["erros"] as $key => $value) Erro::$msgErro[]=$value;
			unset($_SESSION["erros"]);
		}
		if(isset($_SESSION["msgs"])){
			foreach ($_SESSION["msgs"] as $key => $value) Erro::$msgMsgs[]=$value;
			unset($_SESSION["msgs"]);
		}
		
		//controle de tempo de execucao
		$this->setStartTime();
	}
	function __destruct(){
		fclose($this->arquivo);
		$this->setEndTime();
	}
	
	//controladores de tempo
	function setStartTime(){
		list($usec, $sec) = explode(' ', microtime());
		$this->timeStart = (float) $sec + (float) $usec;
	}
	function setEndTime(){
		list($usec, $sec) = explode(' ', microtime());
		$this->timeEnd = (float) $sec + (float) $usec;
	}
	function getExecutionTime(){
		if(!$this->timeEnd)
			$this->setEndTime();
		$elapsed_time = $this->timeEnd - $this->timeStart;
		
		return $elapsed_time;
	}
	
	//insere msg de erro no arquivo
	function insere($msg){
		$data = date("H:i:s d-m-Y",time());
		$str=$data."----------------------------------------\n";
		$str.=$msg."\n";
		$str.=$_SERVER["REMOTE_ADDR"]."\n";
		$str.="-----------------------------------------------------------\n\n";
		$escreve = fwrite($this->arquivo, $str);
	}
	//adiciona outra mensagme de erro alem das que ja estao na sessao
	static function insereErroAlert($msg){ Erro::$msgErro[]=$msg; }
	//adiciona outra mensagme de erro alem das que ja estao na sessao
	static function inseremsgAlert($msg){ Erro::$msgMsgs[]=$msg; }
	//exibe os erros de sessao para o usuario
	function errosRetornados(){
		$msg="";
		if(sizeof(Erro::$msgErro)>0){
			foreach (Erro::$msgErro as $key => $value) {
				$msg='-<spam class="alertErro">'.htmlspecialchars($value).'</spam><br/>';
			}
		}
		return $msg;
	}
	//exibe as mensagens de sessao para o usuario
	function msgsRetornadas(){
		$msg="";
		if(sizeof(Erro::$msgMsgs)>0){
			foreach (Erro::$msgMsgs as $key => $value) {
				if(preg_match(STR_FORMAT, $value))
					$msg='-<spam class="alertErro">'.htmlspecialchars($value).'</spam><br/>';
			}
		}
		return $msg;
	}
}
