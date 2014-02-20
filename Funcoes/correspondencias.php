<?php
function getMsgErroDeslogado(){
	return "Você não pode fazer isso enquanto estiver logado";
}
function getMsgErroLogado(){
	return "Você não pode fazer isso enquanto estiver deslogado";
}
function getMsgErroComTrip(){
	return "Você não pode fazer isso tendo selecionado uma tripulação";
}
function getMsgErroSemTrip(){
	return "Você não pode fazer isso sem antes ter selecionado uma tripulação";
}
function getMsgErroPersonagem(){
	return "Personagem inválido";
}
function getMsgErroGold(){
	return "Você não tem Moedas de Ouro Suficientes";
}
function getMsgErroPermissao(){
	return "Você não tem Permissão para acessar essa área";
}
function getMsgErroInCombate(){
	return "Você não pode fazer isso enquanto estiver em combate";
}
function getMsgErroOutCombate(){
	return "Você não pode fazer isso enquanto estiver fora de combate";
}
function getMsgErroInIlha(){
	return "Você não pode fazer isso enquanto estiver em uma ilha";
}
function getMsgErroOutIlha(){
	return "Você não pode fazer isso enquanto estiver fora de uma ilha";
}
function getMsgErroInNavio(){
	return "Você não pode fazer isso enquanto estiver em um Navio";
}
function getMsgErroOutNavio(){
	return "Você não pode fazer isso enquanto estiver fora de um Navio";
}
function getMsgErroInMissao(){
	return "Você não pode fazer isso enquanto estiver em uma missão";
}
function getMsgErroOutMissao(){
	return "Você não pode fazer isso enquanto estiver fora de uma Missão";
}
function getMsgErroInRecrutamento(){
	return "Você não pode fazer isso enquanto estiver recrutando personagens.";
}
function getMsgErroOutRecrutamento(){
	return "Você não pode fazer isso enquanto não estiver recrutando personagens";
}
function getMsgErroInRota(){
	return "Você não pode fazer isso enquanto estiver navegando.";
}
function getMsgErroOutRota(){
	return "Você não pode fazer isso enquanto não estiver navegando";
}
function getMsgErroIsDerrotado(){
	return "Você não pode fazer isso enquanto sua tripulação estiver totalmente inabilitada.";
}
function getMsgErroNotDerrotado(){
	return "Você não pode fazer isso sem que sua tripulação esteja totalmente inabilitada.";
}
function getErroFormularioIncompleto(){
	return "Dados Incompletos.";
}
function getErroInformacaoInvalida($campo="Algum campo"){
	return "$campo comtém um tipo de dado inválido";
}
function getMsgErroInventarioLotado(){
	return "Não há mais espaço no seu inventário.";
}
function getNomeFaccao($f){
	if($f==0) return "Marinheiro";
	else return "Pirata";
}
function getClasse($int){
	switch ($int) {
		case 1: return "Espadachim"; break;
		case 2: return "Lutador"; break;
		case 3: return "Atirador"; break;
		default: return "Nenhuma"; break;
	}
}
function getClasseDescricao($int){
	switch ($int) {
		case 1: return "Espadachins são fortes causadores de dano, personagens com muitas habilidades de ataque."; break;
		case 2: return "Lutadores são personagens bem resistentes que possuem builds voltadas para o equilibrio entre dano alto e muita defesa."; break;
		case 3: return "Atiradores são aliados estratégicos com muitas habilidades de longo alcance, habilidades em área e muitos buffs."; break;
		default: return "Nenhuma"; break;
	}
}
function getProfissao($int){
	switch ($int) {
		case 1: return "Cartógrafo"; break;
		case 2: return "Navegador"; break;
		case 3: return "Médico"; break;
		case 4: return "Carpinteiro"; break;
		case 5: return "Arqueólogo"; break;
		case 6: return "Mergulhador"; break;
		case 7: return "Cozinheiro"; break;
		case 8: return "Músico"; break;
		case 9: return "Combatente"; break;
		case 10: return "Engenheiro"; break;
		case 11: return "Ferreiro"; break;
		case 12: return "Artesão"; break;
		default: return ""; break;
	}
}
function getAtributoNome($att){
	switch ($att) {
		case 1: return "Ataque"; break;
		case 2: return "Defesa"; break;
		case 3: return "Agilidade"; break;
		case 4: return "Precisão"; break;
		case 5: return "Resistência"; break;
		case 6: return "Destreza"; break;
		case 7: return "Percepção"; break;
		case 8: return "Vitalidade"; break;
		default: return ""; break;
	}
}
function getAtributoImagem($att){
	switch ($att) {
		case 1: return "Ataque"; break;
		case 2: return "Defesa"; break;
		case 3: return "Agilidade"; break;
		case 4: return "Precisao"; break;
		case 5: return "Resistencia"; break;
		case 6: return "Destreza"; break;
		case 7: return "Percepcao"; break;
		case 8: return "Vitalidade"; break;
		default: return ""; break;
	}
}
function getAtributoDescricao($att){
	switch ($att) {
		case 1: return "Cada ponto aumenta o dano causado pelo personagem em 10 pontos."; break;
		case 2: return "Cada ponto diminui o dano sofrido pelo personagem em 10 pontos."; break;
		case 3: return "Cada ponto aumenta sua chance de se esquivar do ataque inimigo em 1%."; break;
		case 4: return "Cada ponto diminui a chance do inimigo se esquivar do seu ataque em 1%, de bloquear em 1% e o dano bloqueado em 1%."; break;
		case 5: return "Cada ponto aumenta sua chance de bloquear o ataque inimgo em 1% e o dano bloequeado em 1%"; break;
		case 6: return "Cada ponto aumenta sua chance de acertar um ataque crítico em 1% e o dano causado por ataques críticos em 1%.";break;
		case 7: return "Cada ponto reduz a chance do inimigo te acertar um ataque crítico em 1% e o dano causado por ataques críticos em 1%.";break;
		case 8: return "Cada ponto aumenta seu HP máximo em 50 pontos e sua Energia máxima em 7 pontos."; break;
		default: return ""; break;
	}
}
function getAtributoTabela($att){
	switch ($att) {
		case 1: return "atk"; break;
		case 2: return "def"; break;
		case 3: return "agl"; break;
		case 4: return "pre"; break;
		case 5: return "res"; break;
		case 6: return "des"; break;
		case 7: return "per"; break;
		case 8: return "vit"; break;
		default: return""; break;
	}
}
function getAtributosInArray(){
	return array(
			"atk" =>0,
			"def" =>0,
			"agl" =>0,
			"res" =>0,
			"pre" =>0,
			"des" =>0,
			"per" =>0,
			"vit" =>0
		);
}
function getAtributoTabelaCompleto($att){
	switch ($att) {
		case 1: return "atributo_atk"; break;
		case 2: return "atributo_def"; break;
		case 3: return "atributo_agl"; break;
		case 4: return "atributo_pre"; break;
		case 5: return "atributo_res"; break;
		case 6: return "atributo_des"; break;
		case 7: return "atributo_per"; break;
		case 8: return "atributo_vit"; break;
		default: return ""; break;
	}
}
function getNextLvlHabilidade($lvl){
	$ans = 50;
	$i = 0;
	while( $i <= 50 ){
		if($lvl < $i ){
			$ans = $i;
			break;
		}
		
		$c = substr($i,-1,1);
		if($c == 0)
			$i += 3;
		else if($c == 8)
			$i += 2;
		else
			$i += 5;
	}
	return $ans;
}
function getPtsHabilidadeLvl($lvl){
	$i = 0;
	$pt = 0;
	while( $i <= 50 ){
		if($lvl < $i )
			break;
		
		$c = substr($i,-1,1);
		if($c == 0)
			$i += 3;
		else if($c == 8)
			$i += 2;
		else
			$i += 5;
			
		$pt++;
	}
	if($pt==0)$pt=1;
	return $pt;
}
function getNomeSlotEquipamento($tipo){
	if ($tipo==1)  return "Cabeça";
	else if ($tipo==2) return "Corpo";
	else if ($tipo==3) return "Pernas";
	else if ($tipo==4) return "Pés";
	else if ($tipo==5) return "Mãos";
	else if ($tipo==6) return "Capa";
	else if ($tipo==7) return "Arma de 1° mão";
	else if ($tipo==8) return "Arma de 2° mão";
	else return "";
}
function getTipoItem($tipo){
	if ($tipo==0)  return "Acessório";
	else if ($tipo==1) return "Comida";
	else if ($tipo==2) return "Remédio";
	else if ($tipo==3) return "Material";
	else if ($tipo==4) return "Consumível";
	else if ($tipo==5) return "Akuma";
	else return "";
}
function getEfeitoItem($item){
	$efeito = "";
	if ($item["tipo"]==0){
		if($item["bonus_atk"]!=0)
			$efeito .= "Ataque +".$item["bonus_atk"]."<br>";
		if($item["bonus_def"]!=0)
			$efeito .= "Defesa +".$item["bonus_def"]."<br>";
		if($item["bonus_agl"]!=0)
			$efeito .= "Agilidade +".$item["bonus_agl"]."<br>";
		if($item["bonus_pre"]!=0)
			$efeito .= "Precisão +".$item["bonus_pre"]."<br>";
		if($item["bonus_res"]!=0)
			$efeito .= "Resistência +".$item["bonus_res"]."<br>";
		if($item["bonus_des"]!=0)
			$efeito .= "Destreza +".$item["bonus_des"]."<br>";
		if($item["bonus_per"]!=0)
			$efeito .= "Percepção +".$item["bonus_per"]."<br>";
		if($item["bonus_vit"]!=0)
			$efeito .= "Vitalidade +".$item["bonus_vit"]."<br>";
	}
	else if ($item["tipo"]==1 || $item["tipo"]==2){
		if($item["hp_recuperado"]!=0)
			$efeito .= "HP Recuperado: ".$item["hp_recuperado"]."<br>";
		if($item["mp_recuperado"]!=0)
			$efeito .= "Energia Recuperada: ".$item["mp_recuperado"]."<br>";
	}
	else if ($item["tipo"]==3){
		$efeito .= "Este material pode ser usado para criação de outros itens.";
	}
	else if ($item["tipo"]==4){
		$efeito .= $item["descricao_efeito"];
	}
	else if ($item["tipo"]==5){
		$efeito .= '<a href="#">Comer</a>';
	}
	
	return $efeito;
}
function getEfeitoEquipamento($item){
	if($item["tipo_efeito"]==0)
		$tipo = "Dano: ";
	else
		$tipo = "Armadura: ";
	
	return $tipo.calculaEfeitoEquipamento($item);
}

function calculaEfeitoEquipamento($item){
	$lvl = (Int)($item["lvl"]) + (Int)($item["evolucao"]);
	$cat = (Int)($item["categoria"]) - 1;
	if ($item["slot"]==7 || $item["slot"]==2){
		$d = 10*$lvl + $cat*$lvl;
	}
	else if($item["slot"] == 8){
		$d = 6*$lvl + ($cat*$lvl)/2;
	}
	else{
		$d = $lvl + ($cat*$lvl/8);
	}
	$d = (int)($d);
	
	return $d;
}
function getTipoCombate($tipo){
	switch ($tipo) {
		case 0: return "Combate";
		case 1: return "Ataque";
		case 2: return "Saque";
		case 3: return "Amigável";
		case 4: return "Batalha no Coliseu";
		case 5: return "Guerra";
		case 6: return "Evento";
		default: return "";
	}
}
