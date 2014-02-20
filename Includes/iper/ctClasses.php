<?php
$value->getClasse();
$c = $value->classe;
if($c==0){
	$info = array(
		e("A","href=ctAprenderClasse&pers=".$value->id."&classe=1","question=".getClasseDescricao(1)."<br>Deseja transformar este persongem em um Espadachim?","class=img-classe link_send_confirm",array(
			e("IMG","src=Imagens/Backgrounds/Espadachim-seletor.jpg")
		)),
		e("A","href=ctAprenderClasse&pers=".$value->id."&classe=3","question=".getClasseDescricao(3)."<br>Deseja transformar este persongem em um Atirador?","class=img-classe link_send_confirm",array(
			e("IMG","src=Imagens/Backgrounds/Atirador-seletor.jpg")
		)),
		e("A","href=ctAprenderClasse&pers=".$value->id."&classe=2","question=".getClasseDescricao(2)."<br>Deseja transformar este persongem em um Lutador?","class=img-classe link_send_confirm",array(
			e("IMG","src=Imagens/Backgrounds/Lutador-seletor.jpg")
		))
	);
}
else{
	$info=array(
		e("IMG","src=Imagens/Backgrounds/".getClasse($c)."-seletor.jpg"),
		e("BR"),
		e("BUTTON","href=vipResetClasse&per=".$value->id,"class=link_send_confirm","question=Trocar a classe custa 30 Moedas de Ouro.<br>Deseja mesmo Trocar a classe deste personagem?",array(texto("Trocar de Classe")))
	);
}

$conteudo["retorno"] = $info;
