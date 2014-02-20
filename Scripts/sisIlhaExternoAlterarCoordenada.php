<?php
	if(Usuario::$permissao>PER_sistemaIlhas){
		$conteudo["erro"] = getMsgErroPermissao();
		return;
	}
	try{
		if(!isset($_GET["ilha"]) 
		OR !isset($_GET["zona"]) 
		OR !isset($_GET["conteudo"]) 
		OR !isset($_GET["coordenada"]) 
		OR !isset($_GET["atributo1"]) 
		OR !isset($_GET["atributo2"])){
			$conteudo["erro"] = "Está faltando dados";
			return;
		}
		$ilha = $_GET["ilha"];
		$zona = $_GET["zona"];
		$coord = $_GET["coordenada"];
		$cont = $_GET["conteudo"];
		$att1 = $_GET["atributo1"];
		$att2 = $_GET["atributo2"];
		$att3 = $_GET["atributo3"];
		
		if($cont != "coleta" AND $cont != "portal" AND $cont != "mob"){
			$conteudo["erro"] = "Conteúdo inválido";
			return;
		}
		$bd->query(
			"DELETE FROM tb_mun_ilha_zona_:0: ".
			"WHERE ilha_id=':1:' AND zona=':2:' AND coordenada=':3:'",
			array(
				$cont,
				$ilha,
				$zona,
				$coord
			),
			array(
				STR_FORMAT,
				INT_FORMAT,
				INT_FORMAT,
				STR_FORMAT
			)
		);
		if($att1 != "DELETE" AND $att2 != "DELETE"){
			if($cont == "coleta"){
				$bd->query(
					"INSERT INTO tb_mun_ilha_zona_coleta ".
					"(ilha_id, zona, coordenada, item_id, tempo_respawn,requisito_profissao) ".
					"VALUES ".
					"(':0:',':1:',':2:',':3:',':4:',':5:')",
					array(
						$ilha,
						$zona,
						$coord,
						$att1,
						$att2,
						$att3
					),
					array(
						INT_FORMAT,
						INT_FORMAT,
						STR_FORMAT,
						INT_FORMAT,
						INT_FORMAT,
						INT_FORMAT
					)
				);
			}
			else if($cont == "portal"){
				$bd->query(
					"INSERT INTO tb_mun_ilha_zona_portal ".
					"(ilha_id, zona, coordenada, zona_destino, coordenada_destino) ".
					"VALUES ".
					"(':0:',':1:',':2:',':3:',':4:')",
					array(
						$ilha,
						$zona,
						$coord,
						$att1,
						$att2
					),
					array(
						INT_FORMAT,
						INT_FORMAT,
						STR_FORMAT,
						INT_FORMAT,
						STR_FORMAT
					)
				);
			}
			else if($cont == "mob"){
				$bd->query(
					"INSERT INTO tb_mun_ilha_zona_mob ".
					"(ilha_id, zona, coordenada, mob_id, chance, background) ".
					"VALUES ".
					"(':0:',':1:',':2:',':3:',':4:',':5:')",
					array(
						$ilha,
						$zona,
						$coord,
						$att1,
						$att2,
						$att3
					),
					array(
						INT_FORMAT,
						INT_FORMAT,
						STR_FORMAT,
						INT_FORMAT,
						STR_FORMAT,
						STR_FORMAT
					)
				);
			}
		}
	}
	catch(Exception $i){ $erro->insere("Tentativa de logar\n".$i->getMessage()."\n".$i->getTraceAsString()); }
