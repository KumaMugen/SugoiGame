<?php
$habilidades = $value->getHabilidades();
		
$e = array();
foreach ($habilidades as $key2 => $value2) {
	if($value2["categoria"]==0)
		$categoria = "Hab. Padrão";
	if($value2["categoria"]==1)
		$categoria = "Hab. de Classe";
	else if($value2["categoria"]==2)
		$categoria = "Hab. de Profissão";
	else if($value2["categoria"]==3)
		$categoria = "Hab. de Akuma";
	
	$i = getInfoHabilidade($value2);
	$i[] = barra(400, "gray",($value2["xp"]/$value2["xp_max"]),"white",($value2["xp"]." / ".$value2["xp_max"]));
	$e[] = e("DIV","class=habilidade",array(
		e("DIV","id=".$value->id.$value2["habilidade_id"],"class=habilidade-title titulo-texto icon-cursor",array(
			e("DIV","class=img",array(
				e("IMG","src=Imagens/Skill/".$value2["img"].".jpg")
			)),
			e("DIV",array(
				e("IMG","src=Imagens/Skill/Tipo/".$value2["tipo"].".png")
			)),
			e("DIV","class=title",array(texto($value2["nome"]." <span>(".$categoria.")</span>")))
		)),
		e("DIV","id=layer-".$value->id.$value2["habilidade_id"],"class=habilidade-info",$i),
		
	));
}
$e[] = e("DIV","class=clear");

$conteudo["retorno"] = $e;