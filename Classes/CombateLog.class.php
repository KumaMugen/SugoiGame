<?php
class CombateLog{
	private $arquivoNome,$arquivo;
	
	//construtor carrega arquivo e povoa os arrays de mensagens para tela
	function __construct($arquivo,$tipo){
		$this->arquivoNome = $arquivo;
		$this->arquivo = fopen("Logs/Combates/".$tipo."/".$this->arquivoNome.".log", "a");
	}
	function __destruct(){
		fclose($this->arquivo);
	}
	//insere msg de erro no arquivo
	function insere($acao){
		$escreve = fwrite($this->arquivo, $acao."\n");
	}
	
	function formataAtacante($pers,$hab){
		$str = '<div class="log-linha-sup">';
			$str .= '<div class="atacante" perid="'.$pers["id"].'" quadro="'.$pers["quadro"].'">';
				$str .= '<img class="atacante-img" src="Imagens/Personagens/Icons/'.$pers["SkinR"].'.jpg">';
				$str .= '<span>'.$pers["nome"].'</span>';
			$str .= '</div>';
			$str .= '<div class="habilidade">';
				$str .= '<span class="habilidade-usou">Usou</span>';
				$str .= '<img class="habilidade-img" src="Imagens/Skill/'.$hab["img"].'.jpg">';
				$str .= '<span class="habilidade-nome">'.$hab["nome"].':</span>';
				$str .= '<span class="habilidade-descricao">'.$hab["descricao"].'</span>';
			$str .= '</div>';
		$str .= '</div>';
		
		return $str;
	}
	function formataAlvo($pers,$desc){
		$str = '<div class="log-linha-inf">';
			$str .= '<div class="alvo" perid="'.$pers["id"].'" quadro="'.$pers["quadro"].'">';
				if(!$pers["vazio"])
					$str .= '<img class="alvo-img" src="Imagens/Personagens/Icons/'.$pers["SkinR"].'.jpg">';
				$str .= '<span>'.(($pers["vazio"])?"Acertou um quadro vazio":$pers["nome"]).'</span>';
				$str .= '<span class="efeito">'.$desc.'</span>';
			$str .= '</div>';
		$str .= '</div>';
		
		return $str;
	}
	
	function formataRegistro($atacante,$alvo,$hab,$desc,$equipe){
		$data = date("H:i:s d-m-Y",time());
		$str = '<div class="log-linha equipe-'.$equipe.'" data="'.$data.'">';
			$str .= $this->formataAtacante($atacante,$hab);
		foreach ($alvo as $key => $value) {
			$str .= $this->formataAlvo($value,$desc[$key]);
		}
		$str .= '</div>';
		
		return $str;
	}
}
