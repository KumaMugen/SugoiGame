<? if($conect){ ?>
	<div id="musica_fundo_div">
		<button class="btn_player" id="player_play"></button>
		<button class="btn_player" id="player_pause"></button>
		<button class="btn_player" id="player_menos"></button>
		<button class="btn_player" id="player_mais"></button>
	</div>
	<script type="text/javascript">
		$("#player_play").live("click", function(){
			document.getElementById("musica_fundo").play();
			$(this).fadeOut(0);
			$("#player_pause").fadeIn();
		});
		$("#player_pause").live("click", function(){
			document.getElementById("musica_fundo").pause();
			$(this).fadeOut(0);
			$("#player_play").fadeIn();
		});
		$("#player_mais").live("click", function(){
			document.getElementById("musica_fundo").volume += 0.1;
		});
		$("#player_menos").live("click", function(){
			document.getElementById("musica_fundo").volume -= 0.1;
		});
	</script>
	<div id="div_musica_fundo">
		<audio id="musica_fundo" loop="loop">
			<? include "Funcoes/musica_aleatoria.php"; if($inilha)$pasta="ilha";else if($incombate)$pasta="combate";else $pasta="oceano"; $musica=musica_aleatoria($pasta); ?>
			<source id="musica_fundo_ogg" src="Sons/<? echo $musica; ?>.ogg" type="audio/ogg" >
			<source id="musica_fundo_mp4" src="Sons/<? echo $musica; ?>.mp3" type="audio/mp3" >
		</audio>
	</div>
<? } ?>