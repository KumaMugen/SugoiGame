<?php
	$fac=$_GET["f"];
	$cod=$_GET["cod"];
	if($fac==1){
		$adx=8;
		$ady=9;
		$scala=0.2;
	}
	else{
		$adx=15;
		$ady=16;
		$scala=0.16;
	}
	
	$F=substr($cod,0,2);
	$FC=substr($cod,2,2);
	$FX=substr($cod,4,2)*$scala+$adx;
	$FY=substr($cod,6,2)*$scala+$ady;
	$FW=substr($cod,8,2)*$scala;
	$FH=substr($cod,10,2)*$scala;
	
	$C=substr($cod,12,2);
	$CC=substr($cod,14,2);
	$CX=substr($cod,16,2)*$scala+$adx;
	$CY=substr($cod,18,2)*$scala+$ady;
	$CW=substr($cod,20,2)*$scala;
	$CH=substr($cod,22,2)*$scala;
	
	$A=substr($cod,24,2);
	$AC=substr($cod,26,2);
	$AX=substr($cod,28,2)*$scala+$adx;
	$AY=substr($cod,30,2)*$scala+$ady;
	$AW=substr($cod,32,2)*$scala;
	$AH=substr($cod,34,2)*$scala;
	
	
	$fundo=$fac."/F/".$F."/".$FC.".png";
	$meio=$fac."/C/".$C."/".$CC.".png";
	$frente=$fac."/A/".$A."/".$AC.".png";
	
	$fundo = imagecreatefrompng($fundo);
	$fundo_x=imagesx($fundo);
	$fundo_y=imagesy($fundo);
	$meio = imagecreatefrompng($meio);
	$meio_x=imagesx($meio);
	$meio_y=imagesy($meio);
	$frente = imagecreatefrompng($frente);
	$frente_x=imagesx($frente);
	$frente_y=imagesy($frente);
	
	$barco="navio_$fac.png";
	$barco=imagecreatefrompng($barco);
	imageAlphaBlending($barco, true);
	imageSaveAlpha($barco, true);
	
	imagecopyresampled($barco,$fundo,$FX,$FY,0,0,$FW,$FH,$fundo_x,$fundo_y);
	imagecopyresampled($barco,$meio,$CX,$CY,0,0,$CW,$CH,$meio_x,$meio_y);
	imagecopyresampled($barco,$frente,$AX,$AY,0,0,$AW,$AH,$frente_x,$frente_y);
	
	
	
	//imagecopyresampled($barco,$background,11,9,0,0,15,11,0,0);
	
	header('Content-type: image/png');
	imagepng($barco);
	//imagepng($background);
	imagedestroy($barco);
	imagedestroy($fundo);
	imagedestroy($meio);
	imagedestroy($frente);
	imagedestroy($background);
?>