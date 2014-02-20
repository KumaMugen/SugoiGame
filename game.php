<?php 
	require "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>One Piece Sugoi Game</title>
	<link rel="stylesheet" href="CSS/estrutura.css" type="text/css" />
	<link rel="stylesheet" href="CSS/prompt.css" type="text/css" />
	<link rel="stylesheet" href="CSS/paginas.css" type="text/css" />
	<link rel="stylesheet" href="CSS/colorpicker.css" type="text/css" />
	<link rel="stylesheet" href="CSS/flagEditor.css" type="text/css" />
	<link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon" />
	<? include "CSS/cores.php"; ?>
	<link type="text/css" href="CSS/scroll.css" rel="stylesheet" charset="utf-8" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="robots" content="nofollow, noodp" />
	<meta name="keywords" content="one piece, one piece sugoi game, one piece game, game one piece, jogo one piece, one piece jogos online, jogo sugoi game, sugoi game, sugoi game online" />
	<meta name="description" content="Agora é a sua vez de escolher qual caminho seguir: se tornar um pirata e ir atrás de tesouros, ou se tornar um marinheiro e defender o mundo dos piratas. Compre um navio, junte sua tripulação e venha viver aventuras no mundo de One Piece! Jogue Grátis!" />
	<meta name="Author" content="One Piece Sugoi game" />
</head>
	<script type="text/javascript" src="JS/jquery.js"></script>
	<script type="text/javascript" src="JS/jquery-ui.min.js"></script>
	<script type="text/javascript" src="JS/prompt.js"></script>
	<script type="text/javascript" src="JS/colorpicker.js"></script>
	<script type="text/javascript" src="JS/funcoes.js"></script>
	<script type="text/javascript" src="JS/flagEditor.js"></script>
	<? include "JS/geral.php"; ?>
	<script type="text/javascript" src="JS/paginas.js"></script>
<!--
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-33708570-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
-->
<body>
<input id="questTrackBuffer" readonly="readonly" type="hidden">
<audio id="toque_nova_msg">
	<source src="Sons/nova_msg.ogg" type="audio/ogg" />
	<source src="Sons/nova_msg.mp3" type="audio/mpeg" />
</audio>
<div id="icon_carregando">
	<img src="Imagens/carregando.gif" /><br />
	Carregando...
</div>
<div id="alerta-realizacao">
	<div id="alerta-realizacao-content">
		<h3>Sugoooi!!!</h3>
		<div id="alerta-realizacao-texto"></div>
	</div>
</div>
<div id="alerta-informacao">
	<div id="alerta-informacao-content">
		<div id="alerta-informacao-texto"></div>
	</div>
</div>
<div id="bau">
	<div id="bau-conteudo">
		<a id="bau-fechar" href="#1">x</a>
		<div id="bau-content">
			<div id="bau-c-top">
				<select id="bau-select-tipo" class="bau-label">
					<option value="0">Itens</option>
					<option value="1">Equipamentos</option>
				</select>
				<span class="bau-label">Quantidade: <span  id="bau-capacidade-quantidade"></span></span>
			</div>
			<div id="bau-c-bot"></div>
		</div>
	</div>
</div>
<div id="criador-habilidade">
	<div id="criador-habilidade-form">
		<form class="form" action="perAprenderHabilidade">
			<a id="criador-habilidade-fechar" href="#1">
				x
			</a>
			<div id="criador-habilidade-titulo">
				Criar Habilidade
			</div>
			<div id="criador-habilidade-esquerda">
				<img src="Imagens/Personagens/Big/0000.png" />
			</div>
			<div id="criador-habilidade-centro">
				<input type="hidden" id="criador-habilidade-personagem" class="form-input" name="personagem" teste="<? echo INT_FORMAT; ?>" />
				<input type="hidden" id="criador-habilidade-habilidade" class="form-input" name="habilidade" teste="<? echo INT_FORMAT; ?>" />
				<input type="hidden" id="criador-habilidade-img" class="form-input" name="img" teste="<? echo INT_FORMAT; ?>" erro="Você não selecionou um ícone." />
				<div id="criador-habilidade-imagem">
					Ícone: <img src="Imagens/Skill/0.jpg" />
				</div>
				Nome: <input type="text" id="criador-habilidade-nome" class="form-input" name="nome" minlenght="5" maxlength="150" /><br/>
				Descrição: <textarea style="resize:vertical;" id="criador-habilidade-descricao" class="form-input" name="descricao" minlenght="5"></textarea><br/>
				<button id="criador-habilidade-button" type="submit">Aprender</button>
			</div>
			<div id="criador-habilidade-direita">
				
			</div>
			<div class="clear"></div>
		</form>
	</div>
</div>
<div id="corpo">
	<div id="pagina">
		<div id="header">
			<div id="logo">
				<a href="game.php" title="One Piece Sugoi Game">
					<img src="Imagens/logo.png" alt="One Piece Sugoi Game" />
				</a>
			</div>
			<div id="news">
				<img id="news-gaivota" src="Imagens/news.png" height="70px" />
				<div id="news-content">
					<div id="news-content-text"></div>
				</div>
			</div>
			<div id="bandeira">
				<img src="Imagens/Bandeiras/deslogado.png" alt="Sugoi Game Bandeira" width="95px" />
			</div>
		</div>
		<div id="menu">
			<div id="menu-links">
				<ul id="menu-ul">
					<li id="menu-li-principal">
						<a class="link_content menu-li" href="?ses=home" title="Principal">
							<img src="Imagens/Icones/Sessoes/principal.png" alt="Principal">
						</a>
					</li>
					<li id="menu-li-tripulacao">
						<a class="link_content menu-li" href="?ses=tripulacaoStatus" title="Tripulação">
							<img src="Imagens/Icones/Sessoes/tripulacao.png" alt="Tripulação">
						</a>
					</li>
					<li id="menu-li-navio">
						<a class="link_content menu-li" href="?ses=navio" title="Navio">
							<img src="Imagens/Icones/Sessoes/navio.png" alt="Navio">
						</a>
					</li>
					<li id="menu-li-ilha">
						<a class="link_content menu-li" href="?ses=ilhaGeral" title="Ilha Atual">
							<img src="Imagens/Icones/Sessoes/ilha.png" alt="Ilha Atual">
						</a>
					</li>
					<li id="menu-li-oceano">
						<a class="link_content menu-li" href="?ses=oceano" title="Oceano">
							<img src="Imagens/Icones/Sessoes/oceano.png" alt="Oceano">
						</a>
					</li>
					<li id="menu-li-alianca">
						<a class="link_content menu-li" href="?ses=alianca" title="Aliança">
							<img src="Imagens/Icones/Sessoes/alianca.png" alt="Aliança">
						</a>
					</li>
					<li id="menu-li-frota">
						<a class="link_content menu-li" href="?ses=frota" title="Frota">
							<img src="Imagens/Icones/Sessoes/frota.png" alt="Frota">
						</a>
					</li>
					<li id="menu-li-combate">
						<a class="link_content menu-li" href="?ses=combate" title="Combate">
							<img src="Imagens/Icones/Sessoes/batalha.png" alt="Combate">
						</a>
					</li>
				</ul>
			</div>
			<div id="sub-menu">
				<div id="sub-menu-links">
					<div id="sub-menu-links-texto">
						<div id="links-texto-cnt"></div>
						<div id="links-texto-bottom"></div>
					</div>
					<div id="gold">
						<img src="Imagens/Icones/Gold.png" title="Moedas de Ouro" />
						<div id="gold-quant"></div>
					</div>
					<div id="berries">
						<img src="Imagens/Icones/Berries.png" title="Berries" />
						<div id="berries-quant"></div>
					</div>
					<div id="locate">
						<img src="Imagens/Icones/Pose.png" title="Localização" />
						<div id="locate-quant"></div>
					</div>
				</div>
			</div>
			<div id="menu-l">
				<ul id="menu-l-ul">
					<li id="menu-li-questTracker">
						<div id="questTracker"> </div>
						<a href="#1">
							<img src="Imagens/NPC/missao-2.png" alt="Quest Tracker" title="Monitorador de Missões">
						</a>
					</li>
					<li id="menu-li-bau">
						<a href="#1">
							<img id="icon-bau" src="Imagens/Icones/Bau.png" alt="Inventário" title="Inventário" >
						</a>
					</li>
					<li id="menu-li-cadastro">
						<a class="link_content" href="?ses=cadastro">
							<img src="Imagens/Icones/Visao_geral.png" alt="Cadastro" title="Cadastre-se">
						</a>
					</li>
					<li id="menu-li-sistema">
						<a class="link_content" href="?ses=sistemaHome">
							<img src="Imagens/Icones/Minha_conta.png" alt="Sistema" title="Painel do Sistema">
						</a>
					</li>
					<li id="menu-li-desconectarTrip">
						<a class="link_send" href="usrTripulacaoDesconectar">
							<img src="Imagens/Icones/Logout.png" alt="Seleção de tripulação" title="Voltar para seleção de tripulação">
						</a>
					</li>
					<li id="menu-li-deslogar">
						<a class="link_send" href="geralDeslogar">
							<img src="Imagens/Icones/Logout.png" alt="Logout" title="Sair">
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="tripulantes"></div>
		<div id="conteudo"></div>
		<div id="footer">
			<div id="footer-content">
				Sugoi Game 2012 - <a href="?ses=politica" class="link_content">Política de Privacidade</a> - 
				<a href="?ses=regras" class="link_content">Regras e Punições</a><br />
				Personagens e desenhos © CopyRight 1997 by Eiichiro Oda. Todos os direitos reservados.
			</div>
		</div>
	</div>
	<div id="adsense">
		<!--
		<script type="text/javascript">
		google_ad_client = "ca-pub-2056056065595983";
		/* Home */
		google_ad_slot = "9929458094";
		google_ad_width = 728;
		google_ad_height = 90;
		//--
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
		-->
	</div>
</div>
</body>
</html>