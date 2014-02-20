<?php
class Item extends Super{
	public
		$id,
		$img,
		$tipo,
		$nivel,
		$nome,
		$descricao,
		$categoria,
		$is_consumivel,
		$hp_recuperado,
		$mp_recuperado,
		$bonus = array(
			"atk",
			"def",
			"agl",
			"pre",
			"res",
			"des",
			"per",
			"vit"
		),
		$preco,
		$script,
		$item;
		
	protected $bd;
		
	function __construct($id){
		try{
			global $bd;
			$this->bd = &$bd;
			$trip = controleSessao(
				"item-".$id,
				"SELECT * FROM tb_itn_item".
				"WHERE item_id=':0:'",
				array($id),
				array(INT_FORMAT)
			);
		}
		catch(Exception $i){ $this->tException("Tentativa de criar Item $trip\n".$i->getMessage()."\n".$i->getTraceAsString()); }
		if(sizeof($trip)==1){
			$this->iniciaParametros($trip[0]);
		}
		else{
			throw new NotFoundException("Item nao encontrado");
		}
	}
	
	function iniciaParametros($item){
		$this->id = $item["item_id"];
		$this->img = $item["img"];
		$this->tipo = $item["tipo"];
		$this->nivel = $item["nivel"];
		$this->nome = $item["nome"];
		$this->descricao = $item["descricao"];
		$this->categoria = $item["categoria"];
		$this->is_consumivel = $item["is_consumivel"];
		$this->hp_recuperado = $item["hp_recuperado"];
		$this->mp_recuperado = $item["mp_recuperado"];
		
		$this->bonus["atk"] = $item["bonus_atk"];
		$this->bonus["def"] = $item["bonus_def"];
		$this->bonus["agl"] = $item["bonus_agl"];
		$this->bonus["pre"] = $item["bonus_pre"];
		$this->bonus["res"] = $item["bonus_res"];
		$this->bonus["des"] = $item["bonus_des"];
		$this->bonus["per"] = $item["bonus_per"];
		$this->bonus["vit"] = $item["bonus_vit"];
		
		$this->preco = $item["preco"];
		$this->script = $item["script"];
		
		$this->item = $item;
	}
	
	function getInfoFormatada(){
		
	}
	
	function getNomeTipo(){
		switch ($this->tipo) {
			case 0: return "Acessório";
			case 1: return "Comida";
			case 2: return "Remédio";
			case 3: return "Material";
			case 4: return "Consumível";
			case 5: return "Akuma";
			default: return "";
		}
	}
}