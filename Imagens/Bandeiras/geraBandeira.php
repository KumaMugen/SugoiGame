<?php
function HexParaRGB($hex) {
	$cor = array("r"=>"","g"=>"","b"=>"");
	
	$cor['r'] = hexdec(substr($hex, 0, 2));
	$cor['g'] = hexdec(substr($hex, 2, 2));
	$cor['b'] = hexdec(substr($hex, 4, 2));
	
	return $cor;
}

function colore($img, $cor11, $cor12, $cor13){
	$img_x=imagesx($img);
	$img_y=imagesy($img);
	
	for ($x=0;$x<$img_x;$x++){
		for ($y=0;$y<$img_y;$y++){
			$rgb = imagecolorat($img, $x, $y);
			$t = ($rgb >> 24) & 0x7F;
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			
			if($r>100 && $g>100 && $b>100 && $t<100){ 
				$color = imagecolorallocate($img, $cor11['r'], $cor11['g'], $cor11['b']); 
				imagesetpixel($img, $x, $y, $color);
			}
			if($r>100 && $g<100 && $b<100 && $t<100){ 
				$color = imagecolorallocate($img, $cor12['r'], $cor12['g'], $cor12['b']); 
				imagesetpixel($img, $x, $y, $color);
			}
			if($r<100 && $g>100 && $b<100 && $t<100){ 
				$color = imagecolorallocate($img, $cor13['r'], $cor13['g'], $cor13['b']); 
				imagesetpixel($img, $x, $y, $color);
			}
		}
	}
	
	return $img;
}

function geraBandeira($get,$larguraNova,$alturaNova){
	$cod=$get["cod"];
	
	$C1=substr($cod,0,2);
	$C1X=substr($cod,2,4);
	$C1Y=substr($cod,6,4);
	$C1W=substr($cod,10,3);
	$C1H=substr($cod,13,3);
	
	$C2=substr($cod,16,2);
	$C2X=substr($cod,18,4);
	$C2Y=substr($cod,22,4);
	$C2W=substr($cod,26,3);
	$C2H=substr($cod,29,3);
	
	$C3=substr($cod,32,2);
	$C3X=substr($cod,34,4);
	$C3Y=substr($cod,38,4);
	$C3W=substr($cod,42,3);
	$C3H=substr($cod,45,3);
	
	$fac=$get["f"];
	
	$cor11 = HexParaRGB($get['cor11']);
	$cor12 = HexParaRGB($get['cor12']);
	$cor13 = HexParaRGB($get['cor13']);
	
	$cor21 = HexParaRGB($get['cor21']);
	$cor22 = HexParaRGB($get['cor22']);
	$cor23 = HexParaRGB($get['cor23']);
	
	$cor31 = HexParaRGB($get['cor31']);
	$cor32 = HexParaRGB($get['cor32']);
	$cor33 = HexParaRGB($get['cor33']);
	
	$background=$fac.".png";
	$background=imagecreatefrompng($background);
	
	$C1=$fac."/".$C1.".png";
	$C2=$fac."/".$C2.".png";
	$C3=$fac."/".$C3.".png";
	
	$C1 = imagecreatefrompng($C1);
	$C1_x=imagesx($C1);
	$C1_y=imagesy($C1);
	$C2 = imagecreatefrompng($C2);
	$C2_x=imagesx($C2);
	$C2_y=imagesy($C2);
	$C3 = imagecreatefrompng($C3);
	$C3_x=imagesx($C3);
	$C3_y=imagesy($C3);
	
	$C1 = colore($C1,$cor11,$cor12,$cor13);
	$C2 = colore($C2,$cor21,$cor22,$cor23);
	$C3 = colore($C3,$cor31,$cor32,$cor33);
	
	imagecopyresampled($background,$C1,$C1X,$C1Y,0,0,$C1W,$C1H,$C1_x,$C1_y);
	imagecopyresampled($background,$C2,$C2X,$C2Y,0,0,$C2W,$C2H,$C2_x,$C2_y);
	imagecopyresampled($background,$C3,$C3X,$C3Y,0,0,$C3W,$C3H,$C3_x,$C3_y);
	
	$nova = ImageCreateTrueColor($larguraNova,$alturaNova);
	imagecopyresampled($nova, $background, 0, 0, 0, 0, $larguraNova, $alturaNova, imagesx($background),  imagesy($background));
	
	imagedestroy($C1);
	imagedestroy($C2);
	imagedestroy($C3);
	imagedestroy($background);
	return $nova;
}