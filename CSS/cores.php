<?php
	if(Usuario::$faccao != NULL && Usuario::$faccao == 0){
		$cor = 0;
		$bg = "#cccccc";
		$border = "#444444";
		$border2 = "#2c6a2c";
	}
	else{
		$cor = 1;
		$bg = "#d6a064";
		$border = "#bb7d28";
		$border2 = "#bb7d28";
	}
?>
<style type="text/css">
/* geral */
input,
select,
textarea,
input[type="checkbox"]
{
	background: <?php echo $bg ?>;
}
button{
	background: url("Imagens/<?php echo $cor ?>/buttonOff.jpg");
}
button:hover{ background: url("Imagens/<?php echo $cor ?>/button.jpg"); }
button[class="link_no_send"],
button[class="link_no_send_confirm"]{
	background: url("Imagens/<?php echo $cor ?>/buttonDes.jpg");
	cursor: auto;
}
.titulo-img{ background: url("Imagens/<?php echo $cor ?>/leme.png"); }
.geral-box .geral-box-content,
#ilhaGeral #ilha-externo-lateral .superior,
#ilhaGeral #ilha-externo-lateral .inferior{
	background: url("Imagens/<?php echo $cor ?>/back.jpg");
	border: 3px solid <?php echo $border2 ?>;
	border-radius: 4px;
}
.box-interna .geral-box-content{
	background: transparent;
	border: 3px solid #aaa;
	border-radius: 4px;
}
#menu-interno ul a{
	background: url("Imagens/<?php echo $cor ?>/back.jpg");
	border-top: 1px solid <?php echo $border2 ?>;
	border-right: 2px solid <?php echo $border2 ?>;
	border-bottom: 1px solid <?php echo $border2 ?>;
}
#gold, #berries, #locate{
	border: 1px solid <?php echo $border2 ?>;
}
#tripulantes{
	background: url("Imagens/<?php echo $cor ?>/tripulantes.png")
}

/* background Back repeat-x */
#menu-links{
	background: url("Imagens/<?php echo $cor ?>/menu.png") no-repeat center;
}
#sub-menu{
	background: url("Imagens/<?php echo $cor ?>/menuSub.png") no-repeat center;
}
#conteudo-borda{
	background: url("Imagens/<?php echo $cor ?>/content-BordaT.png") no-repeat top,
	url("Imagens/<?php echo $cor ?>/content-BordaD.png") no-repeat bottom,
	url("Imagens/<?php echo $cor ?>/content-BordaM.png") repeat-y center;
}
#bandeira{ background: url("Imagens/<?php echo $cor ?>/mastro.png") no-repeat center; }

#links-texto-bottom{ background: url("Imagens/<?php echo $cor ?>/seletor.png") no-repeat center; }

/* background back repeat */
.titulo-texto,
#menu-l-ul li a,
.step-seletor .step-switch,
#seletor-capitao-div div
{ background: url("Imagens/<?php echo $cor ?>/cabecalho.png"); }

#alerta-realizacao-content{ background: url("Imagens/<?php echo $cor ?>/realizacao.png"); }

#conteudo-container{ background: url("Imagens/Backgrounds/conteudo.jpg"); }
</style>