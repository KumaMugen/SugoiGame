<?php
class NotFoundException extends Exception {
	private $default,
		$msg;
	
	function __construct($msg,$default=NULL){
		parent::__construct($msg);
		$this->default = $default;
	}
	function getDefaultResult(){
		return $this->default;
	}
}