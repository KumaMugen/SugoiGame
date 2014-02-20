<?php
class Vetor{
	public
		$x,
		$y;
		
	function __construct($x,$y){
		$this->x = $x;
		$this->y = $y;
	}
	
	function somarVetor($vetor){
		$this->x += $vetor->x;
		$this->y += $vetor->y;
	}
	
	function subtrairVetor($vetor){
		$this->x -= $vetor->x;
		$this->y -= $vetor->y;
	}
	
	function getDistancia($vetor){
		$distancia = pow((pow(($this->x - $vetor->x),2)+(pow(($this->y - $vetor->y),2))),(1/2));
		return $distancia;
	}
	
	function toString(){
		return $this->x."_".$this->y;
	}
	
	function multiplicarVetor($vetor){
		$this->x *= $vetor->x;
		$this->y *= $vetor->y;
	}
	
	function multiplicarEscalar($escalar){
		$this->x *= $escalar;
		$this->y *= $escalar;
		
		return $this->x + $this->y;
	}
	
	function dividirVetor($vetor){
		$this->x /= $vetor->x;
		$this->y /= $vetor->y;
	}
	
	function dividirEscalar($escalar){
		$this->x /= $escalar;
		$this->y /= $escalar;
		
		return $this->x + $this->y;
	}
	
	function getModulo(){
		return pow((pow($this->x,2)+(pow($this->y,2))),(1/2));
	}
	
	function getVersor(){
		$versor = new Vetor($this->x,$this->y);
		
		$versor->dividirEscalar($this->getModulo());
		
		return $versor;
	}
}
