function transforma_tempo(tempo) {
	var resto_segundos = tempo % 60;
	tempo -= resto_segundos;
	tempo /= 60;
	var resto_minutos = tempo % 60;
	tempo -= resto_minutos;
	tempo /= 60;
	resto_horas = tempo % 24;
	tempo -= resto_horas;
	tempo /= 24;
	string_tempo = "";
	if (tempo > 1) {
		string_tempo += tempo + " dias "
	} else if (tempo == 1) {
		string_tempo += tempo + " dia "
	}
	if (resto_horas < 10) {
		string_tempo += "0";
		string_tempo += resto_horas
	} else {
		string_tempo += resto_horas
	}
	string_tempo += ":";
	if (resto_minutos < 10) {
		string_tempo += "0";
		string_tempo += resto_minutos
	} else {
		string_tempo += resto_minutos
	}
	string_tempo += ":";
	if (resto_segundos < 10) {
		string_tempo += "0";
		string_tempo += resto_segundos
	} else {
		string_tempo += resto_segundos
	}
	return string_tempo
}
function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name){
			return unescape(y);
		}
	}
	return false;
}
function in_array(needle, haystack) {
	for(var i in haystack) {
		if(haystack[i] == needle) return true;
	}
	return false;
}
function formataBerries(num) {
	x = 0;
	if(num<0) {
		num = Math.abs(num);
		x = 1;
	}
	if(isNaN(num)) num = "0";
		cents = Math.floor((num*100+0.5)%100);
		
	num = Math.floor((num*100+0.5)/100).toString();
	
	if(cents < 10) cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
	ret = num + ',' + cents;
	if (x == 1) ret = ' - ' + ret;
	return ret;
}
function elementos(objeto,insere){
	$.each(insere, function(key, value){
		if(value.tag == "texto"){
			objeto.append(value.content);
		}
		else{
			item = $("<"+value.tag+">");
			objeto.append(item);
			$.each(value, function(key, value){
				if(key == "c"){
					elementos(item,value);
				}
				else if(key != "tag"){
					item.attr(key,value);
				}
			});
		}
	});
}

function geralBox(conteudo,width,layout){
	if(!width)width=200;
	b=$("<DIV>")
		.addClass("geral-box")
		.css("width",width)
		.append(
			$("<IMG>")
				.attr("src","Imagens/borda-TE.png")
				.addClass("te")
		)
		.append(
			$("<IMG>")
				.attr("src","Imagens/borda-TD.png")
				.addClass("td")
		)
		.append(
			$("<IMG>")
				.attr("src","Imagens/borda-BE.png")
				.addClass("be")
		)
		.append(
			$("<IMG>")
				.attr("src","Imagens/borda-BD.png")
				.addClass("bd")
		)
		.append(
			$("<DIV>")
				.addClass("geral-box-content")
				.append(conteudo)
		)
		.append($("<DIV>").addClass("clear"));
	if(layout)b.addClass(layout);
	
	return b;
}

function barra(larguraExt, corExt, larguraInt, corInt, texto, tamanho ){
	if(!larguraExt) larguraExt = 200;
	if(!corExt) corExt = "gray";
	if(!corInt) corInt = "black";
	if(!texto) texto = "";
	if(!tamanho) tamanho = 0;
	
	larguraInt*=larguraExt;
	
	if(larguraInt > larguraExt) larguraInt = larguraExt;
	if(larguraInt < 1 && larguraInt > 0) larguraInt = 1;
	tamanho="barra-small-"+tamanho;
	
	b = $("<DIV>")
				.addClass("externo")
				.addClass(corExt)
				.addClass(tamanho)
				.css("width",larguraExt+"px")
				.append(
						$("<DIV>")
							.addClass("interno")
							.addClass(corInt)
							.css("width",larguraInt+"px")
							.append(
								$("<DIV>")
									.addClass("interno-texto")
									.css("width",larguraExt+"px")
									.html(texto)
							)
				);
	return b;
}

function removeCaracteres(str){er=/[^a-z0-9]/gi;str=str.replace(er,"");return str;}
function removeCaracteres2(str){er=/[^a-z0-9 ]/gi;str=str.replace(er,"");return str;}

function formataInfoItem(info){
	return $("<DIV>")
		.addClass("item-info-box")
		.append(
			$("<DIV>")
				.addClass("box-titulo")
				.addClass("cat-"+info.categoria)
				.html(info.nome)
		)
		.append(
			$("<DIV>")
				.addClass("info-1")
				.append(
					$("<DIV>")
						.addClass("direita")
						.append(
							$("<IMG>")
								.addClass("img")
								.attr("src","Imagens/Itens/"+info.img+".png")
						)
						.append(
							$("<DIV>")
								.addClass("lvl")
								.append("Nvl.")
								.append(
									$("<SPAN>")
										.html(info.lvl)
								)
						)
				)
				.append(
					$("<DIV>")
						.addClass("esquerda")
						.html(info.descricao)
				)
		)
		.append(
			$("<DIV>")
				.addClass("info-2")
				.append(
					$("<DIV>")
						.addClass("itn-tipo")
						.html(
							((info.item_id)?
								(getTipoItem(info.tipo))
								:(getTipoEquipamento(info.slot)))
						)
				)
				.append(
					(info.is_negociavel!=1 || info.is_armazenavel!=1)?
						($("<DIV>")
							.addClass("itn-negociavel")
							.html(
								((info.is_negociavel!=1)?"Não negociável; ":"")+
								((info.is_armazenavel!=1)?"Não armazenável; ":"")
							)
						)
						:("")
				)
				.append(
					(info.evolucao)?
							($("<DIV>")
								.addClass("itn-evolucao")
								.html("Evolucao: <span>+"+info.evolucao+"</span> / 10"))
							:("")
				)
				.append(
					$("<DIV>")
						.addClass("itn-efeito")
						.html(
							(info.item_id)?
									getEfeitoItem(info)
									:getEfeitoEquipamento(info)
						)
				)
				.append(
					(info.script)?
						($("<DIV>")
							.addClass("itn-script")
							.html('<a href="'+info.script+'" class="link_send">Usar</a>'))
						:("")
				)
				.append(
					(info.slot_1)?
						(
						$("<DIV>")
							.addClass("itn-slots")
							.append(
								$("<SPAN>")
									.html(getSlotAtributoNome(info.slot_1))
							)
							.append(
								$("<SPAN>")
									.html(getSlotAtributoNome(info.slot_2))
							)
						)
						:("")
				)
				.append(
					(info.equipamento_id)?
						($("<DIV>")
							.addClass("itn-requisito")
							.html(
								"Nível requerido: "+info.lvl+"<br>"+
								"Classe requerida: "+getClasse(info.requisito_classe)
							))
						:("")
				)
				.append(
					(info.quant)?
						($("<DIV>")
							.addClass("itn-quant")
							.html("Quantidade: "+info.quant))
						:("")
				)
				.append(
					(info.item_id)?
						($("<DIV>")
							.addClass("itn-descartar")
							.append(
								$("<A>")
									.attr(
										"href",
										"itnDescartar&tipo=0"+
										"&id="+info.item_id
									)
									.attr("question",'Quantos "'+info.nome+
										'" deseja descartar? (Máximo '+info.quant+')')
									.addClass("link_send_quant")
									.html("Descartar")
							))
						:($("<DIV>")
							.addClass("itn-descartar")
							.append(
								$("<A>")
									.attr(
										"href",
										"itnDescartar&tipo=1"+
										"&id="+info.equipamento_id+
										"&evolucao="+info.evolucao+
										"&slot_1="+info.slot_1+
										"&slot_2="+info.slot_2
									)
									.attr("question",'Deseja mesmo descartar "'+info.nome+'"?')
									.addClass("link_send_confirm")
									.html("Descartar")
							))
				)
		)
		.append(
			$("<DIV>")
				.addClass("clear")
		);
}
function getTipoEquipamento($tipo){
	if ($tipo==1)  return "Cabeça";
	else if ($tipo==2) return "Corpo";
	else if ($tipo==3) return "Pernas";
	else if ($tipo==4) return "Pés";
	else if ($tipo==5) return "Mãos";
	else if ($tipo==6) return "Capa";
	else if ($tipo==7) return "Arma de 1° mão";
	else if ($tipo==8) return "Arma de 2° mão";
	else return "";
}
function getTipoItem(tipo){
	if (tipo==0)  return "Acessório";
	else if (tipo==1) return "Comida";
	else if (tipo==2) return "Remédio";
	else if (tipo==3) return "Material";
	else if (tipo==4) return "Consumível";
	else if (tipo==5) return "Akuma";
	else return "";
}
function getEfeitoItem(item){
	var efeito = "";
	if (item.tipo==0){
		if(item.bonus_atk!=0)
			efeito += "Ataque +"+item.bonus_atk+"<br>";
		if(item.bonus_def!=0)
			efeito += "Defesa +"+item.bonus_def+"<br>";
		if(item.bonus_agl!=0)
			efeito += "Agilidade +"+item.bonus_agl+"<br>";
		if(item.bonus_pre!=0)
			efeito += "Precisão +"+item.bonus_pre+"<br>";
		if(item.bonus_res!=0)
			efeito += "Resistência +"+item.bonus_res+"<br>";
		if(item.bonus_des!=0)
			efeito += "Destreza +"+item.bonus_des+"<br>";
		if(item.bonus_per!=0)
			efeito += "Percepção +"+item.bonus_per+"<br>";
		if(item.bonus_vit!=0)
			efeito += "Vitalidade +"+item.bonus_vit+"<br>";
	}
	else if (item.tipo==1 || item.tipo==2){
		if(item.hp_recuperado!=0)
			efeito += "HP Recuperado: "+item.hp_recuperado+"<br>";
		if(item.mp_recuperado!=0)
			efeito += "Energia Recuperada: "+item.mp_recuperado+"<br>";
	}
	else if (item.tipo==3){
		efeito += "Este material pode ser usado para criação de outros itens.";
	}
	else if (item.tipo==4){
		efeito += item.descricao_efeito;
	}
	else if (item.tipo==5){
		efeito += '<a href="#">Comer</a>';
	}
	
	return efeito;
}
function getEfeitoEquipamento(item){
	if(item.tipo_efeito==0)
		tipo = "Dano: ";
	else
		tipo = "Armadura: ";
	
	return tipo+calculaEfeitoEquipamento(item);
}
function calculaEfeitoEquipamento(item){
	lvl = parseInt(item.lvl,10) + parseInt(item.evolucao,10);
	cat = parseInt(item.categoria,10) - 1;
	if (item.slot==7 || item.slot==2){
		d = 10*lvl + cat*lvl;
	}
	else if(item.slot == 8){
		d = 6*lvl + (cat*lvl)/2;
	}
	else{
		d = lvl + (cat*lvl/8);
	}
	d = parseInt(d,10);
	
	return d;
}
function getClasse($int){
	switch ($int) {
		case "1": return "Espadachim"; break;
		case "2": return "Lutador"; break;
		case "3": return "Atirador"; break;
		default: return "Nenhuma"; break;
	}
}
function getSlotAtributoNome($att){
	if($att == 0)
		return "Slot Vazio";
	
	return getAtributoNome($att)+" +1";
}
function getAtributoNome($att){
	switch ($att) {
		case "1": return "Ataque"; break;
		case "2": return "Defesa"; break;
		case "3": return "Agilidade"; break;
		case "4": return "Precisão"; break;
		case "5": return "Resistência"; break;
		case "6": return "Força"; break;
		case "7": return "Destreza"; break;
		case "8": return "Percepção"; break;
		case "9": return "Vitalidade"; break;
		default: return ""; break;
	}
}
function addToggleClick(e1,e2,tagClick,classClick){
	$(e1)
	.unbind("click")
	.on("click", function(){
		id = $(this).attr("id");
		e2Id = "#"+id+" "+e2;
		
		visible=false;
		if($(e2Id).css("display")=="block")
			visible=true;
		
		$(e2).css("display","none");
		
		$(e1+" "+tagClick).removeClass(classClick);
		
		if(!visible){
			$(e2Id).toggle();
			$("#"+id+" "+tagClick).addClass(classClick);
		}
	})
}
function addToggleClick2(e1,e2,classClick){
	$(e1)
	.unbind("click")
	.on("click", function(){
		id = $(this).attr("id");
		e2Id = "#"+id+" "+e2;
		
		visible=false;
		if($(e2Id).css("display")=="block")
			visible=true;
		
		$(e2).css("display","none");
		
		$(e1).removeClass(classClick);
		
		if(!visible){
			$(e2Id).toggle();

			$("#"+id).addClass(classClick);
		}
	})
}
function addToggleClickExterno(elem,classe,boxClass,boxClassAdd){
	$("."+elem)
		.die("click")
		.live("click",function(){
			$("."+elem).removeClass(classe);
			$(this).addClass(classe);
			$("."+boxClass).removeClass(boxClassAdd);
			box = "layer-"+$(this).attr("id");
			$("#"+box).addClass(boxClassAdd);
		});
}
//combate
function addClassInRange(personagem,cx,cy,alcance,target,classe,id,area){
	quadros = new Array();
	//percorre abaixo
	for(per = 1; per<alcance; per++){
		x = parseInt(cx,10) + per;
		y = cy;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		quadros.push(x+"_"+y);
	}
	//percorre acima
	for(per = -1; Math.abs(per)<alcance; per--){
		x = parseInt(cx,10) + per;
		y = cy;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		if(x<0 && y>=0 && y<=13) quadros.push("npc");
		if(x<0)break;
		quadros.push(x+"_"+y);
	}
	//percorre direita
	for(per = 1; per<alcance; per++){
		x = cx;
		y = parseInt(cy,10) + per;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		quadros.push(x+"_"+y);
	}
	//percorre esquerda
	for(per = -1; Math.abs(per)<alcance; per--){
		x = cx;
		y = parseInt(cy,10) + per;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		quadros.push(x+"_"+y);
	}
	
	//diag inf direita
	for(per = 1; per<alcance; per++){
		x = parseInt(cx,10) + per;
		y = parseInt(cy,10) + per;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		quadros.push(x+"_"+y);
	}
	//diag inf esquerda
	for(per = 1; per<alcance; per++){
		x = parseInt(cx,10) + per;
		y = parseInt(cy,10) - per;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		quadros.push(x+"_"+y);
	}
	//diag sup direita
	for(per = 1; per<alcance; per++){
		x = parseInt(cx,10) - per;
		y = parseInt(cy,10) + per;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		if(x<0 && y>=0 && y<=13) quadros.push("npc");
		if(x<0)break;
		quadros.push(x+"_"+y);
	}
	//diag sup esquerda
	for(per = 1; per<alcance; per++){
		x = parseInt(cx,10) - per;
		y = parseInt(cy,10) - per;
		if($("#quadro-"+x+"_"+y).hasClass("personagem")){
			if(target){
				quadros.push(x+"_"+y);
			}
			break;
		}
		if(x<0 && y>=0 && y<=13) quadros.push("npc");
		if(x<0)break;
		quadros.push(x+"_"+y);
	}
	
	$.each(quadros,function(key,value){
		if(value=="npc")
			$("#npc")
				.addClass(classe)
				.data("area",area-1)
				.data("habilidade_id",id)
				.data("personagem_id",personagem)
				.data("origem","quadro-"+cx+"_"+cy);
		else{
			$("#quadro-"+value)
				.addClass(classe)
				.data("area",area-1)
				.data("habilidade_id",id)
				.data("personagem_id",personagem)
				.data("origem","quadro-"+cx+"_"+cy);
			
			ind = parseInt($("#quadro-"+value).attr("x"),10);
			$("#quadro-"+value)
				.css("z-index",ind+2);
		}
	});
}

function getInfoHabilidade($hab,movimentos){
	//movimento
	if($hab.habilidade_id=="movimento"){
		$infoHabilidade = $("<DIV>")
							.append($("<DIV>").html("<b>"+$hab.nome+"</b>"))
							.append($("<DIV>").html($hab.descricao))
							.append($("<DIV>").html('Movimentos restantes: <span class="info-hab-mov-restante">'+movimentos+"</span>"));
	}
	//passiva
	else if($hab.tipo==0){
		
	}
	//ataque
	else if($hab.tipo==1){
		$infoHabilidade = $("<DIV>")
							.append($("<DIV>").html("<b>"+$hab.nome+"</b>"))
							.append($("<DIV>").html($hab.descricao))
							.append($("<DIV>").html("<b>Ataque</b>"))
							.append($("<DIV>").html("Dano: "+$hab.dano))
							.append($("<DIV>").html("Alcance: "+$hab.alcance+" quadro(s)"))
							.append($("<DIV>").html("Área: "+$hab.area+" quadro(s)"))
							.append($("<DIV>").html("Espera: "+$hab.espera+"("+$hab.esperaRestante+")"))
							.append($("<DIV>").html("Consumo: "+$hab.consumo));
	}
	//buff
	else{
		$infoHabilidade = $("<DIV>")
							.append($("<DIV>").html("<b>"+$hab.nome+"</b>"))
							.append($("<DIV>").html($hab.descricao))
							.append($("<DIV>").html("<b>Buff</b>"))
							.append($("<DIV>").html("Efeito: "+getAtributoNome($hab.bonus_attr)+" "+$hab.bonus_attr_quant))
							.append($("<DIV>").html("Duração: "+$hab.duracao+" turno(s)"))
							.append($("<DIV>").html("Alcance: "+$hab.alcance+" quadro(s)"))
							.append($("<DIV>").html("Área: "+$hab.area+" quadro(s)"))
							.append($("<DIV>").html("Espera: "+$hab.espera+"("+$hab.esperaRestante+")"))
							.append($("<DIV>").html("Consumo: "+$hab.consumo));
	}
	
	return $infoHabilidade;
}
jQuery.fn.single_double_click = function(single_click_callback, double_click_callback, timeout) {
  return this.each(function(){
    var clicks = 0, self = this;
    jQuery(this).click(function(event){
      clicks++;
      if (clicks == 1) {
        setTimeout(function(){
          if(clicks == 1) {
            single_click_callback.call(self, event);
          } else {
            double_click_callback.call(self, event);
          }
          clicks = 0;
        }, timeout || 300);
      }
    });
  });
}