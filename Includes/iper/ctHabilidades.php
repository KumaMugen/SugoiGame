<?php
//pega todas as habilidades para preencher um cache
$habilidades = $bd->fazArray(
	"SELECT * FROM tb_per_habilidade WHERE categoria='1'"
);

//declaracao das variaves com habilidades sepradas por arvores
$hab[1] = array(
	1 => array(),
	2 => array(),
	3 => array()
);
$hab[2] = array(
	1 => array(),
	2 => array(),
	3 => array()
);
$hab[3] = array(
	1 => array(),
	2 => array(),
	3 => array()
);
//organiza as informacoes
foreach ($habilidades as $key => $value2) {
	if($value2["requisito_classe"]==1)
		$hab[1][$value2["arvore"]][$value2["sequencia"]] = $value2;
	else if($value2["requisito_classe"]==2)
		$hab[2][$value2["arvore"]][$value2["sequencia"]] = $value2;
	else if($value2["requisito_classe"]==3)
		$hab[3][$value2["arvore"]][$value2["sequencia"]] = $value2;
}
$value->getClasse();
	$c = $value->classe;
		
//verifica se o personagem possui classe definida
if($c!=0){
	//loop pelas arvores
	for($arvore=1; $arvore <= 3; $arvore++){
		$a[$arvore] = e("DIV","class=arvore arvore-$arvore",array());
		
		//loop pelas habilidades de cada arvore
		for($x=1; $x <= 11; $x++){
			//pontos gastos na habilidade
			$pts[$x] = $value->getPontosInHabilidade($hab[$c][$arvore][$x]["habilidade_id"]);
			
			//variavel de controle para classe
			$class="";
			
			//informação da habilidade
			$infoHabilidade = getInfoHabilidade($hab[$c][$arvore][$x]);
			
			if($pts[$x] >= $hab[$c][$arvore][$x]["requisito_pontos"] AND !$value->hasHabilidade($hab[$c][$arvore][$x]["habilidade_id"])){
				$infoHabilidade[] = e("BUTTON","class=link_habilidade",
					"pers=".$value->id,"habilidade=".$hab[$c][$arvore][$x]["habilidade_id"],
					"img=".$value->getSkinC(),
					array(texto("Aprender Habilidade")));
			}
			
			//icone da habilidade
			$img = e("DIV","class=habilidade-img",array( 
				e("IMG","src=Imagens/Skill/Tipo/".$hab[$c][$arvore][$x]["tipo"].".png"),
				e("DIV",array(
					box($infoHabilidade,"255px","habilidade-box-info")
				))
			));
			
			//cria link com opçao de adicionar ponto na habilidade
			if(($x == 1 OR $pts[$x-1] > 0) AND $pts[$x] < $hab[$c][$arvore][$x]["requisito_pontos"] AND $value->pontosHabilidade>0){
				$class = "disponivel";
				$link = e("A","class=link_send_confirm","question=Deseja gastar 1 ponto nessa habilidade?",
				"href=ctAddPonto&pers=".$value->id."&habi=".$hab[$c][$arvore][$x]["habilidade_id"],array(
					$img
				));
			}
			else
				$link = $img;
			
			//adiciona a habilidade na arvore
			$a[$arvore]["c"][] = e("DIV","class=habilidade $class",array(
				$link,
				e("DIV","class=habilidade-quant",array(
					texto($pts[$x]." / ".$hab[$c][$arvore][$x]["requisito_pontos"])
				))
			));
		}
	}
	
	//adiciona a arvore na tela do personagem
	$info = array(
		e("DIV","class=personagem-info-habilidade",array(
			e("DIV",array(texto("Pontos a distribuir: ".$value->pontosHabilidade))),
			e("DIV",array(texto("Próximo ponto no nível ".getNextLvlHabilidade($value->lvl))))
		)),
		e("DIV","style=background:url(Imagens/Backgrounds/".getClasse($c).".jpg)","class=personagem-habilidades",$a),
		e("DIV",array(
			e("BUTTON","class=link_send_confirm",
			"question=Redefinir pontos de habilidades custa 5 Moedas de Ouro.<br>Deseja redefinir os pontos de habilidade deste personagem?",
			"href=vipResetHabilidades&per=".$value->id,
			array(texto("Redefinir pontos")))
		))
	);
}
else{
	$info = array(
		texto("Este personagem ainda não possui uma classe de combate.")
	);
}

$conteudo["retorno"] = $info;
