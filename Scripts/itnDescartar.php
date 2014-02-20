<?php
	try{
		if(!isset($_GET["id"]) OR !isset($_GET["tipo"])){
			$conteudo["erro"] = getErroFormularioIncompleto();
			return;
		}
		if(!preg_match(INT_FORMAT,$_GET["id"]) OR !preg_match(INT_FORMAT,$_GET["tipo"])){
			$conteudo["erro"] = getErroInformacaoInvalida("id ou tipo");
			return;
		}
		$id = $_GET["id"];
		$tipo = $_GET["tipo"];
		
		if($tipo==0){
			if(!isset($_GET["quant"])){
				$conteudo["erro"] = getErroFormularioIncompleto();
				return;
			}
			if(!preg_match(INT_FORMAT,$_GET["quant"])){
				$conteudo["erro"] = getErroInformacaoInvalida("quant");
				return;
			}
			
			$quant = $_GET["quant"];
			
			Usuario::getTrip()->subItem($id,$quant);
		}
		else{
			if(!isset($_GET["evolucao"]) OR !isset($_GET["slot_1"]) OR !isset($_GET["slot_2"])){
				$conteudo["erro"] = getErroFormularioIncompleto();
				return;
			}
			if(!preg_match(INT_FORMAT,$_GET["evolucao"]) 
			OR !preg_match(INT_FORMAT,$_GET["slot_1"]) 
			OR !preg_match(INT_FORMAT,$_GET["slot_2"])){
				$conteudo["erro"] = getErroInformacaoInvalida("evolucao slot1 ou slot2");
				return;
			}
			
			$evolucao = $_GET["evolucao"];
			$s1 = $_GET["slot_1"];
			$s2 = $_GET["slot_2"];
			
			Usuario::getTrip()->subEquipamento($id,$evolucao,$s1,$s2);
		}
		
		$conteudo["mensagem"] = "Item removido.";
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }