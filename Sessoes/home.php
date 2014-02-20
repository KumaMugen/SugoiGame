<?php
	$title = "Principal";
	$conteudoCorpo = array();
	
	//se estiver deslogado cria o formulario de login
	if(!Usuario::$logado){
		$conteudoCorpo["facebook"] = e("DIV", "id=cadastro-facebook", "class=input-div", array(
			"A" => e( "A", "class=link_popup","t=Facebook","d=toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=650,height=380",
			"href=".$facebook->getLoginUrl(array("display"=>"popup","scope"=>"email,publish_stream","redirect_uri"=>"http://localhost/SugoiGame3/redirectFB.php")), array(
				"IMG" => e( "IMG", "src=Imagens/loginFace.jpg" )
			))
		));
		$conteudoCorpo["cabecalho"] = cabecalho("Login");
		$conteudoCorpo["home-login"] = e( "FORM", "id=cadastro", "action=runRedir.php?script=geralLogar", "method=post", array(
			"email" => e( "DIV", "class=input-div", array( 
				"texto-div" => e( "DIV", "class=input-sub-div", array(
					"texto" => texto( "Email:" )
				)),
				"input" => e( "INPUT", "id=cadastro-email", "name=login", "maxlength=200" )
			)),
			"senha" => e( "DIV", "class=input-div", array(
				"texto-div" => e( "DIV", "class=input-sub-div", array(
					"texto" => texto( "Senha:" )
				)),
				"input" => e( "INPUT type=\"password\"", "id=cadastro-senha", "name=senha", "maxlength=200" )
			)),
			"cadastrar" => e( "DIV", "id=div-bt-login", array(
				"botao" => e( "BUTTON type=\"submit\"", "id=bt-login", array(
					texto( "Jogar" )
				))
			))
		));
		$conteudo["evento"] = "formularioLogin();";
	}
	else if(Usuario::$tripAtiva==0){
		$BTnovaTrip = e("BUTTON","class=link_content","href=?ses=novaTripulacao",array(
			texto("Nova tripulação")
		));
		
		$conteudoCorpo["cabecalho"] = cabecalho("Seleção de tripulação");
		$conteudoCorpo["tripulacoes"]=e("DIV", "id=tripulacoes", array(
			"tripulacoes-lista" => e( "DIV", "id=tripulacoes-lista", array())
		));
		try{
			$trips = $bd->fazArray("SELECT tripulacao_id FROM tb_usr_tripulacao WHERE conta_id='".Usuario::$id."'");
			
			for($x=0;$x<6;$x++){
				$conteudoCorpo["tripulacoes"]["c"]["tripulacoes-lista"]["c"][$x]=e("DIV","id=trip-".$x,"class=select-trip",array());
				
				if(isset($trips[$x])){
					$tripulacao = new Tripulacao($trips[$x]["tripulacao_id"],$bd);
					$img = e("IMG","id=".$tripulacao->trip,"class=trip-ativa icon-cursor","src=Imagens/Bandeiras/Bandeiras/".$tripulacao->bandeira.".png",
					"alt=".$tripulacao->nome,"title=".$tripulacao->nome);
					
					$trip["titulo"]=$tripulacao->nome;
					$trip["img"]="Imagens/Bandeiras/Bandeiras/".$tripulacao->bandeira.".png";
					$trip["descricao-array"] = array(
						e("DIV","style=margin-bottom: 10px;",array(
							texto(
								"Capitão: ".$tripulacao->getCapitao()->nome."<br>".
								"Reputação: ".$tripulacao->reputacao
							)
						)),
						e("BUTTON","class=link_send","style=width:150px;","href=usrTripulacaoSelecionar&trip=".$tripulacao->trip,array(
							texto("Jogar")
						))
					);
					$trip["lvl"]=$tripulacao->getMaisForte();
					
					$info = array(
						boxItem($trip)
					);
				}
				else{
					$img = e("IMG","class=trip-inativa icon-cursor","src=Imagens/Bandeiras/1".(($x>2)?"-Vip":"").".png","alt=Espaço vazio","title=Espaço vazio".(($x>2)?" - Apenas para jogadores que já compraram Moedas de Ouro pelo menos 1 vez.":""));
					$info = array( $BTnovaTrip );
				}
				$conteudoCorpo["tripulacoes"]["c"]["tripulacoes-lista"]["c"][$x]["c"]["img"] = $img;
				$conteudoCorpo["tripulacoes"]["c"]["tripulacoes-lista"]["c"][$x]["c"]["box"] = box($info,"300px");
			}
			$conteudoCorpo["tripulacoes"]["c"]["tripulacoes-acoes"]=e("DIV","id=tripulacoes-acoes",array( $BTnovaTrip ));
			$conteudo["evento"] = "toggleSeletorTripulacao();";
		}
		catch(Exception $i){ $erro->insere($i->getMessage()."\n".$i->getTraceAsString()); return; }
	}
