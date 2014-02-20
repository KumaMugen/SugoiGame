<?php
/**
 * ConectBD: Classe gerenciadora de banco de dados
 *
 * @package default
 * @author  
 * 
 * @param host String
 * Endereço do servidor
 * 
 * @param user String
 * Usuario Mysql
 * 
 * @param pass String
 * senha do usuario Mysql
 * 
 * @param bd String
 * Banco de dados a ser conectado
 */
class ConectBD extends Super{
	/** @var lastQuery Array( insert_id, affected_rows ) */
	var $lastQuery;
	var $cache;
	
	function __construct($host, $user, $pass, $bd){
		header('Content-Type: text/html; charset=utf-8');
		
		mysql_connect($host, $user, $pass) or $this->geraLog(mysql_errno().": ".mysql_error(),TRUE);
		mysql_select_db($bd) or $this->geraLog(mysql_errno().": ".mysql_error(),TRUE);
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
	}//construtor
	function __destruct(){ mysql_close(); }//destrutor
	function prepara($query,$valores=array(),$regular=array(ALL_FORMAT)){
		foreach ($valores as $key => $value) {
			if(!preg_match($regular[$key], $value)){
				$msg = "Argumento inválido: ".$key." ".$regular[$key].", ".$value;
				$this->geraLog($msg);
				throw new ParameterException();
			}
			else{
				$valores[$key]=mysql_real_escape_string($value);
				$tira[$key]=":".$key.":";
			}
		}
		if(isset($tira)){
			$query = str_replace($tira, $valores, $query);
		}
		return $query;
	}//prepara
	function fazArray($query,$coloca=array(),$regular=array(ALL_FORMAT),$cache=TRUE){
		try{
			$query=$this->prepara($query,$coloca,$regular);
		}
		catch(ParameterException $i){
			throw new ParameterException();
		}
		if(!$cache OR !isset($this->cache[$query])){
			$result=mysql_query($query) or $this->geraLog(mysql_errno().": ".mysql_error()."\nQuery: ".$query,TRUE);
			$this->lastQuery["insert_id"] = mysql_insert_id();
			$this->lastQuery["affected_rows"] = mysql_affected_rows();
			$array=array();
			for($x=0;$sql=mysql_fetch_array($result);$x++){
				$array[$x]=$sql;
			}
			$this->cache[$query] = $array; 
		}
		else{
			$array = $this->cache[$query];
		}
		return $array;
	}//fazArray
	function query($query,$coloca=array(),$regular=array(ALL_FORMAT)){
		try{
			$query=$this->prepara($query,$coloca,$regular);
		}
		catch(ParameterException $i){
			throw new ParameterException();
		}
		
		$result = mysql_query($query) or $this->geraLog(mysql_errno().": ".mysql_error()."\nQuery: ".$query,TRUE);
		$this->lastQuery["insert_id"] = mysql_insert_id();
		$this->lastQuery["affected_rows"] = mysql_affected_rows();
		return $result;
	}
	//numero de registros
	function getReg($tabela){
		$tabela = mysql_real_escape_string($tabela);
		$query="SELECT * FROM $tabela";
		$result= mysql_query($query) or $this->geraLog(mysql_errno().": ".mysql_error()."\nQuery: ".$query,TRUE);
		return mysql_num_rows($result);
	}
	//somador de BD
	function addQuant($tabela,$coluna,$where,$quant,$insert){
		try{
			$jatem = $this->fazArray(
				"SELECT :0: FROM :1: WHERE $where",
				array($coluna,$tabela),
				array(ALL_FORMAT,ALL_FORMAT),
				FALSE
			);
			if(sizeof($jatem)==0){
				$str="(";
				foreach ($insert as $key => $value) {
					$str .= $key.", ";
				}
				$str.=$coluna.") VALUES (";
				foreach ($insert as $key => $value) {
					$str .= "'".$value."', ";
				}
				$str .= "'".$quant."')";
				$this->query(
					"INSERT INTO :0: $str",
					array($tabela)
				);
			}
			else{
				$quant += $jatem[0][$coluna];
				$this->query(
					"UPDATE :0: SET :1:=':2:' WHERE $where",
					array($tabela,$coluna,$quant),
					array(ALL_FORMAT,ALL_FORMAT,ALL_FORMAT)
				);
			}
		}
		catch(Exception $i){
			$this->geraLog($i->getMessage(),TRUE);
		}
	}
	//verificador de quant de BD
	function getQuant($tabela,$coluna,$where){
		try{
			$jatem = $this->fazArray(
				"SELECT :0: FROM :1: WHERE $where",
				array($coluna,$tabela),
				array(ALL_FORMAT,ALL_FORMAT),
				FALSE
			);
			return ((sizeof($jatem) == 0)?0:$jatem[0][$coluna]);
		}
		catch(Exception $i){
			$this->geraLog($i->getMessage(),TRUE);
		}
	}
}
