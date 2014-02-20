<?php
	require "config.php";
	
	if(Usuario::$logado){
		header("location:game.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<title>One Piece Sugoi Game</title>
	<link rel="stylesheet" href="CSS/prompt.css" type="text/css" />
	<link rel="stylesheet" href="CSS/index.css" type="text/css" />
	<link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="robots" content="nofollow, noodp" />
	<meta name="keywords" content="one piece, one piece sugoi game, one piece game, game one piece, jogo one piece, one piece jogos online, jogo sugoi game, sugoi game, sugoi game online" />
	<meta name="description" content="Compre um navio, junte sua tripulação e saia em busca de aventuras pelo universo de One Piece!" />
	<meta name="Author" content="One Piece Sugoi game" />
</head>
<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript" src="JS/prompt.js"></script>
<script type="text/javascript">
	$(function(){
		$("#form_login").submit(function(){
			if($("#checkAcordo").attr('checked')!='checked'){
				$.prompt("Você precisa estar de acordo com as Regras de conduta e a Política de privacidade do site",{prefix:'jqismooth'});
				return false;
			}
		});
		//exibe os erros capturados pelo objeto erro
		erro='<?php echo $erro->errosRetornados().$erro->msgsRetornadas(); ?>';
		if(erro.length>0)
			$.prompt(erro,{prefix:'jqismooth'});
			
		$(".link_popup").live('click', function(e){
			e.preventDefault();
			var locale=this.href;
			var t = $(this).attr("t");
			var d = $(this).attr("d");
			wind = window.open(locale,t,d);
		});
	});
	
</script>
<body>
	<div id="corpo">
		<div id="login">
			<img src="Imagens/borda-TD.png" class="borda-td" />
			<img src="Imagens/borda-TE.png" class="borda-te" />
			<img src="Imagens/borda-BD.png" class="borda-bd" />
			<img src="Imagens/borda-BE.png" class="borda-be" />
			<div id="login-content">
				<form name="login" action="runRedir.php?script=geralLogar" method="POST" id="form_login">
				<div class="inpt">
					<span>Email: </span><input name="login" />
				</div>
				<div class="inpt">
					<span>Senha: </span><input type="password" name="senha" />
				</div>
				<div class="inpt-check">
					<input type="checkbox" id="checkAcordo" /> Eu li e estou de acordo com as 
					<a href="game.php?ses=regras" target="_blank">Regras de conduta</a> e a 
					<a href="game.php?ses=politica" target="_blank">Política de privacidade</a> do site</td>
				</div>
				<button type="submit" id="logar"></button>
				</form>
				<a class="link_popup" t="Facebook" d="toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=650,height=380"
				href="<?php echo $facebook->getLoginUrl(array("display"=>"popup","scope"=>"email,publish_stream","redirect_uri"=>"http://localhost/SugoiGame3/redirectFB.php")) ?>" id="logarFB"></a>
			</div>
		</div>
		<a href="game.php?ses=cadastro"id="cadastro"></a>
		<div id="conteudo">
			<img src="Imagens/borda-TD.png" class="borda-td" />
			<img src="Imagens/borda-TE.png" class="borda-te" />
			<img src="Imagens/borda-BD.png" class="borda-bd" />
			<img src="Imagens/borda-BE.png" class="borda-be" />
			<div id="batalhas">
				<img src="Imagens/borda-TD.png" class="borda-td" />
				<img src="Imagens/borda-TE.png" class="borda-te" />
				<img src="Imagens/borda-BD.png" class="borda-bd" />
				<img src="Imagens/borda-BE.png" class="borda-be" />
				<div id="bt-titulo"></div>
			</div>
			<div class="info-geral">
				<img src="Imagens/Index/sobre.png" class="title" /><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;One Piece Sugoi Game é um jogo de navegador gratuiuto baseado na série 
				animada de TV "One Piece" feita por Eiichiro Oda.<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Antes de morrer, o Rei dos Piratas anunciou ao mundo que seu tesouro, o 
				One Piece, estava escondido em algum lugar da Grande Rota, que é o maior oceano do planeta. Após isso várias
				pessoas se jogaram ao mar querendo encontra-lo, abrindo mão de suas vidas normais e com o sonho de se tornarem
				grandes piratas.<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Sugoi Game, o jogador vive na pele a experiência de se tornar um pirata
				em busca de reputação e tesouros, ou de um marinheiro em busca de honra e reconhecimento. Ambos devem formar
				sua tripulação, evoluir seus personagens e conquistar esse vasto mundo inexplorado.<br />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</body>
