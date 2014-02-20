<?php
	require "Facebook/facebook.php";
	require "Funcoes/lib.php";
	require "Funcoes/correspondencias.php";
	require "Funcoes/Time.php";
	include "Funcoes/elementos.php";
	
	function __autoload($classe) {
		if(class_exists($classe)){
		 	return true;
		}
		require_once "Classes/".$classe.".class.php";
	 }
	
	$host="localhost"; // Host name
	$username="root"; // Mysql username
	$password="Senha"; // Mysql password
	$db_name="sugoigame2"; // Database name
	
	require "Includes/defines.php";
	
	//Cria objeto para gerenciar erros
	$erro=new Erro;
	
	//Cria objeto Banco de dados
	try{
		$bd = new ConectBD($host, $username, $password,$db_name);
	}
	catch (Exception $i){
		echo "Erro: <code>" . $i->getMessage() . "</code>";
		exit();
	}
	//verifica se o sistema esta em manutençao total
	$manutencao = $bd->fazArray("SELECT * FROM tb_sis_manutencao WHERE is_total='1'");
	if(sizeof($manutencao)!=0){
		echo "Sistema em manutencao!";
		exit();
	}
	
	//cria objeto facebook
	$facebook = new Facebook(array(
		'appId'  => '569113909793015',
		'secret' => '80293141847cedc1d71b10bae4db2f61',
		'cookie' => true
	));
	//Declaraçao do certificado do facebook
	Facebook::$CURL_OPTS[CURLOPT_CAINFO] = dirname(__FILE__) . "/Facebook/fb_ca_chain_bundle.crt";
	$usuario = $facebook->getUser();
	
	//verifica se o usuario esta conectado
	if($usuario) {
		try {
			$user = $facebook->api('/me');
			$usuario=new UsuarioFB($user, $facebook);
		}
		catch (FacebookApiException $e) {
			$erro->insere($e);
			$user = null;
		}
	}
	else {
		if(isset($_COOKIE["id"]) AND isset($_COOKIE["sh"])){
			try{
				$usuario=new Usuario($_COOKIE["id"],$_COOKIE["sh"]);
			}
			catch(NotFoundException $i){}
			catch(Exception $i){
				$erro->insere(
					"Tentativa de criar usuario\n".$i->getMessage()."\n".$i->getTraceAsString()
				);
			}
		}
	}
