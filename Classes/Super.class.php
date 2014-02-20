<?php
class Super{
	//funçao para gerar log
	function geraLog($msg,$exception=FALSE){
		global $erro;
		
		$erro->insere($msg);
		
		if($exception){
			$this->tException($msg);
		}
	}
	function tException($msg){ throw new Exception($msg); }
}
