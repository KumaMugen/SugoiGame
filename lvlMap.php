<?php
function xp($x){
	return (1000+$x*1000)*$x/2;
}
$y=0;
for($x=1;$x<50;$x++){
	echo "lvl $x: ".xp($x)." : ".xp($x)/7 ." de xp pra 7 missoes<br>";
	$y += xp($x);
}
echo $y;
?>