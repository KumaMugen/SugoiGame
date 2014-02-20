<?php
Class MobCombate extends PersonagemCombate{
	function __construct($mob,$mobInfo){
		$this->iniciaParametros($mob,$mobInfo);
	}
	
	private function iniciaParametros($mob,$mobInfo){
		$this->codTrip = 0;
		$this->id = "npc";
		$this->nome = $mob["nome"];
		
		$this->img = 0;
		$this->imgR = 0;
		$this->imgC = 0;
		
		$this->xp = 0;
		$this->lvl = 0;
		$this->hp = $mobInfo["hp"];
		$this->mp = 0;
		
		$this->FA = 0;
		$this->procurado = FALSE;
		
		$this->attr["atk"] = $mob["atk"];
		$this->attr["def"] = $mob["def"];
		$this->attr["agl"] = $mob["agl"];
		$this->attr["res"] = $mob["res"];
		$this->attr["pre"] = $mob["pre"];
		$this->attr["des"] = $mob["des"];
		$this->attr["per"] = $mob["per"];
		$this->attr["vit"] = 0;
		$this->pts = 0;
		
		$this->hakiLvl = 0;
		$this->hakiXp = 0;
		$this->hakiPts = 0;
		$this->hakiMan = 0;
		$this->hakiArm = 0;
		$this->pontosHabilidade = 0;
		
		$this->dano = $mob["dano"];
		$this->armadura = $mob["armadura"];
		
		$this->equipe = 1;
		
		$this->quadro = "npc";
	}
}
