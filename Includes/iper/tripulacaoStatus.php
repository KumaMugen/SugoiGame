<?php
$info = array(
	"img" => e("IMG","class=img-personagem","src=Imagens/Personagens/Big/".$value->getSkinC().".jpg"),
	"info" => e("DIV","class=info-personagem",array(
		box(array(
			e("DIV",array(texto("<b>Nome:</b> ".$value->nome))),
			e("DIV",array(texto("<b>Nível:</b> ".$value->lvl))),
			e("DIV",array(texto("<b>Classe:</b> ".$value->getClasse()))),
			e("DIV",array(texto("<b>Score:</b> ".$value->getClasseScore()))),
			e("DIV",array(texto("<b>Profissão:</b> ".$value->getProf()))),
			e("DIV",array(texto("<b>".Usuario::getTrip()->tipoPtsWanted.":</b> ".$value->FA))),
			e("DIV",array(texto("<b>".Usuario::getTrip()->tipoWanted.":</b> ".getRecompensa($value->FA)))),
			e("DIV",array(texto("<b>Akuma no Mi:</b> ".$value->lvl))),
			e("DIV",array(texto("<b>Ranking Ameaça:</b> ".$value->lvl))),
			e("DIV",array(texto("<b>Ranking Score:</b> ".$value->lvl)))
		),"250px","box-interna")
	)),
	"attr" => e("DIV","class=attr-personagem")
);
$e = array();

$value->getAttrBonus();
for ($x=1; $x < 9; $x++) { 
	$ptTotal[$x] = $value->attr[getAtributoTabela($x)]+$value->attrBonus[getAtributoTabela($x)];
}

for($x=1;$x<9;$x++){
	$str = $value->attr[getAtributoTabela($x)]." + ".$value->attrBonus[getAtributoTabela($x)]." = ".$ptTotal[$x];
	$e[$x] = e("DIV",array(
		e("SPAM","class=contem-hover",array(
			e("IMG","src=Imagens/Icones/".getAtributoImagem($x).".png"),
			e("DIV","class=hover",array(texto("<b>".getAtributoNome($x)."</b>".": ".getAtributoDescricao($x))))
		)),
		barra(210,"white",($ptTotal[$x]/max($ptTotal)),"green",$str,1),
		texto("&nbsp;"),
		($value->pts>0)?
			e("DIV","style=display:inline-block;",array(
				e("INPUT","class=input-add-atributo","id=".$value->id."a".$x),
				e("A","class=bt-add-atributo","attr=".$x,"pers=".$value->id,array(
					e("IMG","src=Imagens/Icones/add.png")
				))
			))
		:array()
	));
}
$e[10] = e("DIV",array(
	texto("Pontos a distribuir: ".$value->pts)
));
$preco_reset = $bd->fazArray("SELECT * FROM tb_vip_reset_atributos WHERE personagem_id=':0:'",array($value->id),array(ALL_FORMAT),FALSE);
$preco_reset = sizeof($preco_reset)*10;
if($preco_reset<2)$preco_reset=2;
if($preco_reset>50)$preco_reset=50;

$info["attr"]["c"][]=box($e,"340px","box-interna");
$info["status"] = e("DIV","class=clear",array(
	e("DIV","class=float-left",array(
		barra(200,"black",($value->hp/$value->getHPMax()),"green","HP: ".$value->hp." / ".$value->getHPMax()),
		barra(200,"black",($value->mp/$value->getMPMax()),"yellow","Energia: ".$value->mp." / ".$value->getMPMax()),
		barra(200,"black",($value->xp/$value->getXPMax()),"white","XP: ".$value->xp." / ".$value->getXPMax())
	)),
	e("DIV","class=personagem-buttons",array(
		e("BUTTON","class=link".(($value->xp >= $value->getXPMax() && $value->lvl < 50)?"":"_no")."_send","href=perEvoluir&per=".$value->id,array(texto("Evoluir"))),
		e("BUTTON","class=link_send_confirm","href=vipResetAtributos&per=".$value->id,"question=Resetar atributos custa ".$preco_reset." Moedas de Ouro e o preço aumenta a cada reset.<br>Deseja resetar os atributos?",array(
			texto("Resetar Atributos")
		))
	))
));

$conteudo["retorno"] = $info;