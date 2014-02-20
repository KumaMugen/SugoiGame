<script type="text/javascript">
	//array com Timeouts de contadores de tempo
	var timeOuts = new Array();
	var intervals = new Array();
	
	//formato de strings
	var emailFormat = /^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/;
	var stringFormat = /^[\w]+$/;
	var intFormat = /^[\d]+$/;
	var historySes="";
	var nome_pag_atual="Principal";
	var defaultErro = 'Ocorreu algum erro ao tentar se conectar com o servidor.<br />'+
		'Por favor atualize a página e tente novamente.<br />'+
		'Sugoi Game é um jogo gratuito e sem fins lucrativos, '+
		'por isso precisamos da ajuda dos jogadores para permanecer ativos.<br />'+
		'Se quiser ajudar para que esse erro não volte a acontecer, colabore comprando moedas de ouro!';
	
	//variavel para retornos de sendGets
	var sendGetReturn = null;
	
	//variaveis de controle do questTrack
	var attQuestTrack = true;
	var questTrackInterval;
	
	//variaveis de controle do bau
	var toggleBau = true;
	var toggleItemBau = true;
	var lastItemShow = null;
	
	//constantes de combate
	var tempoTurno = 90;
	var movimentosTurno = 5;
	
	$(function(){
		$(window).on("popstate",function(e){
			state = history.state
			if(state)
				if(state.pagina!=historySes){
					historySes=state.pagina;
					loadPagina(historySes,false);
				}
		})
		
		erro = "";
		if ( $.browser.msie && !getCookie("browserErro")){
			erro += "O Seu navegador atual não suporta todos os recursos disponíveis no Sugoi Game .<br />"+
					"Recomendamos o Google Chrome ou o Mozila Firefox.<br />";
			setCookie("browserErro","erro",8000);
		}
		//exibe os erros capturados pelo objeto erro
		erro +='<?php echo $erro->errosRetornados().$erro->msgsRetornadas(); ?>';
		if(erro.length>0)
			$.prompt(erro,{prefix:'jqismooth'});
		
		//load pagina de sessao ou home page
		<?
		if(isset($_GET["ses"]) && preg_match(STR_FORMAT, $_GET["ses"])) $loadPagina=$_GET["ses"];
		else $loadPagina="home";
		foreach ($_GET as $key => $value) {
			if($key!="ses" && preg_match(STR_FORMAT, $key) && preg_match(STR_FORMAT, $value))
				$loadPagina.="&".$key."=".$value;
		}
		?>
		loadPagina("<? echo $loadPagina; ?>");
		
		//scrol de menu interno
		$(window).scroll(function(){
			topDist = $(document).scrollTop()-250;
			if(topDist<100) topDist=100;
			$("#menu-interno").animate({
				top: topDist+"px"
				},{duration:500,queue:false}
			);
		});
		
		$('.bt-off').live("click",function(e){
			e.preventDefault();
			return false;
		});
		
		//corrige os tipos de links
		$(".link_content:not(.bt-off)").live('click', function(e){
			e.preventDefault();
			var id=$(this).attr("href");
			var locale=id.substr(5,(id.length-5));
			loadPagina(locale);
		});
		$(".link_redirect:not(.bt-off)").live('click', function(e){
			e.preventDefault();
			var locale=this.href;
			clearAllTimeouts();
			location.href=locale;
		});
		$(".link_send:not(.bt-off)").live('click', function(e){
			e.preventDefault();
			var locale=$(this).attr("href");
			clearAllTimeouts();
			sendGet(locale);
		});
		$(".link_send_confirm:not(.bt-off)").live('click', function(e){
			e.preventDefault();
			
			fechaBau();
			
			var question=$(this).attr("question");
			var locale=$(this).attr("href");
			sendConfirm(question,locale);
		});
		$(".link_send_quant:not(.bt-off)").live('click', function(e){
			e.preventDefault();
			
			fechaBau();
			
			var question=$(this).attr("question");
			var locale=$(this).attr("href");
			sendQuant(question,locale);
		});
		$(".link_popup:not(.bt-off)").live('click', function(e){
			e.preventDefault();
			var locale=this.href;
			var t = $(this).attr("t");
			var d = $(this).attr("d");
			clearAllTimeouts();
			wind = window.open(locale,t,d);
		});
		$(".form").live("submit",function(e){
			e.preventDefault();
			
			if(!$(this).attr("id")){
				d = new Date();
				$(this).attr("id", d.getTime() + Math.floor((Math.random()*1000)+1) )
			}
			id = $(this).attr("id");
			
			pagina=$(this).attr("action");
			inputs = $("#"+id+" .form-input");
			obj = {};
			erro = false;
			erroMsg = "";
			
			$.each(inputs, function(key, input){
				if($(input).attr("minlenght")){
					if($(input).attr("value").length < $(input).attr("minlenght")){
						erro = true;
						if($(input).attr("erro"))
							erroMsg += $(input).attr("erro")+'<br>';
						else
							erroMsg += "O campo "+$(input).attr("name")+" precisa de no mínimo "+$(input).attr("minlenght")+" characteres.<br>";
						return;
					}
				}
				if($(input).attr("teste")){
					var teste = $(input).attr("teste");
					teste = new RegExp(teste.substr(1,(teste.length-2)));
					if(!(teste.test($(input).attr("value")))){
						erro = true;
						if($(input).attr("erro"))
							erroMsg += $(input).attr("erro")+'<br>';
						else
							erroMsg += "'"+$(input).attr("value")+"' é uma informação inválida.<br>";
						return;
					}
				}
				obj[input.name] = $(input).attr("value");
			});
			
			fechaCriadorHabilidades();
			fechaBau();
			
			if(erro){
				$.prompt(erroMsg,{prefix:"jqismooth"});
				return false;
			}
			sendForm(pagina,obj);
		});
		
		$(".menu-li").on("mouseenter",function(){
			$("#links-texto-cnt").html($(this).attr("title"));
		}).on("mouseleave",function(){
			$("#links-texto-cnt").html(nome_pag_atual);
		});
		
		$("#alerta-realizacao").on("click",function(){
			$(this).fadeOut(500);
		});
		$("#alerta-informacao").on("click",function(){
			$(this).fadeOut(500);
		});
		
		toggleQuestTrack = true;
		//quest track
		$("#menu-li-questTracker").on("click",function(e){
			e.preventDefault();
			$("#questTracker").toggle(toggleQuestTrack);
			if(toggleQuestTrack && attQuestTrack){
				if(getDisponivel){
					$("#questTracker").html('<img src="Imagens/carregando.gif" />');
					locale = "fastGetMissaoAndamento";
					sendGet(locale,false,elementaQuestTrack);
				}
			}
			toggleQuestTrack = !toggleQuestTrack;
		});
		
		//bau
		$("#menu-li-bau").on("click",function(e){
			e.preventDefault();
			
			$("#bau").toggle(toggleBau);
			
			$("#bau-c-bot").html('<img src="Imagens/carregando.gif" />');
			tipo = $("#bau-select-tipo").attr("value");
			sendGet("bauGetItens&tipo="+tipo,false,getItensBau);
			
			toggleBau = !toggleBau;
		});
		$("#bau-fechar").on("click",function(e){
			e.preventDefault();
			fechaBau();
		});
		$("#bau-select-tipo").on("change",function(){
			$("#bau-c-bot").html('<img src="Imagens/carregando.gif" />');
			
			tipo = $("#bau-select-tipo").attr("value");
			sendGet("bauGetItens&tipo="+tipo,false,getItensBau);
		});
		
		//baus internos
		$(".bau .bau-select-tipo").live("change",function(e){
			e.preventDefault();
			
			$(".bau .bau-itens").css("display","none");
			
			$(".bau .bau-itens.bau-itens-"+$(this).attr("value")).css("display","block");
		});
		
		//criador de habilidade
		$(".link_habilidade").live("click",function(e){
			e.preventDefault();
			
			$("#criador-habilidade-esquerda img").attr("src","Imagens/Personagens/Big/"+$(this).attr("img")+".jpg")
			$("#criador-habilidade-personagem").attr("value",$(this).attr("pers"));
			$("#criador-habilidade-habilidade").attr("value",$(this).attr("habilidade"));
			
			$("#criador-habilidade-imagem img").click();
			
			$("#criador-habilidade").css("display","block");
		});
		$("#criador-habilidade-fechar").live("click",function(e){
			e.preventDefault();
			
			fechaCriadorHabilidades();
		});
		$("#criador-habilidade-imagem img").on("click",function(e){
			e.preventDefault();
			
			seletores = $("<DIV>");
			
			for(x=1;x<=160;x++){
				seletores.append(
					$("<IMG>")
						.addClass("criador-habilidade-seletor-icone")
						.attr("src","Imagens/Skill/"+x+".jpg")
						.attr("icone",x)
				);
			}
			
			$("#criador-habilidade-direita").html("").append(seletores);
		});
		$(".criador-habilidade-seletor-icone").live("click",function(e){
			e.preventDefault();
			$("#criador-habilidade-direita").html("");
			$("#criador-habilidade-img").attr("value",$(this).attr("icone"));
			$("#criador-habilidade-imagem img").attr("src","Imagens/Skill/"+$(this).attr("icone")+".jpg")
		});
	});
	function getItensBau(retorno){
		getDisponivel = true;
		$("#bau-c-bot").html("");
		
		toggleItemBau = true;
		
		$("#bau-capacidade-quantidade").html(retorno.retorno.info);
		$.each(retorno.retorno.itens,function(key,value){
			$("#bau-c-bot")
				.append(
					$("<DIV>")
						.addClass("item-bau")
						.css("background","url(Imagens/Itens/"+value.img+".png)")
						.data("info",value)
				)
		});
		
		$("#bau .item-bau").unbind("click").on("click",function(){
			info = $(this).data("info");
			$("#bau .item-bau").html("").css("opacity",'0.5');
			$(this).css("opacity","1");
			
			itnInfo = formataInfoItem(info);
			
			//coreção do bug logico de ter que clicar 2x pra exibir tela
			if(!toggleItemBau && lastItemShow!=this)
				toggleItemBau = !toggleItemBau;
				
			if(toggleItemBau || lastItemShow!=this){
				$(this).append(geralBox(itnInfo,300,"item-box"));
				lastItemShow=this;
			}
			else{
				$("#bau .item-bau").css("opacity",'1');
			}
			
			toggleItemBau = !toggleItemBau;
			
		});
	}
	
	//funçao que aplica o papel de parede no site
	function setBackground(ilha,cor,horario){
		if(horario>=6 && horario<=18) pasta="dia";
		else pasta="noite";
		
		if(ilha==0)repet="repeat-x";
		else repet="no-repeat";
		
		$("body").css("background","#"+cor+" url(Imagens/"+pasta+"/"+ilha+".jpg) "+repet+" top center fixed");
	}
	function fechaBau(){
		$("#bau").toggle(false);
		toggleBau = true;
	}
	function fechaCriadorHabilidades(){
		$("#criador-habilidade-esquerda img").attr("src","Imagens/Personagens/Big/0000.png")
		$("#criador-habilidade-personagem").attr("value","");
		$("#criador-habilidade-habilidade").attr("value","");
		$("#criador-habilidade-img").attr("value","");
		$("#criador-habilidade-nome").attr("value","");
		$("#criador-habilidade-descricao").attr("value","");
		$("#criador-habilidade-imagem img").attr("src","Imagens/Skill/0.jpg")
		
		$("#criador-habilidade").css("display","none");
	}
	//reseta os contadores
	function clearAllTimeouts(){
		for(key in timeOuts ){  
			clearTimeout(timeOuts[key]);  
		}
		for(key in intervals ){  
			clearInterval(intervals[key]);  
		}
	} 
	
	function formataPaginaTripulantes(pagina){
		txt = $("#tripulantes").html();
		if(txt.length==0)
			pagina+="&tripulantes";
		return pagina;
	}
	//funçao de load de pagina
	var paginas_visualizadas=0;
	var pagina_atual="home";
	function loadPagina(pagina,att){
		pagina = formataPaginaTripulantes(pagina);
		if( typeof att == 'undefined')att=true;
		if(pagina!=pagina_atual || paginas_visualizadas==0){
			$('#icon_carregando').fadeIn();
			pagina_atual=pagina;
			paginas_visualizadas++;
			pagina_ajax=$.ajax({
				url: 'pagina.php',
				dataType: 'json',
				data: 'sessao='+pagina,
				cache: false,
				error: function(){
					$('#icon_carregando').fadeOut();
					$.prompt(defaultErro,{prefix:'jqismooth'});
				},
				success: function(retorno){
					clearAllTimeouts();
					$('#icon_carregando').fadeOut();
					processa(retorno,att);
				}
			});
		}
	}
	
	function sendQuant(question, locale){
		question += '<br><input type="text" id="prompt_quant" name="prompt_quant" value="" >';
		$.prompt(question,{
			prefix: "jqismooth",
			buttons:{Ok:true, Cancelar:false},
			callback: callBack
		});
		function callBack(e,v,m,f){
			if(v && parseInt(f.prompt_quant,10)>0){
				quant=parseInt(f.prompt_quant,10);
				
				sendGet(locale+"&quant="+quant);
			}
		}
	}
	function sendConfirm(question, locale){
		$.prompt(question,{
			prefix: "jqismooth",
			buttons:{Ok:true, Cancelar:false},
			callback: callBack
		});
		function callBack(e,v,m,f){
			if(v){
				sendGet(locale);
			}
		}
	}
	//requisiçoes
	getDisponivel=true;
	function sendGet(locale,showCarregando,funcao,ignoreSendGet){
		locale = formataPaginaTripulantes(locale);
		if(typeof funcao == "undefined")
			funcao = null;
		if(typeof showCarregando == "undefined")
			showCarregando = true;
		if(typeof ignoreSendGet == "undefined")
			ignoreSendGet = false;
		if(getDisponivel || ignoreSendGet){
			if(showCarregando)
				$('#icon_carregando').fadeIn();
			getDisponivel=false;
			$.ajax({
				url: 'run.php',
				dataType: 'json',
				data: 'script='+locale,
				cache: false,
				error: function(){
					getDisponivel=true;
					$('#icon_carregando').fadeOut();
					$.prompt(defaultErro,{prefix:'jqismooth'});
				},
				success: (funcao)?funcao:sendGetRetorno
			});
		}
	}
	function sendGetRetorno(retorno){
		clearAllTimeouts();
		$('#icon_carregando').fadeOut();
		getDisponivel=true;
		processa(retorno);
	}
	function sendForm(pagina,obj){
		pagina = formataPaginaTripulantes(pagina);
		if(getDisponivel){
			$('#icon_carregando').fadeIn();
			getDisponivel=false;
			var data="";
			for (var i in obj){
				data = data+i+"="+obj[i]+'&';
			}
			$.ajax({
				url: 'run.php?script='+pagina,
				dataType: 'json',
				type: 'post',
				data: data,
				cache: false,
				error: function(){
					getDisponivel=true;
					$('#icon_carregando').fadeOut();
					$.prompt(defaultErro,{prefix:'jqismooth'});
				},
				success: function(retorno){
					getDisponivel=true;
					$('#icon_carregando').fadeOut();
					 processa(retorno);
				}
			});
		}
		 //ret;
	}
	function processa(retorno,att){
		fechaBau();
		
		if(retorno.redirect){
			location.href=retorno.redirect;
		}
		if(retorno.erro){
			$.prompt('<img src="Imagens/erro.jpg" /><br /><font style="font-size: 15px;">Bancando o espertinho?</font><br /><br />'+retorno.erro+'<br /><br /><font style="font-size: 10px;">Estamos de olho em você!</font>');
		}
		if(retorno.mensagem){
			$.prompt(retorno.mensagem,{prefix:'jqismooth'});
		}
		if(retorno.pagina){
			elementa(retorno.pagina,att);
		}
		if(retorno.evento){
			eval(retorno.evento);
		}
		if(retorno.realizacao){
			toggleRealizacao(retorno.realizacao);
		}
		if(retorno.informacao){
			toggleInformacao(retorno.informacao);
		}
		if(retorno.combate){
			loadPagina("combate");
		}
		if(retorno.gold){
			$("#gold").css("display","block");
			$("#gold-quant").html(retorno.gold);
		}
		else $("#gold").css("display","none");
		if(retorno.berries){
			$("#berries").css("display","block");
			$("#berries-quant").html(formataBerries(retorno.berries));
		}
		else $("#berries").css("display","none");
		if(retorno.locate){
			$("#locate").css("display","block");
			$("#locate-quant").html(retorno.locate);
		}
		else $("#locate").css("display","none");
		
		if(retorno.retorno){
			sendGetReturn = retorno.retorno;
		}
	}
	
	function elementa(objeto,att){
		pagina_atual=objeto.nome;
		historySes = pagina_atual;
		if(att){
			window.history.pushState({pagina: pagina_atual}, 'One Piece Sugoi Game', '?ses='+pagina_atual );
		}
		nome_pag_atual = objeto.title;
		$("title").html("One Piece Sugoi Game - "+objeto.title);
		
		$("#links-texto-cnt").html(nome_pag_atual);
		
		elementaMenu(objeto.menu);
		
		if(objeto.tripulantes)
			elementaTripulantes(objeto.tripulantes);
		
		conteudo = $("#conteudo");
		conteudo.html("");
		elementos(conteudo,objeto.corpo);
		
		$("#news-content-text").fadeOut(0).html(objeto.news).fadeIn(500);
		
		$("#bandeira img").attr("src",objeto.bandeira)
		
		setBackground(objeto.background.img,objeto.background.cor,objeto.background.horario);
	}
	
	function toggleRealizacao(texto){
		$("#alerta-realizacao-texto").html(texto);
		$("#alerta-realizacao").fadeIn(500);
		timeOuts["realizacao"]=setTimeout(function(){ $("#alerta-realizacao").fadeOut(500); },5000);
	}
	
	function toggleInformacao(texto){
		$("#alerta-informacao-texto").html(texto);
		$("#alerta-informacao").fadeIn(500);
	}
	
	function elementaTripulantes(tripulantes){
		$("#tripulantes")
			.css("display","block")
			.html("");
		trip = $("#tripulantes");
		$.each(tripulantes, function(key, value){
			div=$("<DIV>").css("display","inline-block").addClass("tripulante-container");
			trip.append(div);
			
			if(value.status==0){
				cor = parseInt((249.9-(250*value.razao)),10);
				img = $("<IMG>")
					.attr("src","Imagens/Personagens/Icons/"+value.img+".jpg")
					.addClass("tripulante")
					.css("border","1px solid rgb("+cor+",0,0)");
				
				if(value.razao==0)img.css("opacity","0.2");
			}
			else if(value.status==1)
				img = $("<DIV>")
					.addClass("tripulante")
					.css("border","1px solid transparent");
			else
				img = $("<IMG>")
					.attr("src","Imagens/Personagens/personagem-bloqueado.png")
					.addClass("tripulante")
					.css("border","1px solid transparent");
			
			div.append(img);
			if(value.status==0){
				var teste;
				locate = (value.procurado)?"Imagens/Personagens/Cartazes/"+value.cartaz+".jpg":"Imagens/Personagens/desconhecido.png";
				
				teste = barra(90, "gray", value.razao, "green", "HP: "+value.hp+" / "+value.hpM, 2 );
				rMp=value.mp/value.mpM;
				rXp=value.xp/value.xpM;
				lUp = (rXp>=1)?true:false;
				rMan = value.mantra/25;
				rArm = value.armamento/25;
				
				if(lUp)
					div.append('<img src="Imagens/NPC/missao-0.png" class="img-lUp-true">');
				
				teste = $("<DIV>")
							.append($("<DIV>").append($("<IMG>").attr("src",locate)).css("float","left"))
							.append(
								$("<DIV>")
									.append($("<DIV>").html(value.nome)
									.append($("<DIV>").css("font-size","9px")
										.html(
											((lUp)?'<span class="trip-lUp-true" title="Este personagem já pode evoluir.">':"")+
												"Nível "+value.lvl+
											((lUp)?'</span>':""))
										))
									.append($("<DIV>").css("font-size","9px").html(value.fa))
									.append($("<DIV>").css("font-size","9px").html("Classe: "+value.classe))
									.append($("<DIV>").css("font-size","9px").html("Score: "+value.score))
									.append($("<BR>"))
									.append(barra(90, "black", value.razao, "green", "HP: "+value.hp+" / "+value.hpM, 2 ))
									.append(barra(90, "black", rMp, "yellow", "En: "+value.mp+" / "+value.mpM, 2 ))
									.append(barra(90, "black", rXp, "white", "XP: "+value.xp+" / "+value.xpM, 2 ))
									.append($("<BR>"))
									.append(barra(90, "black", rMan, "green", "Mantra: "+value.mantra, 2 ))
									.append(barra(90, "black", rArm, "red", "Armamento: "+value.armamento, 2 ))
									.css("float","right")
							)
							.append($("<DIV>").addClass("clear"));
				div.append(geralBox(teste,250,"tripulante-info"));
				
				//div.append();
			}
			else if(value.status==2){
				teste=$("<DIV>").html("Aumente o convés do seu navio e libere espaço para mais tripulantes");
				div.append(geralBox(teste,250,"tripulante-info"));
			}
		});
	}
	
	function elementaMenu(menu){
		$.each(menu, function(key, value){
			if(value){
				$("#menu-li-"+key).css("display","inline-block");
			}
			else{
				$("#menu-li-"+key).css("display","none");
			}
		});
	}
	
	//funcao do questTrack
	function elementaQuestTrack(retorno){
		getDisponivel=true;
		
		clearInterval(questTrackInterval);
		
		missao = retorno.retorno;
		$("#questTracker").html("");
		$("#questTracker")
			.append(
				$("<DIV>")
					.addClass("titulo-missao")
					.html(missao.nome)
			)
			.append(
				$("<DIV>")
					.addClass("progresso-missao")
					.html(
						(missao.tipo==0)
							?(missao.esperar<0)
								?("Missão Concluída!")
								:('<span id="tempo-missao"></span>')
							:(missao.progresso>=missao.objetivo_quant)
								?("Missão Concluída!")
								:(missao.objetivo_descricao+": "+missao.progresso+" / "+missao.objetivo_quant)
					)
			);
		if(missao.tipo==0 && missao.esperar>=0){
			$("#questTrackBuffer").attr("value",missao.esperar);
			questTrackInterval = setInterval(atualizaTempoQuestTrack,1000)
		}
		attQuestTrack = false;
		setTimeout(function(){attQuestTrack = true;},15000);
	}
	function atualizaTempoQuestTrack(){
		tempo = $("#questTrackBuffer").attr("value");
		$("#tempo-missao").html(transforma_tempo(tempo))
		tempo -= 1;
		$("#questTrackBuffer").attr("value",tempo);
		
		if(tempo<0){
			attQuestTrack = true;
			clearInterval(questTrackInterval);
			$("#tempo-missao").html("Missão Concluída!");
		}
	}
</script>