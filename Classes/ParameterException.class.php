<?php
class ParameterException extends Exception {
	function __construct(){
		parent::__construct("Algum dado incorreto foi informado.");
	}
}