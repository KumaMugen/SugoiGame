<?php
	require( "geraBandeira.php");
	
	$width=150;
	$height=103;
	
	$bandeira = geraBandeira($_GET,$width,$height);
	
	header('Content-type: image/png');
	imagepng($bandeira);
	imagedestroy($bandeira);
?>