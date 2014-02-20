<?php
$equipados = $value->getEquipamentos();
$acessorio = $value->getAcessorio();

//gera slots
for ($i=1; $i <= 8; $i++) { 
	$slot[$i] = e("DIV","class=item-slot slot-".$i,array(
		e("IMG","src=Imagens/Itens/slot_".$i.".jpg"),
		box(array(texto(getNomeSlotEquipamento($i))),"300px","item-box-hover")
	));
}
$slot[9] = e("DIV","class=item-slot slot-9",array(
	e("IMG","src=Imagens/Itens/slot_9.jpg"),
	box(array(texto("Acessório")),"300px","item-box-hover")
));

$dano = 0;
$armadura = 0;
$bonus = getAtributosInArray();
foreach ($equipados as $key => $item) {
	//insere o item no slot
	$slot[$item["slot"]]["c"][1] = box(array(formataInfoItem($item,FALSE,2,$value->id)),"300px","item-box-hover");
	
	$slot[$item["slot"]]["c"][0]["src"] = "Imagens/Itens/".$item["img"].".png";
	$slot[$item["slot"]]["class"] .= " cat-".$item["categoria"];
	
	//calculo de bonus
	if($item["slot_1"]!=0)
		$bonus[getAtributoTabela($item["slot_1"])]+=1;
	if($item["slot_2"]!=0)
		$bonus[getAtributoTabela($item["slot_2"])]+=1;
	
	if($item["tipo_efeito"]==0)
		$dano += calculaEfeitoEquipamento($item);
	else
		$armadura += calculaEfeitoEquipamento($item);
}

//insere acessorio
if(sizeof($acessorio)!=0){
	$slot[9]["c"][1] = box(array(formataInfoItem($acessorio[0],FALSE,2,$value->id)),"300px","item-box-hover");
	
	$slot[9]["c"][0]["src"] = "Imagens/Itens/".$acessorio[0]["img"].".png";
	$slot[9]["class"] .= " cat-".$acessorio[0]["categoria"];
	
	//add bonus do acessorio
	for ($x=1; $x < 9; $x++) { 
		$bonus[getAtributoTabela($x)] += $acessorio[0]["bonus_".getAtributoTabela($x)];
	}
}

//formata div de bonus
$b = array();
for ($i=1; $i <9 ; $i++) { 
	$b[] = e("DIV",array(
		e("IMG","src=Imagens/Icones/".getAtributoImagem($i).".png","title=".getAtributoNome($i)),
		texto(" + ".$bonus[getAtributoTabela($i)])
	));
}
$j = array(
	e("DIV",array(texto("Dano: ".$dano))),
	e("DIV",array(texto("Armadura: ".$armadura))),
	e("DIV",$b)
);

$e = array(
	e("DIV",array(
		e("DIV","class=equipado",array(
			e("IMG","src=Imagens/Personagens/Big/".$value->getSkinC().".jpg"),
			e("DIV","class=slots",$slot),
			e("DIV","class=acessorio")
		)),
		e("DIV","class=bonus",array(
			box($j,"300px","box-interna")
		)),
		e("DIV","class=clear")
	)),
	e("DIV",array(getBau(array(0),FALSE,1,$value->id)))
);

$conteudo["retorno"]=$e;

$conteudo["evento"] = 'addToggleClick2(".item-bau",".item-box","item-selected")';
