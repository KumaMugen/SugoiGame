<?php
	function e($tag){
		$item = array();
		
		$args = func_get_args();
		foreach ($args as $key => $value) {
			if(is_string($value)){
				$par = explode("=", $value);
				if($key==0)
					$item["tag"] = $value;
				else{ 
					$i= $par[0];
					unset($par[0]);
					
					$item[$i] = implode("=", $par);
				}
			} else if(is_array($value)){
				$item["c"] = $value;
			}
		}
		return $item;
	}
	function texto($content){
		$item = array( "tag" => "texto", "content" => $content );
		return $item;
	}
	
	function cabecalho($texto){
		$cabecalho = e("DIV","class=titulo",array(
			e("DIV","class=titulo-img"),
			e("DIV","class=titulo-texto",array(
				texto($texto)
			))
		));
		return $cabecalho;
	}
	
	//Funcao para gerar barras de HP, Energia, XP, Haki, etc...
	function barra($larguraExt=200, $corExt="gray", $larguraInt=1, $corInt="black", $texto="", $tamanho=0 ){
		$larguraInt*=$larguraExt;
		if($larguraInt > $larguraExt) $larguraInt = $larguraExt;
		if($larguraInt < 1 && $larguraInt > 0) $larguraInt = 1;
		$tamanho="barra-small-".$tamanho;
		
		$barra = e("DIV","class=externo $corExt $tamanho","style=width: ".$larguraExt."px;",array(
			e("DIV","class=interno $corInt","style=width: ".$larguraInt."px;",array(
				e("DIV", "class=interno-texto","style=width: ".$larguraExt."px;",array(texto($texto)))
			))
		));
		return $barra;
	}
	
	//funcao para gerar box de informaçoes
	function box($conteudo,$width="200px",$layout=""){
		return e("DIV", "class=geral-box $layout","style=width: ".$width.";",array(
			e("DIV","class=geral-box-content",$conteudo),
			e("IMG","src=Imagens/borda-TE.png","class=te"),
			e("IMG","src=Imagens/borda-TD.png","class=td"),
			e("IMG","src=Imagens/borda-BE.png","class=be"),
			e("IMG","src=Imagens/borda-BD.png","class=bd")
		));
	}
	
	//funcao pra gerar informaçoes de itens dentro de box
	function boxItem($item,$i1=TRUE,$i2=FALSE){
		if(!isset($item["titulo"]))$item["titulo"]="";
		if(!isset($item["categoria"]))$item["categoria"]=0;
		
		$categoria = "cat-".$item["categoria"];
		$array = e("DIV","class=item-box",array(
			"t" => e("DIV","class=box-titulo $categoria",array(
				texto($item["titulo"])
			)),
			"i1" => e("DIV","class=info-1",array()),
			"i2" => e("DIV","class=info-2",array())
		));
		
		if($i1){
			$array["c"]["i1"]["c"]["d"] = e("DIV","class=direita",array());
			
			if(isset($item["img"]))
				$array["c"]["i1"]["c"]["d"]["c"][] = e("IMG","src=".$item["img"],"class=img");
			
			if(isset($item["lvl"]))
				$array["c"]["i1"]["c"]["d"]["c"][] = e("DIV","class=lvl",array(
					texto("Nvl"),
					e("SPAN",array(
						texto($item["lvl"])
					))
				));
			if(isset($item["descricao"]))
				$array["c"]["i1"]["c"]["e"] = e("DIV","class=esquerda",array(
					texto($item["descricao"])
				));
			if(isset($item["descricao-array"]))
				$array["c"]["i1"]["c"]["e"] = e("DIV","class=esquerda",$item["descricao-array"]);
				
			$array["c"]["i1"]["c"]["z"] = e("DIV","class=clear");
		}
		if($i2){
			foreach ($item["i2"] as $key => $value) {
				$array["c"]["i1"]["c"][] = e("DIV","class=".$key,array(
					texto($value)
				));
			}
		}
		
		return $array;
	}
	function formataInfoItem($info,$descartar=TRUE,$equipar=0,$pers=0,$adicional=array()){
		return e("DIV","class=item-info-box",array(
			e("DIV","class=box-titulo cat-".$info["categoria"],array(texto($info["nome"]))),
			e("DIV","class=info-1",array(
				e("DIV","class=direita",array(
					e("IMG","class=img","src=Imagens/Itens/".$info["img"].".png"),
					e("DIV","class=lvl",array(texto("Nvl.<span>".$info["lvl"]."</span>")))
					
				)),
				e("DIV","class=esquerda",array(texto($info["descricao"])))
			)),
			e("DIV","class=info-2",array(
				e("DIV","class=itn-tipo",array(
					texto(
						((isset($info["item_id"]))?
							(getTipoItem($info["tipo"]))
							:(getNomeSlotEquipamento($info["slot"])))
					)
				)),
				($info["is_negociavel"]!=1 || $info["is_armazenavel"]!=1)?
					(e("DIV","class=itn-negociavel",array(
						texto(
							(($info["is_negociavel"]!=1)?"Não negociável; ":"").
							(($info["is_armazenavel"]!=1)?"Não armazenável; ":"")
						)
					)))
					:(array()),
				(isset($info["evolucao"]))?
					(e("DIV","class=itn-evolucao",array(texto("Evolucao: <span>+".$info["evolucao"]."</span> / 10"))))
					:(array()),
				e("DIV","class=itn-efeito",array(
					texto(
						(isset($info["item_id"]))?
							getEfeitoItem($info)
							:getEfeitoEquipamento($info)
					)
				)),
				(isset($info["script"]) AND strlen($info["script"])>0)?
					(e("DIV","class=itn-script",array(texto('<a href="'.$info["script"].'" class="link_send">Usar</a>'))))
					:(array()),
				(isset($info["slot_1"]))?
					(e("DIV","class=itn-slots",array(
						(($info["slot_1"]!=0))?
							(e("SPAN",array(texto(getAtributoNome($info["slot_1"])." +1"))))
							:(e("SPAN",array(texto("Slot Vazio")))),
						(($info["slot_2"]!=0))?
							(e("SPAN",array(texto(getAtributoNome($info["slot_2"])." +1"))))
							:(e("SPAN",array(texto("Slot Vazio")))),
					)))
					:(array()),
				(isset($info["equipamento_id"]))?
					(e("DIV","class=itn-requisito",array(
						texto(
							"Nível requerido: ".$info["lvl"]."<br>".
							"Classe requerida: ".getClasse($info["requisito_classe"])
						)
					)))
					:(array()),
				(isset($info["quant"]))?
					(e("DIV","class=itn-quant",array(texto("Quantidade: ".$info["quant"]))))
					:(array()),
				($descartar)?
					((isset($info["item_id"]))?
						(e("DIV","class=itn-descartar",array(
							e("A","href=itnDescartar&tipo=0&id=".$info["item_id"],
								'question=Quantos "'.$info["nome"].'" deseja descartar? (Máximo '.$info["quant"].')',
								"class=link_send_quant",array(texto("Descartar")))
						)))
						:(e("DIV","class=itn-descartar",array(
							e("A","href=itnDescartar&tipo=1&".
								"id=".$info["equipamento_id"].
								"&evolucao=".$info["evolucao"].
								"&slot_1=".$info['slot_1'].
								"&slot_2=".$info['slot_2'],
								'question=Deseja mesmo descartar "'.$info["nome"].'"?',
								"class=link_send_confirm",array(texto("Descartar")))
						))))
					:(array()),
				(isset($info["equipamento_id"]))?
					(($equipar==1)?
						(e("DIV","class=itn-equipar",array(
							e("A","href=perEquiparEquipamento&".
								"id=".$info["equipamento_id"].
								"&evolucao=".$info["evolucao"].
								"&slot_1=".$info['slot_1'].
								"&slot_2=".$info['slot_2'].
								"&per=".$pers,
								"class=link_send",array(texto("Equipar")))
						)))
						:(($equipar==2)?
							(e("DIV","class=itn-equipar",array(
								e("A","href=perRetirarEquipamento&".
									"slot=".$info["slot"].
									"&per=".$pers,
									"class=link_send",array(texto("Retirar")))
							)))
							:(array())
						))
					:((($equipar==1 AND $info["tipo"]==0)?
						(e("DIV","class=itn-equipar",array(
							e("A","href=perEquiparAcessorio&".
								"id=".$info["item_id"].
								"&per=".$pers,
								"class=link_send",array(texto("Equipar")))
						)))
						:(($equipar==2 AND $info["tipo"]==0)?
							(e("DIV","class=itn-equipar",array(
								e("A","href=perRetirarAcessorio".
									"&per=".$pers,
									"class=link_send",array(texto("Retirar")))
							)))
							:(array())
						))),
					$adicional
			)),
			e("DIV","class=clear")
		));
	}
	
	function menuInterno($elementos){
		$menu = e("DIV","id=menu-interno",array(
			"ul" => e("UL")
		));
		
		foreach ($elementos as $key => $value) {
			$menu["c"]["ul"]["c"][] = e("LI",array(
				e("A","href=?ses=".$key,"class=link_content","title=".$value["title"],array(
					e("SPAN",array(
						texto($value["texto"])
					)),
					e("IMG","src=".$value["img"])
				))
			));
		}
		
		return $menu;
	}
	
	function getPersonagemSeletor($tripulantes,$selecionado,$pagina="tripulacaoStatus"){
		$info = e("DIV","class=personagem-seletores",array());
		foreach ($tripulantes as $key => $value) {
			$info["c"][$key] = e("IMG","class=personagem-seletor".(($selecionado==$value->id)?" seletor-selecionado":""),
			"id=personagem-".$value->id,"per=".$value->id,"pag=".$pagina,"src=Imagens/Personagens/Icons/".$value->getSkinR().".jpg");
		}
		
		return $info;
	}
	
	function getInfoHabilidade($hab){
		//passiva
		if($hab["tipo"]==0){
			$infoHabilidade = array(
				e("DIV",array(texto("<b>Habilidade Passiva</b>"))),
				e("DIV",array(texto("Efeito: ".getAtributoNome($hab["bonus_attr"])." +".$hab["bonus_attr_quant"])))
			);
		}
		//ataque
		else if($hab["tipo"]==1){
			$infoHabilidade = array(
				e("DIV",array(texto("<b>Ataque</b>"))),
				e("DIV",array(texto("Dano: ".$hab["dano"]))),
				e("DIV",array(texto("Alcance: ".$hab["alcance"]." quadro(s)"))),
				e("DIV",array(texto("Área: ".$hab["area"]." quadro(s)"))),
				e("DIV",array(texto("Espera: ".$hab["espera"]." turno(s)"))),
				e("DIV",array(texto("Consumo: ".$hab["consumo"])))
			);
		}
		//buff
		else{
			$infoHabilidade = array(
				e("DIV",array(texto("<b>Buff</b>"))),
				e("DIV",array(texto("Efeito: ".getAtributoNome($hab["bonus_attr"])." ".$hab["bonus_attr_quant"]))),
				e("DIV",array(texto("Duração: ".$hab["duracao"]." turno(s)"))),
				e("DIV",array(texto("Alcance: ".$hab["alcance"]." quadro(s)"))),
				e("DIV",array(texto("Área: ".$hab["area"]." quadro(s)"))),
				e("DIV",array(texto("Espera: ".$hab["espera"]." turno(s)"))),
				e("DIV",array(texto("Consumo: ".$hab["consumo"])))
			);
		}
		if(isset($hab["lvl"]))
			$infoHabilidade[] = e("DIV",array(texto("Nível: ".$hab["lvl"])));
		
		return $infoHabilidade;
	}
	
	function getBau($tipos=array(0,1,2,3,4,5),$descartar=TRUE,$equipar=0,$pers=0,$adicional=array()){
		$it = Usuario::getTrip()->getItens("item");
		$eq = Usuario::getTrip()->getItens("equipamento");
		
		$i = array();
		foreach ($it as $key => $value) {
			if(in_array($value["tipo"],$tipos))
				$i[] = e("DIV","class=item-bau","id=item-bau-i-".$pers.$key,"style=background:url(Imagens/Itens/".$value["img"].".png)",array(
						box(array(formataInfoItem($value,$descartar,$equipar,$pers,$adicional)),"300px","item-box")
				));
		}
		
		$e = array();
		foreach ($eq as $key => $value) {
			$e[] = e("DIV","class=item-bau","id=item-bau-e-".$pers.$key,"style=background:url(Imagens/Itens/".$value["img"].".png)",array(
				box(array(formataInfoItem($value,$descartar,$equipar,$pers,$adicional)),"300px","item-box")
			));
		}
		
		$bau = e("DIV","class=bau",array(
			e("DIV","class=bau-conteudo",array(
				e("DIV","class=bau-content",array(
					e("DIV","class=bau-c-top",array(
						e("SELECT","class=bau-select-tipo bau-label",array(
							e("OPTION","value=0",array(texto("Itens"))),
							e("OPTION","value=1",array(texto("Equipamentos")))
						))
					)),
					e("DIV","class=bau-c-bot",array(
						e("DIV","class=bau-itens bau-itens-0",$i),
						e("DIV","class=bau-itens bau-itens-1","style=display:none",$e)
					))
				))
			))
		));
		
		return $bau;
	}
	function getInfoJogadorCombate($jog){
		return array(
			e("DIV","class=info",array(
				e("DIV","class=sup",array(texto($jog["title"]))),
				e("DIV","class=mid",array(texto("<span>".$jog["i1"]."</span><br>".$jog["i2"]))),
				e("DIV","class=inf",array(texto((isset($jog["alianca"]))?"":"")))
			)),
			e("DIV","class=bandeira equipe-".$jog["equipe"],array(
				e("IMG","src=".$jog["bandeira"])
			))
		);
	}
	
	function getPersonagensInTabuleiro($combateId,$tipo="PvP"){
		global $bd;
		$bd = &$bd;
		
		$largura = array(24.5,26,27.5,28.5,30.5,32,34,35.5,38,40.3,43,46.3,50,54,58);
		
		if($tipo=="PvE")
			$limitex = 11;
		else
			$limitex = 14;
		
		$limitey = 13;
		
		$pers = $bd->fazArray(
			"SELECT * FROM tb_cbt_combate_personagem ".
			"WHERE combate_id=':0:'",
			array($combateId),
			array(INT_FORMAT)
		);
		
		$personagem = array();
		
		$t = array();
		$i = array();
		for($x=0;$x<=$limitex;$x++){
			for($y=0;$y<=$limitey;$y++){
				$t[$x."_".$y] = e("DIV","id=quadro-".$x."_".$y,
				"class=quadro linha-".$x." coluna-".$y,
				"x=".$x,"y=".$y);
			}
		}
		$HPTotal[0] = 0;
		$HPTotal[1] = 0;
		foreach ($pers as $key => $value) {
			if($value["hp"]>0){
				$HPTotal[$value["equipe"]] += $value["hp"];
				$p = new PersonagemCombate($value);
				
				$x = $p->quadro->x;
				$y = $p->quadro->y;
				$HMax = $p->getHPMax();
				$MMax = $p->getMPMax();
				
				$t[$x."_".$y] = e("DIV", "id=quadro-".$x."_".$y,
				"class=quadro personagem icon-cursor equipe-".$p->equipe." linha-".$x." coluna-".$y,
				"x=".$x,"y=".$y,"perId=".$p->id,array(
					e("DIV","class=barraHP",array(
						barra($largura[$x],"red2",($p->hp/$HMax),"green2","",5)
					)),
					e("IMG","class=personagem-img","src=Imagens/Personagens/Icons/".$p->getSkinR().".jpg")
				));
				$i[] = e("DIV","id=pers-".$p->id."-info","class=personagem-tabuleiro-info",array(
					e("DIV","class=personagem-tabuleiro-info-title",array(texto($p->nome))),
					e("DIV","class=personagem-tabuleiro-info-img",array(
						e("IMG","width=150px","src=Imagens/Personagens/Big/".$p->getSkinC().".jpg")
					)),
					e("DIV","class=info-barra-HP",array(
						barra(170,"gray",($p->hp/$HMax),"green",$p->hp." / ".$HMax)
					)),
					e("DIV","class=info-barra-MP",array(
						barra(170,"gray",($p->mp/$MMax),"yellow",$p->mp." / ".$MMax)
					)),
				));
			}
		}
		
		return array(
			"tabuleiro"=>e("DIV","id=tabuleiro-".$tipo,$t),
			"personagens-info" => $i,
			"hpTotal-0" => $HPTotal[0],
			"hpTotal-1" => $HPTotal[1]
		);
	}
	
	function getHabilidadeSoco(){
		return array(
			"habilidade_id" => "soco",
			"nome" => "Soco",
			"descricao" => "Tenta acertar um soco no oponente.",
			"img" => 1,
			"lvl" => 0,
			"xp" => 1,
			"xp_max" => 1,
			"categoria" => 0,
			"tipo" => 1,
			"consumo" => 0,
			"espera" => 0,
			"alcance" => 5,
			"area" => 3,
			"dano" => 50,
			"esperaRestante" =>0
		);
	}
	function getHabilidadeChute(){
		return array(
			"habilidade_id" => "chute",
			"nome" => "Chute",
			"descricao" => "Tenta acertar um chute no oponente.",
			"img" => 2,
			"lvl" => 0,
			"xp" => 1,
			"xp_max" => 1,
			"categoria" => 0,
			"tipo" => 1,
			"consumo" => 0,
			"espera" => 0,
			"alcance" => 1,
			"area" => 1,
			"dano" => 70,
			"esperaRestante" =>0
		);
	}
	
	function getInfoJogadorInMapa($trip,$pvp=array()){
		if(!isset($pvp["disponivel"]))$pvp["disponivel"]=FALSE;
		if(!isset($pvp["atacar"]))$pvp["atacar"]=FALSE;
		if(!isset($pvp["saquear"]))$pvp["saquear"]=FALSE;
		if(!isset($pvp["amigavel"]))$pvp["amigavel"]=FALSE;
		if(!isset($pvp["guerrear"]))$pvp["guerrear"]=FALSE;
		if(!isset($pvp["torneio"]))$pvp["torneio"]=FALSE;
		if(!isset($pvp["disparar"]))$pvp["disparar"]=FALSE;
		
		$i = array(
				"id" => $trip->trip,
				"nome_trip" => $trip->nome,
				"nome_cap" => $trip->getCapitao()->nome,
				"patente" => $trip->getPatente(),
				"tripulantes" => $trip->getNumTripulantes(),
				"bandeira" => $trip->getBandeiraLink(),
				"lvl" => $trip->getMaisForte(),
				"alianca" => $trip->getAlianca()
			);
		
		if($pvp["disponivel"]){
			$i["pvp"] = TRUE;
			$i["atacar"] = $pvp["atacar"];
			$i["disparar"] = $pvp["disparar"];
			$i["saquear"] = $pvp["saquear"];
			$i["amigavel"] = $pvp["amigavel"];
			$i["guerrear"] = $pvp["guerrear"];
			$i["torneio"] = $pvp["torneio"];
		}
		return $i;
	}
