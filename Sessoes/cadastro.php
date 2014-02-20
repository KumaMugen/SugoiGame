<?php
	$title = "Cadastro";
	$conteudoCorpo = array();
	
	$conteudoCorpo["face"] = e("DIV","id=cadastro-facebook","class=input-div",array(
		e("A", "class=link_popup","t=Facebook","d=toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=650,height=380",
		"href=".$facebook->getLoginUrl( array("display"=>"popup","scope"=>"email,publish_stream","redirect_uri"=>"http://localhost/SugoiGame3/redirectFB.php")),array(
			e("IMG","src=Imagens/cadastroFace.jpg")
		))
	));
	$conteudoCorpo["cabecalho"] = cabecalho("Cadastro");
	
	
	function inputCadastro($idDiv, $idInput, $type, $texto,$max){
		$input = e( "DIV", "id=".$idDiv, "class=input-div", array( 
			"texto-div" => e( "DIV", "class=input-sub-div", array(
				"texto" => texto( $texto )
			)),
			"input" => e( "INPUT".$type, "id=".$idInput, "name=".$idInput, "maxlength=".$max ),
			"status" => e( "IMG", "id=status-".$idInput, "src=Imagens/Icones/3.gif" )
		));
		
		return $input;
	}
	
	$conteudoCorpo["form-cadastro"] = e( "DIV", "id=cadastro-form", array(
		"input-nome" => inputCadastro("input-nome","cadastro-nome","","Nome:",100),
		"input-email" => inputCadastro("input-email","cadastro-email","","Email:",200),
		"input-senha" => inputCadastro("input-senha","cadastro-senha"," type=\"password\"","Senha:",100),
		"input-senha2" => inputCadastro("input-senha2","cadastro-senha2"," type=\"password\"","Confirme a Senha:",100),
		"input-contrato" => e( "DIV", "id=input-contrato", "class=input-div", array(
			"input" => e( "INPUT type=\"checkbox\"", "id=cadastro-contrato" ),
			"texto" => e( "DIV", "class=input-sub-div", array(
				"texto" => texto(
					"Eu li e estou de acordo com as "
					."<a href=\"?ses=regras\" target=\"_blank\">Regras de conduta</a> e com a "
					."<a href=\"?ses=politica\" target=\"_blank\">Política de privacidade</a> do site"
				)
			))
		)),
		"cadastrar" => e( "DIV", "id=div-bt-cadastro", array(
			"botao" => e( "BUTTON", "id=bt-cadastro", array(
				texto( "Cadastrar" )
			))
		))
	));
	if(isset($_GET["id"])){
		$conteudoCorpo["form-cadastro"]["c"]["input-padrinho"] = e("INPUT","id=cadastro-padrinho","class=no-display","readonly=true","value=".$_GET["id"]);
	}
	
	$conteudo["evento"] = "cadastro();";
