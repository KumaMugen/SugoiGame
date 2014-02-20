<?php
	$width[1]=33;
	$width[2]=35;
	$width[3]=39;
	$width[4]=42;
	$width[5]=46;
	$width[6]=50;
	$width[7]=55;
	$width[8]=62;
	$width[9]=68;
	$width[10]=75;
?>

<!DOCTYPE html>
<html>
<head>
	<title>One Piece Sugoi Game</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="robots" content="nofollow, noodp" />
	<meta name="keywords" content="one piece, one piece sugoi game, one piece game, game one piece, jogo one piece, one piece jogos online, jogo sugoi game, sugoi game, sugoi game online" />
	<meta name="description" content="Agora é a sua vez de escolher qual caminho seguir: se tornar um pirata e ir atrás de tesouros, ou se tornar um marinheiro e defender o mundo dos piratas. Compre um navio, junte sua tripulação e venha viver aventuras no mundo de One Piece! Jogue Grátis!" />
	<meta name="Author" content="One Piece Sugoi game" />
</head>
<style type="text/css">
/* Barras */
.externo{
    position: relative;
    background-repeat: repeat-x;
    border-radius: 0px 40px 0px 0px;
    border: 1px solid #000;
}
.interno{
    position: absolute;
        top: 0px;
        left: 0px;
    background-repeat: repeat-x;
    border-radius: 0px 40px 0px 0px;
}
.interno-texto{
    position: absolute;
        top: 0px;
        left: 0px;
    width: 100%;
    margin: auto;
    font-family: Arial, sans-serif;
    color: #FFFFFF;
    text-shadow:#000 1px -1px, #000 -1px 1px, #000 1px 1px, #000 -1px -1px;
    text-align: center;
}
.barra-small-5{ height: 2px; border: none; border-radius: 0 !important; }
.barra-small-5 .interno{ height: 2px; border-radius: 0 !important; }
.barra-small-5 .interno-texto{ display: none; }

.green-c{ background: #00FF00; }
.red-c{ background: #FF0000; }

#batalha{
	width: 920px;
	height: 800px;
	position: relative;
}
#cabecalho{
	width: 920px;
	height: 190px;
	background: url("../Imagens/Batalha/Cabecalho.jpg");
	position: relative;
}
#conteudo{
	width: 920px;
	height: 610px;
	background: url("../Imagens/Batalha/bgPvP-1.jpg");
	position: relative;
}
#tabuleiro{
	width: 920px;
	height: 610px;
	background: url("../Imagens/Batalha/TabuleiroPvP.png");
	position: absolute;
		top: 0px;
		left: 0px;
}
.quadro,
.personagem{
	cursor: pointer;
}
.personagem{
	box-shadow: 0px 5px 8px -2px #000;
	border-radius: 3px;
	position: absolute;
}
.personagem:hover{ box-shadow: 0px 0px 8px 5px #fff; z-index: 99; }

.quadro{ position: absolute; opacity: 0.5; }

#ataque{ display: none; position: absolute; z-index: 200; }

.atacavel{ box-shadow: 0px 0px 2px 2px #F90; background: #F00; }
.movivel{ box-shadow: 0px 0px 2px 2px #0AF; background: #04F; }

.atacavel:hover,.movivel:hover
{ box-shadow: 0px 0px 8px 5px #FF0; z-index: 99; }

.atacavel img,.movivel img
{ opacity: 0.6; }
/*
.quadro:hover{ box-shadow: 0px 0px 8px 5px #fff; background: #fff; }
*/

.personagem.aliado{ border: 2px solid #0000FF; }
.personagem.aliado-c{ border: 2px solid #00DDFF; }
.personagem.inimigo{ border: 2px solid #FF0000; }
.personagem.inimigo-c{ border: 2px solid #FFDD00; }
.personagem img{ display: block; }

.linha{
	position: absolute;
}

/* 1 */
#linha-1{
	top: 188px;
	left: 238px;
	z-index: 1;
}

/* 2 */
#linha-2{
	top: 205px;
	left: 229px;
	z-index: 2;
}

/* 3 */
#linha-3{
	top: 222px;
	left: 215px;
	z-index: 3;
}

/* 4 */
#linha-4{
	top: 243px;
	left: 200px;
	z-index: 4;
}

/* 5 */
#linha-5{
	top: 273px;
	left: 180px;
	z-index: 5;
}

/* 6 */
#linha-6{
	top: 303px;
	left: 162px;
	z-index: 6;
}

/* 7 */
#linha-7{
	top: 340px;
	left: 140px;
	z-index: 7;
}

/* 8 */
#linha-8{
	top: 382px;
	left: 107px;
	z-index: 8;
}

/* 9 */
#linha-9{
	top: 435px;
	left: 80px;
	z-index: 9;
}

/* 10 */
#linha-10{
	top: 498px;
	left: 38px;
	z-index: 10;
}
</style>
<script type="text/javascript" src="../JS/jquery.js"></script>
<script type="text/javascript" src="../JS/jquery-ui.min.js"></script>
<script type="text/javascript" src="../JS/prompt.js"></script>
<script type="text/javascript" src="../JS/funcoes.js"></script>
<script type="text/javascript">
	dist={
		1:40,
		2:42,
		3:45,
		4:48,
		5:52,
		6:56,
		7:61,
		8:68,
		9:74,
		10:83
	}
	width={
		1:<? echo $width[1] ?>,
		2:<? echo $width[2] ?>,
		3:<? echo $width[3] ?>,
		4:<? echo $width[4] ?>,
		5:<? echo $width[5] ?>,
		6:<? echo $width[6] ?>,
		7:<? echo $width[7] ?>,
		8:<? echo $width[8] ?>,
		9:<? echo $width[9] ?>,
		10:<? echo $width[10] ?>
	}
	$(function(){
		//
		startTabuleiro();
		
		//
		$.ajax({
			url: 'conteudo.php',
			dataType: 'json',
			cache: false,
			error: function(){
				$.prompt('Ocorreu algum erro ao tentar se conectar com o servidor.<br />Por favor atualize a página e tente novamente.<br />Sugoi Game é um jogo gratuito e sem fins lucrativos, por isso precisamos da ajuda dos jogadores para permanecer ativos.<br />Se quiser ajudar para que esse erro não volte a acontecer, colabore comprando moedas de ouro!',{prefix:'jqismooth'});
			},
			success: function(retorno){
				$.each(retorno.time,function(key,value){
					aliado=(value.cap)?"aliado-c":"aliado";
					addPersonagem(key,value,aliado);
				});
				$.each(retorno.oponente,function(key,value){
					aliado=(value.cap)?"inimigo-c":"inimigo";
					addPersonagem(key,value,aliado);
				});
			}
		});
		
		//
		$(".personagem").live("click",function(){ personagemAtacar(this) });
		
		//
		$(".atacavel").live("click",function(){
			dTop = $("#linha-"+$(this).data("x")).position().top;
			dLeft = $("#linha-"+$(this).data("x")).position().left + $(this).position().left;
			
			//realiza animacao de ataque
			$("#ataque")
				.fadeIn(100)
				.animate({
					top: dTop+"px",
					left: dLeft+"px"
					},500,function(){ $("#ataque").fadeOut(); }
				);
			//
			
			$(".atacavel").removeClass("atacavel");
			$(".personagem").live("click",function(){ personagemAtacar(this) });
		});
	});
	
	//
	function startTabuleiro(){
		for(x=1;x<=10;x++){
			$("#linha-"+x).html("");
			for(y=1;y<=10;y++){
				$("#linha-"+x).append(
					$("<DIV>")
						.addClass("quadro")
						.attr("id",x+"-"+y)
						.css("left",dist[x]*(y-1))
						.data("x",x)
						.data("y",y)
						.attr("width",width[x])
						.append(
							$("<IMG>")
								.attr("src","../Imagens/Transparent.png")
								.attr("width",width[x])
						)
				);
			}
		}
	}
	
	//
	function addPersonagem(key,value,aliado){
		razao = value.hp/value.hpM;
			$("#"+value.x+"-"+value.y)
				.html("")
				.removeClass("quadro")
				.addClass("personagem")
				.addClass(aliado)
				.data("pers",value.key)
				.append(barra(width[value.x], "red-c", razao, "green-c", "", 5 ))
				.append(
					$("<IMG>")
						.attr("src","../Imagens/Personagens/Icons/"+value.img+".jpg")
						.attr("width",width[value.x])
				);
	}
	
	//
	function personagemAtacar(pers){
			c_x = parseInt($(pers).data("x"),10);
			c_y = parseInt($(pers).data("y"),10);
			
			$(".atacavel").removeClass("atacavel");
			
			rx={1:1,2:1,3:0,4:-1,5:-1,6:-1,7:0,8:1};
			ry={1:0,2:1,3:1,4:1,5:0,6:-1,7:-1,8:-1};
			
			alcance=7;
			
			for(r=1;r<=8;r++){
				initx = 0;
				inity = 0;
				while(Math.abs(initx)<alcance && Math.abs(inity)<alcance){
					initx += rx[r];
					inity += ry[r];
					$("#"+(c_x+initx)+"-"+(c_y+inity))
						.addClass("atacavel");
					
					if($("#"+(c_x+initx)+"-"+(c_y+inity)).hasClass("personagem")){
						initx = alcance;
						inity = alcance;
					}
				}
			}
			
			//posiciona img pra animacao de ataque
			dTop = $("#linha-"+c_x).position().top;
			dLeft = $(pers).position().left + $("#linha-"+c_x).position().left;
			$("#ataque")
				.html("")
				.css("top",dTop+"px")
				.css("left",dLeft+"px")
				.append(
					$("<IMG>")
						.attr("src","../Imagens/Skill/13.jpg")
				)
			//
			
			$(".personagem").die("click");
		}
</script>
<body>
	<div id="batalha">
		<div id="cabecalho">
			
		</div>
		<div id="conteudo">
			<div id="tabuleiro">
				<div id="ataque"></div>
				<div id="linha-1" class="linha"></div>
				<div id="linha-2" class="linha"></div>
				<div id="linha-3" class="linha"></div>
				<div id="linha-4" class="linha"></div>
				<div id="linha-5" class="linha"></div>
				<div id="linha-6" class="linha"></div>
				<div id="linha-7" class="linha"></div>
				<div id="linha-8" class="linha"></div>
				<div id="linha-9" class="linha"></div>
				<div id="linha-10" class="linha"></div>
			</div>
		</div>
	</div>
</body>
</html>