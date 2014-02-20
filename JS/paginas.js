function getProfissao($int){
	$int = parseInt($int,10);
	switch ($int) {
		case 1: return "Cartógrafo"; break;
		case 2: return "Navegador"; break;
		case 3: return "Médico"; break;
		case 4: return "Carpinteiro"; break;
		case 5: return "Arqueólogo"; break;
		case 6: return "Mergulhador"; break;
		case 7: return "Cozinheiro"; break;
		case 8: return "Músico"; break;
		case 9: return "Combatente"; break;
		case 10: return "Engenheiro"; break;
		case 11: return "Ferreiro"; break;
		case 12: return "Artesão"; break;
		default: return ""; break;
	}
}
/* validador de formulario */
function Validador(){
	this.confereNome = function(div, max){
		if($("#"+div).attr("value").length < 4){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","O nome precisa de pelo menos 4 characteres");
			return false;
		}
		else if($("#"+div).attr("value").length > max){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","O nome não pode ter mais de "+max+" characteres");
			return false;
		}
		else{
			$("#status-"+div).attr("src","Imagens/Icones/1.gif").attr("title","Ok");
			return true;
		}
	}
	this.confereLogin = function(div, max){
		if($("#"+div).attr("value").length < 4){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","O nome precisa de pelo menos 4 characteres");
			return false;
		}
		else if($("#"+div).attr("value").length > max){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","O nome não pode ter mais de "+max+" characteres");
			return false;
		}
		else if(!(stringFormat.test($("#"+div).attr("value")))){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","O nome não pode conter characteres especiais.");
			return false;
		}
		else{
			$("#status-"+div).attr("src","Imagens/Icones/1.gif").attr("title","Ok");
			return true;
		}
	}
	this.confereEmail = function(div){
		if(!(emailFormat.test($("#"+div).attr("value"))) || $("#"+div).attr("value").length==0){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","Email InvÃ¡lido");
			return false;
		}
		else{
			$("#status-"+div).attr("src","Imagens/Icones/1.gif").attr("title","Ok");
			return true;
		}
	}
	this.emailCadastrado = function(){
		$("#status-cadastro-email").attr("src","Imagens/Icones/0.gif").attr("title","Email InvÃ¡lido");
	}
	this.confereSenha = function(div){
		if($("#"+div).attr("value").length < 6){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","A senha precisa de pelo menos 6 characteres");
			return false;
		}
		else{
			$("#status-"+div).attr("src","Imagens/Icones/1.gif").attr("title","Ok");
			return true;
		}
	}
	this.confereSenha2 = function(div){
		if($("#"+div).attr("value") != $("#cadastro-senha").attr("value") || $("#cadastro-senha2").attr("value").length<6){
			$("#status-"+div).attr("src","Imagens/Icones/0.gif").attr("title","As senhas nÃ£o conferem");
			return false;
		}
		else{
			$("#status-"+div).attr("src","Imagens/Icones/1.gif").attr("title","Ok");
			return true;
		}
	}
	this.confereContrato = function(div){
		if($("#"+div).attr("checked") != "checked"){
			return false;
		}
		return true;
	}
}
function Steps(max){
	this.step=1;
	this.stepMax=max;
	this.steps = function(){
		$(".step").fadeOut();
		$(".step[o='"+this.step+"']").fadeIn();
		
		if(this.step == this.stepMax) $(".stepMais").fadeOut();
		else $(".stepMais").fadeIn();
		if(this.step == 1) $(".stepMenos").fadeOut();
		else $(".stepMenos").fadeIn();
		
	}
	this.stepMais = function(){
		this.step++;
		if(this.step > this.stepMax) this.step = this.stepMax;
		
		this.steps();
	}
	this.stepMenos = function(){
		this.step--;
		if(this.step < 1) this.step = 1;
		
		this.steps();
	}
}

/* cadastro */
function cadastro(){
	validador = new Validador;
	$("#bt-cadastro").on("click",function(){
		erro = true;
		erro = validador.confereNome("cadastro-nome",100);
		erro = validador.confereEmail("cadastro-email");
		erro = validador.confereSenha("cadastro-senha");
		erro = validador.confereSenha2("cadastro-senha2");
		erro = validador.confereContrato("cadastro-contrato");
		
		if(!erro){
			$.prompt("Formulário incompleto",{prefix:'jqismooth'})
			return;
		}
		
		obj = {
			"nome" : $("#cadastro-nome").attr("value"),
			"email" : $("#cadastro-email").attr("value"),
			"senha" : $("#cadastro-senha2").attr("value")
		}
		if(document.getElementById("cadastro-padrinho")!=null){
			obj["padrinho"] = $("#cadastro-padrinho").attr("value");
		}
		
		sendForm("geralCadastrar",obj);
	});
	$("#cadastro-nome").on("blur",function(){
		validador.confereNome("cadastro-nome");
	});
	$("#cadastro-email").on("blur",function(){
		validador.confereEmail("cadastro-email");
	});
	$("#cadastro-senha").on("blur",function(){
		validador.confereSenha("cadastro-senha");
	});
	$("#cadastro-senha2").on("blur",function(){
		validador.confereSenha2("cadastro-senha2");
	});
}
function formularioLogin(){
	validador = new Validador;
	$("#cadastro").submit(function(){
		erro = true;
		erro = validador.confereEmail("cadastro-email");
		erro = validador.confereSenha("cadastro-senha");
		
		if(!erro){ $.prompt("FormulÃ¡rio incompleto",{prefix:'jqismooth'}) }
		return erro;
	});
	
	$("#cadastro-email").on("blur",function(){
		validador.confereEmail("cadastro-email");
	});
	$("#cadastro-senha").on("blur",function(){
		validador.confereSenha("cadastro-senha");
	});
}
/* steps */
function seletorCapitao(imagens){
	this.qnt = imagens;
	this.pI = 1;
	this.start = function(){
		n = this.pI;
		for(x=0;x<10;x++){
			for(y=0;y<10;y++){
				img=$("<IMG>");
				$("#seletor-cap-"+x+"-"+y).html("").append(img);
				
				img
					.attr("src",this.getImg(n,"Icons","(0).jpg"))
					.data("cod",n)
					.addClass("icon-cursor");
				if( n < this.qnt ) n++;
			}
		}
		
		$(".seletor-cap img")
			.unbind("click")
			.on("click",function(){
				sel = new seletorCapitao(0);
				$(".seletor-cap img").css("border","1px solid transparent");
				$(this).css("border","1px solid #440000");
				$("#n-trip-capitao-img").attr("value",$(this).data("cod"));
				$("#seletor-capitao-img").attr("src",sel.getImg($(this).data("cod"),"Big","(0).jpg"))
			});
	}
	this.getImg = function(num,tam,ext){
		locate = "Imagens/Personagens/"+tam+"/";
		if(num<10)
			return locate+"000"+num+ext;
		else if(num<100)
			return locate+"00"+num+ext;
		else if(num<1000)
			return locate+"0"+num+ext;
		else
			return locate+num+ext;
	}
	this.pageMais = function(){
		this.pI += 100;
		if(this.pI>301)this.pI=301;
		this.start();
	}
	this.pageMenos = function(){
		this.pI -= 100;
		if(this.pI<1)this.pI=1;
		this.start();
	}
}

/* cadastro de tripulaÃ§ao */
function stepsNovaTrip(max,personagens){
	step = new Steps(max);
	step.steps();
	seletor = new seletorCapitao(personagens);
	$(".tripulacao-select")
		.unbind("click")
		.on("click",function(){
			$(".tripulacao-select").css("opacity","0.1").css("border","none");
			$(this).css("opacity","1").css("border","3px solid #ff0000");;
			$("#n-trip-faccao").attr("value",$(this).attr("f"));
			
			step.step = 2;
			step.steps();
			
			t = $("<TABLE>");
			$("#seletor-capitao").append(t);
			
			for(x=0;x<10;x++){
				tr = $("<TR>");
				t.append(tr);
				for(y=0;y<10;y++){
					td = $("<TD>");
					tr.append(td);
					
					td.attr("id","seletor-cap-"+x+"-"+y).addClass("seletor-cap");
				}
			}
			i = $("<IMG>")
				.attr("src","Imagens/Personagens/Big/0000.png")
				.attr("id","seletor-capitao-img");
			$("#seletor-capitao").append(i);
			seletor.start();
		});
	$("#n-trip-bt-confirmar")
		.unbind("click")
		.on("click", function(){
			val = new Validador();
			if(!val.confereLogin("n-trip-capitao",15)){
				$.prompt("Formulário incompleto.",{prefix:'jqismooth'});
				return;
			}
			capitao = $("#n-trip-capitao").attr("value");
			capitaoImg = $("#n-trip-capitao-img").attr("value");
			faccao = $("#n-trip-faccao").attr("value");
			mar = $("#n-trip-mar").attr("value");
			
			obj = {
				capitao: capitao,
				img: capitaoImg,
				faccao: faccao,
				mar: mar
			}
			
			sendForm("usrTripulacaoCadastrar",obj);
		});
	$(".stepMenos")
		.unbind("click")
		.on("click",function(){step.stepMenos();});
	
	$(".stepMais")
		.unbind("click")
		.on("click",function(){step.stepMais();});
	
	$("#seletor-capitao .pageMais")
		.unbind("click")
		.on("click",function(){seletor.pageMais();});
	
	$("#seletor-capitao .pageMenos")
		.unbind("click")
		.on("click",function(){seletor.pageMenos();});
}

/* home sem trip selecionada */
function toggleSeletorTripulacao(){
	addToggleClick(".select-trip", ".geral-box","img","trip-clicada");
}
function addSeletorPersonagem(){
	$(".personagem-seletor").unbind("click").on("click",addFuncaoSeletorPersonagem);
	$(".seletor-selecionado").click();
}
//seletor de personagens
function addFuncaoSeletorPersonagem(){
	if(getDisponivel){
		var id = $(this).attr("id");
		
		$(".personagem-seletor").removeClass("seletor-selecionado");
		$(this).addClass("seletor-selecionado");
		
		$(".personagem").removeClass("personagem-selecionado");
		$("#layer-"+id).addClass("personagem-selecionado");
		
		if($("#layer-"+id).html().length == 0){
			$("#layer-"+id).html('<img src="Imagens/carregando.gif" />');
			
			sendGet("iper&per="+($(this).attr("per"))+"&pag="+($(this).attr("pag")),false,function(r){
				getDisponivel = true;
				$("#layer-"+id).html("");
				
				elementos($("#layer-"+id),r.retorno);
				
				if(r.evento)
					eval(r.evento);
			});
		}
	}
}

/* tripulacaoStatus */
function tripulacaoStatus(){
	addSeletorPersonagem();
	
	$("#tripulacaoStatus .bt-add-atributo")
		.die("click")
		.live("click",function(){
			attr = $(this).attr("attr");
			pers = $(this).attr("pers");
			
			quant = $('#'+pers+'a'+attr+'').attr("value");
			
			sendGet("perAddAtributo&attr="+attr+"&pers="+pers+"&quant="+quant);
		});
}

/*sistema Mundi*/
function sistemaMundi(){
	function getSistemaMundi(tipo,x,y){
		if(getDisponivel){
			$.ajax({
				url: 'run.php',
				dataType: 'json',
				data: 'script=sisMapa&x='+x+'&y='+y+'&tipo='+tipo,
				cache: false,
				error: function(){
					getDisponivel=true;
					$.prompt(defaultErro,{prefix:'jqismooth'});
				},
				success: function(r){
					getDisponivel=true;
					$("#mapa").html("");
					for(j = 0 ; j <= 10 ; j++){
						for(k = 0 ; k <= 10 ; k++){
							u = x-5+k;
							if(u<0) u=301+u;
							if(u>300)u-=301;
							v = y-5+j;
							$("#mapa").append(
								$("<DIV>")
									.addClass("quadro")
									.addClass("icon-cursor")
									.css("top",(j*50)+"px")
									.css("left",(k*50)+"px")
									.html(u+"_"+v)
									.attr("id",k+"_"+j)
							);
						}
					}
					$.each(r.retorno.coords,function(key,value){
						$("#"+key).addClass("n-navegavel");
					});
				}
			});
		}
	}
	//frames
	function frameBG(x,y,px,py){
		this.img = new Array();
		this.pos = new Array()
		this.img["X"]=x;
		this.img["Y"]=y;
		this.pos["X"]=px;
		this.pos["Y"]=py;
	}
	function visaoBg(){
		this.frame = new Array();
		this.frame["E"] = new frameBG(0,0,0,0);
		this.frame["D"] = new frameBG(0,0,0,0);
		this.frame["DE"] = new frameBG(0,0,0,0);
		this.frame["DD"] = new frameBG(0,0,0,0);
		
		this.frame["E"].ativo = true;
		this.setBG = function(){
			bg = "background: ";
			
			bg+="url(Imagens/Mapa/"+this.frame["E"].img["Y"]+"_"+this.frame["E"].img["X"]+".jpg) no-repeat "+
				this.frame["E"].pos["X"]+"px "+this.frame["E"].pos["Y"]+"px , ";
			
			bg+="url(Imagens/Mapa/"+this.frame["D"].img["Y"]+"_"+this.frame["D"].img["X"]+".jpg) no-repeat "+
			this.frame["D"].pos["X"]+"px "+this.frame["D"].pos["Y"]+"px , ";
			
			bg+="url(Imagens/Mapa/"+this.frame["DE"].img["Y"]+"_"+this.frame["DE"].img["X"]+".jpg) no-repeat "+
			this.frame["DE"].pos["X"]+"px "+this.frame["DE"].pos["Y"]+"px , ";
			
			bg+="url(Imagens/Mapa/"+this.frame["DD"].img["Y"]+"_"+this.frame["DD"].img["X"]+".jpg) no-repeat "+
			this.frame["DD"].pos["X"]+"px "+this.frame["DD"].pos["Y"]+"px";
			
			$("#mapa").attr("style",bg);
		}
		this.moveFrame = function(direcao,quant){
			this.frame["E"].pos[direcao]+=quant;
			this.frame["D"].pos[direcao]+=quant;
			this.frame["DE"].pos[direcao]+=quant;
			this.frame["DD"].pos[direcao]+=quant;
		}
		this.moveHorizontal = function(){
			if((this.frame["E"].pos["X"]+625)<0){
				nimg = this.frame["D"].img["X"]+1;
				if(nimg>23) nimg = 0;
				
				this.frame["E"] = this.frame["D"];
				this.frame["D"] = new frameBG(nimg,this.frame["E"].img["Y"],this.frame["E"].pos["X"]+625,this.frame["E"].pos["Y"]);
				
				this.frame["DE"] = this.frame["DD"];
				this.frame["DD"] = new frameBG(nimg,this.frame["DE"].img["Y"],this.frame["DE"].pos["X"]+625,this.frame["DE"].pos["Y"]);
			}
			else if((this.frame["E"].pos["X"]+75)<0){
				nimg = this.frame["E"].img["X"]+1;
				if(nimg>23) nimg = 0;
				
				this.frame["D"].img["X"] = nimg;
				this.frame["D"].pos["X"] = this.frame["E"].pos["X"]+625;
				
				this.frame["DD"].img["X"] = nimg;
				this.frame["DD"].pos["X"] = this.frame["E"].pos["X"]+625; 
			}
			if((this.frame["E"].pos["X"])>0){
				nimg = this.frame["E"].img["X"]-1;
				if(nimg<0) nimg = 23;
				
				this.frame["D"] = this.frame["E"];
				this.frame["E"] = new frameBG(nimg,this.frame["E"].img["Y"],this.frame["E"].pos["X"]-625,this.frame["E"].pos["Y"]);
				
				this.frame["DD"] = this.frame["DE"];
				this.frame["DE"] = new frameBG(nimg,this.frame["DE"].img["Y"],this.frame["DE"].pos["X"]-625,this.frame["DE"].pos["Y"]);
			}
		}
		this.moveVertical = function(){
			if((this.frame["E"].pos["Y"]+600)<0){
				this.frame["E"] = this.frame["DE"];
				this.frame["DE"] = new frameBG(this.frame["E"].img["X"],this.frame["E"].img["Y"]+1,this.frame["E"].pos["X"],this.frame["E"].pos["Y"]+600);
				
				this.frame["D"] = this.frame["DD"];
				this.frame["DD"] = new frameBG(this.frame["D"].img["X"],this.frame["D"].img["Y"]+1,this.frame["D"].pos["X"],this.frame["D"].pos["Y"]+600);
			}
			else if((this.frame["E"].pos["Y"]+50)<0){
				this.frame["DE"].img["Y"] =this.frame["E"].img["Y"]+1;
				this.frame["DE"].pos["Y"] = this.frame["E"].pos["Y"]+600;
				
				this.frame["DD"].img["Y"] =this.frame["D"].img["Y"]+1;
				this.frame["DD"].pos["Y"] = this.frame["D"].pos["Y"]+600;
			}
			if((this.frame["E"].pos["Y"])>0){
				this.frame["DE"] = this.frame["E"];
				this.frame["E"] = new frameBG(this.frame["E"].img["X"],this.frame["E"].img["Y"]-1,this.frame["E"].pos["X"],this.frame["E"].pos["Y"]-600);
				
				this.frame["DD"] = this.frame["D"];
				this.frame["D"] = new frameBG(this.frame["D"].img["X"],this.frame["D"].img["Y"]-1,this.frame["D"].pos["X"],this.frame["D"].pos["Y"]-600);
			}
		}
		
		this.toRight = function(mod){
			mod *= 50;
			this.moveFrame("X",(-mod));
			this.moveHorizontal();
			this.setBG();
		}
		this.toLeft = function(mod){
			mod *= 50;
			this.moveFrame("X",mod);
			this.moveHorizontal();
			this.setBG();
		}
		this.toDown = function(mod){
			mod *= 50;
			this.moveFrame("Y",(-mod));
			this.moveVertical();
			this.setBG();
		}
		this.toTop = function(mod){
			mod *= 50;
			this.moveFrame("Y",mod);
			this.moveVertical();
			this.setBG();
		}
	}
	
	var x=5;
	var y=5;
	var visao = new visaoBg();
	visao.setBG();
	
	getSistemaMundi("naonavegavel",x,y);
	
	$(".to-right").unbind("click").on("click",function(){
		qnt = $(this).attr("mod");
		x+=parseInt(qnt,10);
		if(x>300)x-=301;
		getSistemaMundi("naonavegavel",x,y);
		visao.toRight(qnt);
	});
	$(".to-left").unbind("click").on("click",function(){
		qnt = $(this).attr("mod");
		x-=parseInt(qnt,10);
		if(x<0)x=301+x;
		getSistemaMundi("naonavegavel",x,y);
		visao.toLeft(qnt);
	});
	$(".to-top").unbind("click").on("click",function(){
		qnt = $(this).attr("mod");
		y-=parseInt(qnt,10);
		if(y<1)y=60;
		getSistemaMundi("naonavegavel",x,y);
		visao.toTop(qnt);
	});
	$(".to-down").unbind("click").on("click",function(){
		qnt = $(this).attr("mod");
		y+=parseInt(qnt,10);;
		if(y>60)y=1;
		getSistemaMundi("naonavegavel",x,y);
		visao.toDown(qnt);
	});
	$(".quadro")
		.die("click")
		.live("click",function(){
			tem = $("#coordenadas").attr("value");
			if(tem.length>0)tem +=";";
			tem += $(this).html();
			$("#coordenadas").attr("value",tem);
		});
	$("#setNaoNavegavel").unbind("click").on("click",function(){
		tem = $("#coordenadas").attr("value");
		sendGet("sisMapaSetNavegavel&tipo=1&str="+tem);
		
		setTimeout(function(){getSistemaMundi("naonavegavel",x,y)},3000);
		$("#coordenadas").attr("value","");
	})
	$("#setNavegavel").unbind("click").on("click",function(){
		tem = $("#coordenadas").attr("value");
		sendGet("sisMapaSetNavegavel&tipo=2&str="+tem);
		
		setTimeout(function(){getSistemaMundi("naonavegavel",x,y)},3000);
		$("#coordenadas").attr("value","");
	})
}
function npc(){
	$(".funcao-venda").unbind("click");
	$(".funcao-compra").unbind("click");
	$(".npc-missao").unbind("click");
	
	back = $("#npc-texto").html();
	
	btVoltar = '<button id="npc-bt-voltar">Voltar</button>';
	
	$(".funcao-venda").on("click",function(){addLoja();});
	
	$(".npc-missao")
		.on("click",function(){
			texto = "";
			op = $(this).attr("status");
			
			if( op == 0 )
				texto = $(this).attr("texto_I");
			else if( op == 1 )
				texto = $(this).attr("texto_A");
			else if( op == 2 )
				texto = $(this).attr("texto_C");
			
			r = new Array();
			r["berries"] = $(this).attr("r_berries");
			r["xp"] = $(this).attr("r_xp");
			r["itens"] = $.parseJSON($(this).attr("r_item"));
			r["equips"] = $.parseJSON($(this).attr("r_equip"));
			
			id = $(this).attr("missao_id");
			addMissao(texto, op, id, r);
		});
	
	function addMissao(texto, op, id, r){
		//atualiza conteudo da tela de cv com o npc
		$("#npc-texto")
			.html("")
			.append(
				$("<P>")
					.html(texto)
			)
			.append(
				$("<DIV>")
					.attr("id","missao-recompensa")
					.html('<b>Recompensas:</b>')
					//recompensas
					.append(
						$('<DIV>')
							.addClass("recompensa-missao")
							.append('<img src="Imagens/NPC/xp.jpg">')
							.append($("<SPAN>").html(r["xp"]))
					)
					.append(
						$('<DIV>')
							.addClass("recompensa-missao")
							.append('<img src="Imagens/NPC/berries.jpg">')
							.append($("<SPAN>").html(formataBerries(r["berries"])))
					)
			);
		//adiciona itens e equipamentos como recompensa
		$.each(r["itens"],function(key,value){
			$("#missao-recompensa")
				.append(
						$('<DIV>')
							.addClass("recompensa-missao")
							.append('<img src="Imagens/NPC/item.jpg">')
							.append($("<SPAN>").html("x1 Item"))
					)
		});
		$.each(r["equips"],function(key,value){
			$("#missao-recompensa")
				.append(
						$('<DIV>')
							.addClass("recompensa-missao")
							.append('<img src="Imagens/NPC/equipamento.jpg">')
							.append($("<SPAN>").html("x1 Equipamento"))
					)
		});
		
		//gera botao de a��o respectiva (aceitar, concluir, e cancelar)
		style = 'style="display: inline-block"';
		if( op == 0 )
			op = "Aceitar";
		if( op == 1 )
			op = "Cancelar";
		if( op == 2 )
			op = "Concluir";
		bt = '<div class="bt-largo missao-'+op+'" missao_id="'+id+'" style="display: inline-block">'+op+'</div>';
		$("#npc-texto")
			.append(
				$("<DIV>")
					.css("margin-top",50)
					.append(
						$("<DIV>")
							.attr("id","npc-bt-voltar")
							.addClass("bt-largo")
							.html("Voltar")
							.css("display","inline-block")
							.css("margin-right","5px")
					)
					.append(bt)
			);
		
		//adiciona funcao aos botoes
		appendMissaoAcao();
		
		//gera botao pra voltar
		$("#npc-bt-voltar").unbind("click").on("click",function(){
			$("#npc-texto").html(back);
			npc();
		});
	}
	function appendMissaoAcao(){
		$(".missao-Aceitar").unbind("click");
		$(".missao-Cancelar").unbind("click");
		$(".missao-Concluir").unbind("click");
		
		$(".missao-Aceitar").on("click",function(){
			sendGet("misAceitar&missao="+$(this).attr("missao_id"));
		});
		$(".missao-Cancelar").on("click",function(){
			sendConfirm(
				"Tem certeza que deseja cancelar essa missão?",
				"misCancelar&missao="+$(this).attr("missao_id")
			);
		});
		$(".missao-Concluir").on("click",function(){
			sendGet("misConcluir&missao="+$(this).attr("missao_id"));
		});
	}
	
	function addLoja(){
		$("#npc-texto")
			.html("")
			.append(
				$("<DIV>")
					.attr("id","npc-loja")
					.append(
						$("<DIV>")
							.attr("id","loja-cabecalho")
							.addClass("loja-label")
							.html("Vender")
					)
					.append(
						$("<DIV>")
							.attr("id","loja-seletores")
							.append(
								$("<DIV>")
									.attr("id","sel-itens")
									.addClass("bt-largo")
									.html("Itens")
							).append(
								$("<DIV>")
									.attr("id","sel-equips")
									.addClass("bt-largo")
									.html("Equipamentos")
							).append(
								$("<DIV>")
									.addClass("page-back")
									.addClass("bt-quadrado")
									.html("<")
							).append(
								$("<DIV>")
									.addClass("page-num")
									.html("1")
							).append(
								$("<DIV>")
									.addClass("page-next")
									.addClass("bt-quadrado")
									.html(">")
							)
					).append(
						$("<DIV>")
							.attr("id","loja-secao-1")
					).append(
						$("<DIV>")
							.attr("id","loja-secao-2")
					).append(
						$("<DIV>")
							.attr("id","loja-informacoes")
							.append(
								$("<DIV>")
									.attr("id","npc-bt-voltar")
									.addClass("bt-largo")
									.html("Cancelar")
							)
					)
			)
		
		$("#npc-bt-voltar").unbind("click").on("click",function(){
			$("#npc-texto").html(back);
			npc();
		});
	}
}

function missaoCadastrar(){
	contNPCi = $(".lista-ilhas-npcs").attr("quant");
	contNPCc = $(".lista-ilhas-npcs-c").attr("quant");
	contObjet = $(".lista-objetivo").attr("quant");
	contRitn = $(".lista-recompensa-item").attr("quant");
	contRequip = $(".lista-recompensa-equip").attr("quant");
	$('.form-input[name="is_texto_exclusivo"]').unbind("change").on("change",function(){
		if($(this).attr("value")==0)
			$(".textos-marines").css("display","none");
		else
			$(".textos-marines").css("display","block");
	});
	$(".add-recompensa-item").unbind("click").on("click",function(){
		$(".lista-recompensa-item")
			.append("<br/>")
			.append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","recompensa-item-"+contRitn)
			);
		contRitn++;
	});
	$(".add-recompensa-equip").unbind("click").on("click",function(){
		$(".lista-recompensa-equip")
			.append("<br/>")
			.append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","recompensa-equip-"+contRequip)
			);
		contRequip++;
	});

	$(".add-ilha-npc").unbind("click").on("click",function(){
		$(".lista-ilhas-npcs")
			.append("<br/>")
			.append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","npc-"+contNPCi)
			).append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","ilha-"+contNPCi)
			);
		contNPCi++;
	});

	$(".add-ilha-npc-c").unbind("click").on("click",function(){
		$(".lista-ilhas-npcs-c")
			.append("<br/>")
			.append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","npc-c-"+contNPCc)
			).append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","ilha-c-"+contNPCc)
			);
		contNPCc++;
	});

	$(".add-objetivo").unbind("click").on("click",function(){
		$(".lista-objetivo")
			.append("<br/>")
			.append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","objetivo-"+contObjet)
			).append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","objetivo-id-"+contObjet)
			).append(
				$("<INPUT>")
					.addClass("form-input")
					.attr("name","objetivo-quant-"+contObjet)
			);
		contObjet++;
	});
}

function ilhaExterno(){
	var ilha;
	var zona;
	var conteudo;
	
	$("#ilha-externo-filtrar").unbind("click").on("click",function(){
		val = $("#externo-select-ilha").attr("value").split("-");

		layout = val[0];
		ilha = val[1];
		zona = $("#externo-select-zona").attr("value");
		conteudo = $("#externo-select-conteudo").attr("value");
		
		locale = "sisIlhaExternoVisualizar";
		locale += "&ilha="+ilha;
		locale += "&zona="+zona;
		locale += "&conteudo="+conteudo;
		
		sendGet(locale,true,function(retorno){
			$("#icon_carregando").fadeOut();
			getDisponivel=true;
			SistemaGerarIlhaExterna("ilha-externa-visao",zona,layout,conteudo,retorno.retorno);
		});
	});
	
	$(".ilha-externo-quadro").die("click").live("click",function(){
		$("#externo-editor-atributo1").attr("value","").attr("value",$(this).data("atributo1"));
		$("#externo-editor-atributo2").attr("value","").attr("value",$(this).data("atributo2"));
		$("#externo-editor-atributo3").attr("value","").attr("value",$(this).data("atributo3"));

		$("#externo-editor-coord").html($(this).attr("id"));
	});
	
	$("#externo-editor-bt-alterar").unbind("click").on("click",function(){
		att1 = $("#externo-editor-atributo1").attr("value");
		att2 = $("#externo-editor-atributo2").attr("value");
		att3 = $("#externo-editor-atributo3").attr("value");
		v = $("#externo-editor-coord").html();
		v = v.split("Y");
		coord = v[1];
		
		locale = "sisIlhaExternoAlterarCoordenada";
		locale += "&ilha="+ilha;
		locale += "&zona="+zona;
		locale += "&conteudo="+conteudo;
		locale += "&coordenada="+coord;
		locale += "&atributo1="+att1;
		locale += "&atributo2="+att2;
		locale += "&atributo3="+att3;
		
		sendGet(locale,true,function(retorno){
			$("#icon_carregando").fadeOut();
			getDisponivel=true;
			$("#ilha-externo-filtrar").click();
		});
	});
	
	function SistemaGerarIlhaExterna(div,zona,layout,conteudo,elementos){
		$("#"+div).css("background","url(Imagens/Ilhas/"+layout+"/"+zona+".jpg)").html("");
		
		for(x=0; x<20; x++){
			for(y=0; y<20; y++){
				$("#"+div).append(
					$("<DIV>")
						.addClass("ilha-externo-quadro")
						.attr("id","ilha-externo-quadroY"+x+"_"+y)
				);
			}
		}
		if(conteudo=="portal"){
			$.each(elementos,function(key,value){
				$("#ilha-externo-quadroY"+value.coordenada)
					.append(
						$("<IMG>")
							.attr("src","Imagens/Ilhas/Portal.png")
					)
					.data("atributo1",value.zona_destino)
					.data("atributo2",value.coordenada_destino);
			});
		}
		else if(conteudo=="coleta"){
			$.each(elementos,function(key,value){
				$("#ilha-externo-quadroY"+value.coordenada)
					.append(
						$("<IMG>")
							.attr("src","Imagens/Ilhas/Coleta.png")
					)
					.data("atributo1",value.item_id)
					.data("atributo2",value.tempo_respawn)
					.data("atributo3",value.requisito_profissao);
			});
		}
		else if(conteudo=="mob"){
			$.each(elementos,function(key,value){
				$("#ilha-externo-quadroY"+value.coordenada)
					.css("width","25px")
					.css("height","25px")
					.css("background","#f00")
					.css("opacity","0.5")
					.data("atributo1",value.mob_id)
					.data("atributo2",value.chance)
					.data("atributo3",value.background);
			});
		}
	}
}

function ilhaExternoJogador(){
	var eu_x;
	var eu_y;
	
	atualizaMapa();
	$("#ilha-externo-mapa").html('<img src="Imagens/carregando.gif" style="margin-top:45%" />');
	function atualizaMapa(){
		sendGet("ilhaExternoVisualizar",false,function(r){
			processa(r);
			getDisponivel = true;
			SistemaGerarIlhaExterna("ilha-externo-mapa",r.retorno);
			timeOuts["ilhaExterno"] = setTimeout(atualizaMapa,4000);
		});
	}
	function addEventos(){
		$(".ilha-externo-quadro").unbind("dblclick").unbind("click").single_double_click(function(){
			if( Math.abs($(this).data("x")-eu_x)>2 || Math.abs($(this).data("y")-eu_y)>2){
				$("#msg-superior").html("Esse quadro está muito distante para que você possa interagir com ele.");
				$("#msg-inferior").html("");
				return;
			}
			
			$("#msg-superior").html("");
			coord = $(this).data("x")+"_"+$(this).data("y");
			
			if($(this).data("portal")){
				$("#msg-superior")
					.append(
						$("<IMG>")
							.attr("src","Imagens/Ilhas/Portal.png")
							.css("float","left")
							.css("margin","0 40px")
					)
					.append(
						$("<A>")
							.attr("href","ilhaUsarPortal&coord="+coord)
							.addClass("bt-largo")
							.addClass("link_send")
							.css("float","left")
							.css("margin-top","3px")
							.html("Atravessar")
					)
					.append($("<DIV>").addClass("clear"));
			}
			if($(this).data("item")){
				$("#msg-superior")
					.append(
						$("<IMG>")
							.attr("src","Imagens/Ilhas/Coleta.png")
							.css("float","left")
							.css("margin","0 40px")
					)
					.append(
						$("<A>")
							.attr("href","ilhaColetarItem&coord="+coord)
							.addClass("bt-largo")
							.addClass("link_send")
							.css("float","left")
							.css("margin-top","3px")
							.html("Coletar"+(($(this).data("requisito_profissao")==0)?"":" - "+getProfissao($(this).data("requisito_profissao"))))
					)
					.append($("<DIV>").addClass("clear"));
			}
			if($(this).data("jogador")){
				$("#msg-inferior").html('<img src="Imagens/carregando.gif" />');
				
				sendGet("ilhaExternoVisualizarJogadores&coord="+coord,false,function(retorno){
					getDisponivel = true;
					$("#msg-inferior").html("");
					
					listaJogadores("msg-inferior",retorno.retorno,390);
				});
			}
			else{
				$("#msg-inferior").html("");
			}
		},function(){
			parax = (parseInt($(this).data("x"),10)-parseInt(eu_x,10));
			paray = (parseInt($(this).data("y"),10)-parseInt(eu_y));
			
			if( Math.abs(parax)>2 || Math.abs(paray)>2)
				return;
			
			clearTimeout(timeOuts["ilhaExterno"]);
			
			sendGet("ilhaAndar&x="+parax+"&y="+paray,true,function(retorno){
				getDisponivel=true;
				$('#icon_carregando').fadeOut();
				
				if(retorno.retorno=="iniciarCombate"){
					loadPagina("combate");
				}
				else if(retorno.retorno){
					SistemaGerarIlhaExterna("ilha-externo-mapa",retorno.retorno);
					timeOuts["ilhaExterno"] = setTimeout(atualizaMapa,4000);
				}
			});
		});
	}
	function SistemaGerarIlhaExterna(div,elementos){
		$("#"+div).html("");
		//adiciona quadros
		for(x=0; x<20; x++){
			for(y=0; y<20; y++){
				$("#"+div).append(
					$("<DIV>")
						.addClass("ilha-externo-quadro")
						.attr("id","ilha-externo-quadroY"+x+"_"+y)
						.data("x",x)
						.data("y",y)
						.data("item",false)
						.data("portal",false)
						.data("jogador",false)
				);
			}
		}
		
		//adiciona itens
		$.each(elementos.itens,function(key,value){
			$("#ilha-externo-quadroY"+value.coordenada)
			.append(
				$("<IMG>")
					.attr("src","Imagens/Ilhas/Coleta.png")
			)
			.data("item",true)
			.data("item_id",value.item_id)
			.data("tempo_respawn",value.tempo_respawn)
			.data("requisito_profissao",value.requisito_profissao)
			.data("ultimo_respawn",value.ultimo_respawn);
		});
		//adiciona portais
		$.each(elementos.portais,function(key,value){
			$("#ilha-externo-quadroY"+value.coordenada)
			.append(
				$("<IMG>")
					.attr("src","Imagens/Ilhas/Portal.png")
			)
			.data("portal",true)
			.data("zona_destino",value.zona_destino)
			.data("coordenada_destino",value.coordenada_destino);
		});
		
		//adiciona jogadores
		$.each(elementos.jogadores,function(key,value){
			$("#ilha-externo-quadroY"+value.coordenada)
			.html("")
			.append(
				$("<IMG>")
					.attr("src",value.bandeira)
					.attr("width","23px")
					.css("margin-top","5px")
			)
			.data("jogador",true);
		});
		
		//eu
		c = elementos.eu.coord.split("_");
		eu_x = c[0];
		eu_y = c[1];
		$("#ilha-externo-quadroY"+elementos.eu.coord)
			.html("")
			.addClass("ilha-externo-quadro-eu")
			.append(
				$("<IMG>")
				.attr("src",elementos.eu.icon)
				.attr("width","23px")
				.css("margin-top","5px")
			);
		
		//chamada para adicionar eventos
		addEventos();
	}
}
/* visualizador de jogador */
function listaJogadores(div,jogadores, tamanhoDiv){
	$.each(jogadores,function(key,value){
		$("#"+div).append(
			$("<DIV>")
				.addClass("mapa-info-jogador")
				.append(
					$("<DIV>")
						.addClass("info-jogador")
						.append(
							$("<DIV>")
								.addClass("jogador")
								.append(
									$("<DIV>")
										.addClass("left-bandeira")
										.append(
											$("<IMG>")
												.attr("src",value.bandeira)
												.attr("width","70px")
										)
								)
								.append(
									$("<DIV>")
										.addClass("right-info")
										.html(
											value.nome_trip+"<br>"+
											"Capitão: "+value.nome_cap+"<br>"+
											value.patente+"<br>"+
											value.tripulantes+" tripulante(s)<br>"+
											"Nível "+value.lvl
										)
								)
						)
						.append(
							(value.alianca)
							?(
							$("<DIV>")
								.addClass("alianca")
								.append(
									$("<DIV>")
										.addClass("alli-bandeira")
										.append(
											$("<IMG>")
												.attr("src",value.bandeira)
												.attr("width","70px")
										)
								)
								.append(
									$("<DIV>")
										.addClass("alli-info")
										.html(
											value.nome_trip+"<br>"+
											"Capitão: "+value.nome_cap+"<br>"+
											value.patente+"<br>"+
											value.tripulantes+" tripulante(s)<br>"+
											"Nível "+value.lvl
										)
								)
							)
							:("")
						)
				)
				.append(
					$("<DIV>")
						.addClass("acoes-jogador")
						.addClass("clear")
						.append(
							(value.pvp)?(
									$("<DIV>")
										.addClass("acoes-jogador-buttons")
										.append(
											$("<A>")
												.attr("href","cbtIniciar&tipo=1&alvo="+value.id)
												.addClass("bt-largo")
												.addClass("link_send")
												.addClass((value.atacar)?"":"bt-off")
												.html('Atacar <img src="Imagens/Icones/Atacar.png" />')
										)
										.append(
											$("<A>")
												.attr("href","cbtIniciar&tipo=3&alvo="+value.id)
												.addClass("bt-largo")
												.addClass("link_send")
												.addClass((value.amigavel)?"":"bt-off")
												.html('Amigável <img src="Imagens/Icones/Amigavel.png" />')
										)
										.append(
											$("<A>")
												.attr("href","cbtIniciar&tipo=2&alvo="+value.id)
												.addClass("bt-largo")
												.addClass("link_send")
												.addClass((value.saquear)?"":"bt-off")
												.html('Saquear <img src="Imagens/Icones/Saquear.png" />')
										)
										.append(
											$("<A>")
												.attr("href","cbtDisparar&alvo="+value.id)
												.addClass("bt-largo")
												.addClass("link_send")
												.addClass((value.disparar)?"":"bt-off")
												.html('Disparar <img src="Imagens/Icones/Disparar.png" />')
										)
								)
								:("")
						)
				)
				.append($("<DIV>").addClass("clear"))
		)
	});
}

function triHabilidades(){
	addSeletorPersonagem();
	
	addToggleClickExterno("habilidade-title","","habilidade-info","habilidade-selecionada");
}

function combate(tipo,equipe,turno,espera,movimentos,status){
	var cacheHabilidades = new Array(); //listagem de habilidades de personagens
	
	//variaveis de posicionamento
	var w = new Array();
	var l = new Array();
	var t = new Array();
	
	var ataqueIndice = 0;
	
	constroiTabuleiro();
	appendClick();
	
	if(status=="venceu"){
		vencer();
		return;
	}
	else if(status=="perdeu"){
		perder();
		return;
	}
	
	if(tipo=="PvP"){
		if(turno!=equipe)
			timeOuts["pvp"]=setTimeout(atualizaTabuleiro,3000);
		intervals["pvp-tempo"] = setInterval(atualizaTempo,1000);
	}
	function changeTurno(nextTurno,nextEspera,nextMovimentos){
		if(typeof nextTurno=="undefined")
			turno = (equipe==1)?0:1;
		else
			turno = nextTurno;
			
		if(typeof nextEspera=="undefined")
			espera = tempoTurno;
		else
			espera = nextEspera;
		$("#tempo-espera-sec").html(espera);
			
		if(typeof nextMovimentos=="undefined")
			movimentos = movimentosTurno;
		else
			movimentos = nextMovimentos;
		
		verificaDerrota();
		verificaVitoria();
	}
	function atualizaTempo(){
		var tmp = $("#tempo-espera-sec").html();
		tmp --;
		$("#tempo-espera-sec").html(tmp);
		
		if(tmp<=0){
			$(".habilidade").removeClass("habilidade-selecionada");
			removeAtaqueSelecionado();
			$(".movimento, .ataque:not(.personagem)")
				.css("z-index",0);
			$("#npc, .quadro")
				.removeClass("movimento")
				.removeClass("ataque");
			ataqueIndice = 0;
			
			clearTimeout(timeOuts["pvp"]);
			clearInterval(intervals["pvp-tempo"]);
			sendGet("cbtPerderVez",true,function(r){
				getDisponivel=true;
				$('#icon_carregando').fadeOut();
				
				changeTurno(r.retorno.turno,r.retorno.tempo,r.retorno.movimentos);
				
				appendClick();
				
				if(turno!=equipe){
					timeOuts["pvp"]=setTimeout(atualizaTabuleiro,3000);
				}
				intervals["pvp-tempo"] = setInterval(atualizaTempo,1000);
			},true);
		}
	}
	function atualizaTabuleiro(){
		if(turno==equipe)
			return;
		sendGet("cbtGetAcoes",false,function(r){
			getDisponivel = true;
			
			if(r.retorno){
				$.each(r.retorno,function(key,value){
					if(value.tipo==1){
						var origem = "quadro-"+value.origem_x+"_"+value.origem_y;
						var equipe = value.equipe;
						var x = value.destino_x;
						var y = value.destino_y;
						var personagem_id = value.pers;
						removePersonagem(personagem_id,origem,equipe,x,y);
					}
					else if(value.tipo==0){
						id = value.pers;
						atualizaHP(id,value);
					}
					else if(value.tipo==2){
						relatorio = $("#relatorio").html();
						$("#relatorio").html(value.log+relatorio);
					}
					else if(value.tipo==3){
						changeTurno(value.turno,value.tempo,value.movimentos);
						
						appendClick();
						clearTimeout(timeOuts["pvp"]);
						clearInterval(intervals["pvp-tempo"]);
						intervals["pvp-tempo"] = setInterval(atualizaTempo,1000);
					}
				});
			}
			
			timeOuts["pvp"]=setTimeout(atualizaTabuleiro,3000);
			
			verificaDerrota();
			verificaVitoria();
		});
	}
	//adiciona eventos das habiliaddes de movimento
	$(".habilidade.habilidade_mover").die("click").live("click",function(){
		$(".habilidade").removeClass("habilidade-selecionada");
		$(this).addClass("habilidade-selecionada");
		
		var cx = $(".personagem.personagem-selecionado").attr("x");
		var cy = $(".personagem.personagem-selecionado").attr("y");

		removeAtaqueSelecionado();
		$(".movimento, .ataque:not(.personagem)")
			.css("z-index",0);
		
		$("#npc, .quadro")
			.removeClass("movimento")
			.removeClass("ataque");
		ataqueIndice = 0;
		
		personagem_id = $(this).data("personagem_id");
		
		addClassInRange(personagem_id,cx,cy,2,false,"movimento","movimento",1);
	});
	//adiciona enventos das habilidades de ataque/buff
	$(".habilidade.habilidade_atacar").die("click").live("click",function(){
		$(".habilidade").removeClass("habilidade-selecionada");
		$(this).addClass("habilidade-selecionada");
			
		var cx = $(".personagem.personagem-selecionado").attr("x");
		var cy = $(".personagem.personagem-selecionado").attr("y");
		
		removeAtaqueSelecionado();
		$(".movimento, .ataque:not(.personagem)")
			.css("z-index",0);
		
		$("#npc, .quadro")
			.removeClass("movimento")
			.removeClass("ataque");
		ataqueIndice = 0;
		
		personagem_id = $(this).data("personagem_id");
		habilidade_id = $(this).data("habilidade_id");
		alcance = parseInt($(this).data("alcance"),10);
		area = parseInt($(this).data("area"),10);
		
		addClassInRange(personagem_id,cx,cy,alcance+1,true,"ataque",habilidade_id,area);
	});

	//adiciona evento de clicar pra usar movimento
	$(".quadro.movimento").die("click").live("click",function(){
		$(".movimento, .ataque:not(.personagem")
			.css("z-index",0);
		$("#npc, .quadro")
			.removeClass("movimento")
			.removeClass("ataque");
		ataqueIndice = 0;
		
		var personagem_id = $(this).data("personagem_id");
		var x = $(this).attr("x");
		var y = $(this).attr("y");
		
		var data = "&pers="+personagem_id;
		data += "&x="+x;
		data += "&y="+y;
		
		var origem = $(this).data("origem");
		
		sendGet("cbtMover"+data,true,function(r){
			$('#icon_carregando').fadeOut();
			getDisponivel=true;
			if(r.retorno){
				movimentos--;
				removePersonagem(personagem_id,origem,equipe,x,y);
			}
			appendClick(true);
		})
	});
	
	//adiciona evento de clicar pra usar habilidade de ataque
	$(".ataque:not(.ataque-selecionado)").die("click").live("click",function(){
		$(".movimento, .ataque:not(.personagem)")
			.css("z-index",0);
		$("#npc, .quadro")
			.removeClass("movimento")
			.removeClass("ataque");
		
		var personagem_id = $(this).data("personagem_id");
		var habilidade_id = $(this).data("habilidade_id");
		
		if($(this).data("area")!=0 && $(this).attr("id")!="npc"){
			$(this)
				.addClass("ataque-selecionado")
				.addClass("ataque-selecionado-"+ataqueIndice);
			ataqueIndice++;
			
			var cx = $(this).attr("x");
			var cy = $(this).attr("y");
			
			alcance = 1;
			area = parseInt($(this).data("area"),10);
			
			addClassInRange(personagem_id,cx,cy,alcance+1,true,"ataque",habilidade_id,area);
		}
		else{
			$(this)
				.addClass("ataque-selecionado")
				.addClass("ataque-selecionado-"+ataqueIndice);
			ataqueIndice++;
			
			var alvo = "&pers="+personagem_id;
			alvo += "&hab="+habilidade_id;
			alvo += "&alvo=";
			for(i = 0; i<ataqueIndice;i++){
				id = $(".ataque-selecionado.ataque-selecionado-"+i).attr("id");
				ix = $(".ataque-selecionado.ataque-selecionado-"+i).attr("x");
				iy = $(".ataque-selecionado.ataque-selecionado-"+i).attr("y");
				if(id=="npc"){
					alvo += "npc;";
				}
				else
					alvo += ix+"_"+iy+";";
			}
			
			sendGet("cbtAtacar"+alvo,true,function(r){
				$('#icon_carregando').fadeOut();
				getDisponivel=true;
				
				if(r.retorno){
					movimentos = 5;
					if(r.retorno.npc){
						value = r.retorno.npc;
						rz = value.hp/value.hpM;
						$("#npc-hp")
							.html("")
							.append(barra(150, "gray", rz, "green", value.hp+" / "+value.hpM, 1 ));
						
						if(parseInt(value.hp,10)<=0){
							status = "venceu";
							vencer();
						}
					}
					if(r.retorno.personagens){
						$.each(r.retorno.personagens,atualizaHP);
					}
					if(r.retorno.log){
						relatorio = $("#relatorio").html();
						$("#relatorio").html(r.retorno.log+relatorio);
					}
				}
				$(".personagem").removeClass("personagem-selecionado");
				if(tipo=="PvP"){
					changeTurno();
					
					if(turno!=equipe){
						timeOuts["pvp"]=setTimeout(atualizaTabuleiro,3000);
					}
					clearInterval(intervals["pvp-tempo"]);
					intervals["pvp-tempo"] = setInterval(atualizaTempo,1000);
				}
				appendClick();
				verificaDerrota();
				verificaVitoria();
			});
			removeAtaqueSelecionado();
		}
	});
	function verificaDerrota(){
		var meusPers = 0;
		if(status=="continua"){
			$(".personagem").each(function(){
				if($(this).hasClass("equipe-"+equipe)){
					meusPers++;
				}
			});
			
			if(meusPers==0)
				perder();
		}
		else if(status=="perdeu")
			perder();
	}
	
	function verificaVitoria(){
		var persInimigo = 0;
		var equipeInimiga = (equipe==1)?0:1;
		
		if(status=="continua"){
			$(".personagem").each(function(){
				if($(this).hasClass("equipe-"+equipeInimiga)){
					persInimigo++;
				}
			});
			
			if(persInimigo==0)
				vencer();
		}
		else if(status=="venceu")
			vencer();
	}
	function perder(){
		clearTimeout(timeOuts["pvp"]);
		clearInterval(intervals["pvp-tempo"]);
		$("#tempo-espera-sec").css("display","none");
		status="perdeu";
		$("#tabuleiro")
			.html("")
			.append(
				$("<DIV>")
					.addClass("quadro-final")
					.append(
						$("<DIV>").addClass("quadro-final-texto").html("Você Perdeu...")
					)
					.append(
						$("<BUTTON>")
							.attr("href","cbtFinalizar")
							.addClass("link_send")
							.html("Continuar")
					)
			);
		$("#personagem-click").html("");
	}
	function vencer(){
		clearTimeout(timeOuts["pvp"]);
		clearInterval(intervals["pvp-tempo"]);
		$("#tempo-espera-sec").css("display","none");
		status="venceu";
		$("#tabuleiro")
			.html("")
			.append(
				$("<DIV>")
					.addClass("quadro-final")
					.append(
						$("<DIV>").addClass("quadro-final-texto").html("Você venceu!")
					)
					.append(
						$("<BUTTON>")
							.attr("href","cbtFinalizar")
							.addClass("link_send")
							.html("Continuar")
					)
			);
		$("#personagem-click").html("");
	}
	function atualizaHP(key,value){
		var rz = value.hp/value.hpM;
		if(value.hp==0){
			getInfoPersonagemRemovido("quadro-"+value.quadro,value.equipe,true);
		}
		else{
			var x = $('.personagem[perid="'+key+'"]').attr("x");
			
			$('.personagem[perid="'+key+'"] .barraHP')
				.html("")
				.append(barra(w[x], "red2", rz, "green2","",5));
			
			$("#pers-"+key+"-info .info-barra-HP")
				.html("")
				.append(barra(170, "gray", rz, "green", value.hp+" / "+value.hpM,0));
			
			rz = value.mp/value.mpM;
			$("#pers-"+key+"-info .info-barra-MP")
				.html("")
				.append(barra(170, "gray", rz, "yellow", value.mp+" / "+value.mpM,0));
		}
	}
	function removePersonagem(personagem_id,origem,equipe,x,y){
		var removido = getInfoPersonagemRemovido(origem,equipe,false);
			
		$("#quadro-"+x+"_"+y)
			.html(removido[0])
			.addClass("personagem")
			.addClass("icon-cursor")
			.addClass("equipe-"+equipe)
			.attr("perid",personagem_id)
			.effect("shake",{times:2,distance:5},50);
		
		$("#quadro-"+x+"_"+y+" .barraHP .externo").css("width",w[x]);
		$("#quadro-"+x+"_"+y+" .barraHP .externo .interno").css("width",removido[1]*w[x]);

		$("#quadro-"+x+"_"+y+" .personagem-img")
			.css("width",w[x]);
	
		$("#quadro-"+x+"_"+y+".personagem")
			.css("z-index",parseInt(x,10)+2);
	}
	function getInfoPersonagemRemovido(origem,equipe,effect){
		$("#"+origem)
			.removeClass("personagem")
			.removeClass("icon-cursor")
			.removeClass("personagem-selecionado")
			.removeClass("equipe-"+equipe)
			.removeAttr("perid")
			.removeData()
			.unbind("click")
			.css("z-index",0);
		
		barraE = parseInt($("#"+origem+" .barraHP .externo").css("width"),10);
		barraI = parseInt($("#"+origem+" .barraHP .externo .interno").css("width"),10);
		barraI = (barraI/barraE);
		
		ht = $("#"+origem).html();
		if(typeof effect != "undefined" && effect)
			$("#"+origem).effect("explode").html("").fadeIn(1);
		
		$("#"+origem).html("");
		
		var info = new Array();
		info[0] = ht;
		info[1] = barraI
		
		return info;
	}
	
	function removeAtaqueSelecionado(){
		$(".ataque-selecionado")
			.removeClass("ataque-selecionado")
			.removeData("area")
			.removeData("habilidade_id")
			.removeData("personagem_id")
			.removeData("origem");
		$(".ataque-selecionado:not(.personagem)")
			.css("z-index",0)
		for(i = 0; i<ataqueIndice;i++){
			$(".ataque-selecionado-"+i)
				.removeClass("ataque-selecionado-"+i);
		}
		ataqueIndice=0;
	}
	
	function appendClick(resetCache){
		if(tipo=="PvP")
			var tempo = espera;
		else
			var tempo = "";
		
		if(typeof resetCache == "undefined"){
			$("#personagem-click")
				.html("")
				.append(
					$("<DIV>")
						.attr("id","label-0")
						.addClass("label")
						.html((turno==equipe)?(
							'É a sua vez!<br>Selecione um personagem.'
						):(
							'Aguardando seu oponente...'
						))
				)
				.append(
					$("<DIV>")
						.attr("id","label-carregando")
						.addClass("label")
						.html('<img src="Imagens/carregando2.gif" />')
				)
				.append(
					$("<DIV>")
						.attr("id","tempo-espera-sec")
						.html(tempo)
				);
		}
		else{
			$(".info-hab-mov-restante").html(movimentos);
			if(movimentos<=0){
				$(".habilidade_mover")
					.removeClass("habilidade")
					.addClass("habilidade-indisponivel");
			}
		}
		$("#personagem-click .label").css("display","none");
		$("#personagem-click #label-0").css("display","block");
		
		if(turno==equipe){
			if(typeof resetCache == "undefined")
				cacheHabilidades = new Array();
			
			$(".personagem.equipe-"+equipe+":not(.ataque)").die("mouseup").live("mouseup",function(e){
				if(getDisponivel){
					$(".personagem").removeClass("personagem-selecionado");
					$(this).addClass("personagem-selecionado");
					removeAtaqueSelecionado();
					$(".movimento")
						.css("z-index",0);
					$(".ataque:not(.personagem)")
						.css("z-index",0);
					$("#npc, .quadro")
						.removeClass("movimento")
						.removeClass("ataque");
					ataqueIndice = 0;
					$(".habilidade").removeClass("habilidade-selecionada");
					
					$("#personagem-click .label").css("display","none");
					
					perId = $(this).attr("perId");
					
					if(in_array(perId,cacheHabilidades)){
						$("#personagem-click #label-"+perId).css("display","block");
					}
					
					else{
						$("#personagem-click #label-carregando").css("display","block");
						
						sendGet("cbtGetHabilidades&id="+perId,false,function(r){
							getDisponivel = true;
							$("#personagem-click #label-carregando").css("display","none");
							
							cacheHabilidades.push(perId);
							
							$("#personagem-click")
								.append(
										$("<DIV>")
											.attr("id","label-"+perId)
											.addClass("label")
									)
							var img = $('.personagem[perid="'+perId+'"] .personagem-img').attr("src");
							
							$("#personagem-click #label-"+perId)
								.css("display","block")
								.append(
									$("<DIV>").addClass("habilidade-imgs")
										.append(
											$("<DIV>")
												.addClass("per-click-title")
												.append(
													$("<IMG>")
														.attr("src",img)
												)
												.addClass("equipe-"+equipe)
										)
										.append($("<DIV>").addClass("mover"))
										.append($("<DIV>").addClass("basicas"))
										.append($("<DIV>").addClass("classe"))
										.append($("<DIV>").addClass("profissao"))
										.append($("<DIV>").addClass("akuma"))
								)
								.append($("<DIV>").addClass("habilidade-infos"));
							
							$.each(r.retorno,function(key,value){
								if(value.habilidade_id=="movimento"){
									insClass= "mover";
									actionClass= "mover";
									
									classdisponivel=(movimentos<=0)?"-indisponivel":"";
								}
								else{
									actionClass= "atacar";
									
									if(value.categoria==0){
										insClass= "basicas";
									}
									else if(value.categoria==1){
										insClass= "classe";
									}
									else if(value.categoria==2){
										insClass= "profissao";
									}
									else{
										insClass= "akuma";
									}
									classdisponivel = "";
									
									if(parseInt(value.consumo,10)>parseInt(r.energia,10))
										classdisponivel="-indisponivel";
									if(parseInt(value.esperaRestante,10)!=0)
										classdisponivel="-indisponivel";
								}
								
								$("#personagem-click #label-"+perId+" ."+insClass)
									.append(
										$("<DIV>")
											.attr("id","habilidade-"+perId+"-"+value.habilidade_id)
											.addClass("habilidade"+classdisponivel)
											.addClass("habilidade_"+actionClass)
											.addClass("habilidade-tipo-"+value.tipo)
											.data("habilidade_id",value.habilidade_id)
											.data("personagem_id",perId)
											.data("alcance",(typeof value.alcance !="undefined")?(value.alcance):("1"))
											.data("area",(typeof value.area !="undefined")?(value.area):("1"))
											.append(
												$("<IMG>")
													.addClass("habilidade_img")
													.attr("src","Imagens/Skill/"+value.img+".jpg")
											)
									);
								$("#personagem-click #label-"+perId+" .habilidade-infos")
									.append(
										$("<DIV>")
											.attr("id","habilidade-"+perId+"-"+value.habilidade_id+"-info")
											.addClass("habilidade_info")
											.append(geralBox(getInfoHabilidade(value,movimentos),250,"info-item"))
									)
							});
							if(e.which==3){
								$("#habilidade-"+perId+"-movimento").click();
							}
						});
					}
					
					//auto move com botao direito
					if(e.which==3){
						$("#habilidade-"+perId+"-movimento").click();
					}
				}
			});
		}
		else{
			$(".personagem").removeClass("personagem-selecionado");
			$(".personagem.equipe-"+equipe+":not(.ataque)").die("mouseup");
		}
	}
	function constroiTabuleiro(){
		for(x=0;x<=14;x++){
			if(tipo=="PvE"){
				//pontos t: -20 7 55 115 200
				t[x] = 0.0563*Math.pow(x,3)-0.0505*Math.pow(x,2)+13.7533*x-20.2032;
				//pontos w: 24.7 27.5 32 38 46.3
				w[x] = 0.0061*Math.pow(x,3)-0.0151*Math.pow(x,2)+1.3868*x+24.7102;
				//pontos l: 155 137 105 65 10
				l[x] = -0.0314*Math.pow(x,3)-0.0364*Math.pow(x,2)-8.9879*x+155.1003;
			}
			else{
				//pontos t: -20 7 55 115 200
				t[x] = 0.0563*Math.pow(x,3)-0.0505*Math.pow(x,2)+13.7533*x-20.2032;
				//pontos w: 24.7 27.5 32 38 46.3
				w[x] = 0.0061*Math.pow(x,3)-0.0151*Math.pow(x,2)+1.3868*x+24.7102;
				//pontos l: 155 137 105 65 10
				l[x] = -0.0314*Math.pow(x,3)-0.0364*Math.pow(x,2)-8.9879*x+155.1003;
			}
			
			h = (55/75)*w[x];
			for(y=0;y<=13;y++){
				$("#quadro-"+x+"_"+y)
					.css("width",w[x])
					.css("height",h+2)
					.css("left",l[x]+((w[x]+5)*y))
					.css("top",t[x]);
				
				$("#quadro-"+x+"_"+y+" .personagem-img")
					.css("width",w[x]);
				
				$("#quadro-"+x+"_"+y+".personagem")
					.css("z-index",x+2);
			}
		}
		$(".quadro").bind("contextmenu",function(e){
			e.preventDefault();
			return false;   
		});
	}
	
	//adiciona os hovers
	//habilidades
	$(".personagem, .habilidade, .habilidade-indisponivel")
		.die("mouseenter").live("mouseenter",function(){
			id = $(this).attr("id");
			
			$("#"+id+"-info").css("display","block")
		})
		.die("mouseleave").live("mouseleave",function(){
			id = $(this).attr("id");
			
			$("#"+id+"-info").css("display","none")
		});
	//personagens no tabuleiro
	$(".personagem")
		.die("mouseenter").live("mouseenter",function(){
			id = $(this).attr("perid");
			
			$("#pers-"+id+"-info").css("display","block")
		})
		.die("mouseleave").live("mouseleave",function(){
			id = $(this).attr("perid");
			
			$("#pers-"+id+"-info").css("display","none")
		});
	//quadros do relatorio
	$("#relatorio .atacante, #relatorio .alvo")
		.die("mouseenter").live("mouseenter",function(){
			id = $(this).attr("perid");

			if(id=="npc"){
				$('#npc-img').addClass("personagem-hover");
			}
			else if(id!="0"){
				$('.personagem[perid="'+id+'"]').addClass("personagem-hover");
			}
			else{
				id = $(this).attr("quadro");
				$("#quadro-"+id).addClass("personagem-hover");
			}
		})
		.die("mouseleave").live("mouseleave",function(){
			id = $(this).attr("perid");
			if(id=="npc"){
				$('#npc-img').removeClass("personagem-hover");
			}
			else if(id!=0){
				$('.personagem[perid="'+id+'"]').removeClass("personagem-hover");
			}
			else{
				id = $(this).attr("quadro");
				$("#quadro-"+id).removeClass("personagem-hover");
			}
		});
	
}
function hospitalTratamento(){
	$("#hosTratar").unbind("click").on("click",function(){
		var ids = "";
		$(".hosp-check:checked").each(function(){
			ids += $(this).attr("perId")+";";
		});
		
		sendGet("hosTratar&ids="+ids);
	});
	$("#hosFinalizar").unbind("click").on("click",function(){
		var ids = "";
		$(".hosp-check:checked").each(function(){
			ids += $(this).attr("perId")+";";
		});
		
		sendGet("hosFinalizar&ids="+ids);
	});
	$("#hosCancelar").unbind("click").on("click",function(){
		var ids = "";
		$(".hosp-check:checked").each(function(){
			ids += $(this).attr("perId")+";";
		});
		
		sendGet("hosCancelar&ids="+ids);
	});
	
	
	intervals["hospital"]=setInterval(atualizaTempoHospital,1000);
}
function atualizaTempoHospital(){
	$(".t-restante").each(function(){
		var t = $(this).attr("value");
		id = $(this).attr("id");
		
		$("#"+id+"-t").html(transforma_tempo(t));
		t-=1;
		if(t == 0){
			$("#"+id+"-t").html("Recuperado");
			$(this).removeClass("t-restante");
		}
		$(this).attr("value",t);
	});
}
