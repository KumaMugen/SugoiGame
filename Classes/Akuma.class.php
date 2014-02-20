<?php
class Akuma{
	public
		$id,
		$img,
		$nome,
		$descricao,
		$tipo,
		$categoria,
		$qntAtaques,
		$qntBuffs,
		$qntPassivas,
		$raridade,
		$efetividade;
	private $bd; //banco de dados
	
	function __construct($id,$comVantagem=TRUE){
		try{
			global $bd;
			$this->bd = &$bd;
			$akuma = $this->bd->fazArray(
				"SELECT * FROM tb_akm_akuma WHERE akuma_id=':0:'",
				array($id),
				array(INT_FORMAT)
			);
			if(sizeof($akuma)==1){
				$this->iniciaParametros($akuma[0],$comVantagem);
			}
		}
		catch(Exception $i){ $this->tException("Tentativa de criar Akuma $id\n".$i->getMessage()."\n".$i->getTraceAsString()); }
	}
	function iniciaParametros($akuma,$comVantagem){
		$this->id = $akuma["akuma_id"];
		$this->img = $akuma["img"];
		$this->nome = $akuma["nome"];
		$this->descricao = $akuma["descricao"];
		$this->tipo = $akuma["tipo"];
		$this->categoria = $akuma["categoria"];
		$this->qntAtaques = $akuma["ataques"];
		$this->qntBuffs = $akuma["buffs"];
		$this->qntPassivas = $akuma["passivas"];
		$this->raridade = $akuma["raridade"];
		$this->efetividade = $akuma["efetividade"];
	}
	function getTipo(){
		switch ($this->tipo) {
			case 1:
				$tipo = "Paramecia";
				break;
			case 2:
				$tipo = "Zoan";
				break;
			case 3:
				$tipo = "Logia";
				break;
			default:
				$tipo = "Erro";
				break;
		}
		return $tipo;
	}
	function getCategoria(){
		switch ($this->categoria) {
			case 0:
				$tipo = "Neutra";
				break;
			case 1:
				$tipo = "Mística";
				break;
			default:
				$tipo = "Erro";
				break;
		}
		return $tipo;
	}
	function getImgLink(){
		return "Imagens/Itens/".$this->img.".png";
	}
	
	function tException($msg){ throw new Exception($msg); }
}
