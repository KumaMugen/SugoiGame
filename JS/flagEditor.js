bandeira = {
	C   : {1 : "04", 2 : "01", 3 : "01"},
	CM  : 32,
	CX  : {1 : "+000", 2 : "+000", 3 : "+000"},
	CY  : {1 : "+000", 2 : "+000", 3 : "+000"},
	CW  : {1 : "400", 2 : "400", 3 : "400"},
	CH  : {1 : "274", 2 : "274", 3 : "274"},
	CC  : {
		1 : {1 : "ffffff", 2 : "ffffff", 3 : "ffffff"},
		2 : {1 : "000000", 2 : "000000", 3 : "000000"},
		3 : {1 : "ff0000", 2 : "ff0000", 3 : "ff0000"}
		},
	
	F   : 1
};
function FlagEditor(){
	//declaraçao de propriedades
	this.load = load;
	this.codBandeira = codBandeira;
	this.atualizaBandeira = atualizaBandeira;
	this.layerEditorColor = layerEditorColor;
	this.layerEditorPos = layerEditorPos;
	this.formatParam = formatParam;
	this.layerEditorImg = layerEditorImg;
	
	//funcoes
	function load(fac){
		if(document.getElementById("flag-editor") == null)
			return;
		
		bandeira.F = fac;
		if(fac==1)
			bandeira.CM = 33;
		else{
			bandeira.CM = 13;
			bandeira.C[1] = "07";
		}
		
		editor = $("#flag-editor");
		editor.html("");
		
		flagContainer = $("<DIV>").attr("id","flag-container").css('background',"url(Imagens/carregando.gif) no-repeat center")
		.append($("<IMG>").attr("id","flag").attr('src',"Imagens/carregando.gif"));
		
		editor.append(flagContainer);
		
		menuContainer = $("<DIV>").attr("id","menu-container");
		editor.append(menuContainer);
		
		menuContainer.append($("<DIV>").attr("id","layer-select"));
		select = $("#layer-select");
		
		layer1=$("<DIV>").attr("id","layer-1").css("display","block").addClass('layer');
		menuContainer.append(layer1);
		layer1.append($("<DIV>").attr("id","layer-1-posicoes"))
			.append($("<DIV>").attr("id","layer-1-colors"));
		
		layer2=$("<DIV>").attr("id","layer-2").css("display","none").addClass('layer');
		menuContainer.append(layer2);
		layer2.append($("<DIV>").attr("id","layer-2-posicoes"))
			.append($("<DIV>").attr("id","layer-2-colors"));
		
		layer3=$("<DIV>").attr("id","layer-3").css("display","none").addClass('layer');
		menuContainer.append(layer3);
		layer3.append($("<DIV>").attr("id","layer-3-posicoes"))
			.append($("<DIV>").attr("id","layer-3-colors"));
		
		for(x=1;x<=3;x++){
			this.layerEditorColor($("#layer-1-colors"),1,x);
			this.layerEditorColor($("#layer-2-colors"),2,x);
			this.layerEditorColor($("#layer-3-colors"),3,x);
			
			this.layerEditorImg($("#layer-"+x+"-posicoes"),x,bandeira.C[x]);
		}
		
		for(x=1;x<=3;x++){
			this.layerEditorPos($("#layer-"+x+"-posicoes"),x,"x");
			this.layerEditorPos($("#layer-"+x+"-posicoes"),x,"y");
			this.layerEditorPos($("#layer-"+x+"-posicoes"),x,"w");
			this.layerEditorPos($("#layer-"+x+"-posicoes"),x,"h");
		}
		select.append($("<IMG>").attr("src","Imagens/ColorPicker/camada_1.png").addClass("layer-select-img").data("id",0));
		select.append($("<IMG>").attr("src","Imagens/ColorPicker/camada_2.png").addClass("layer-select-img").data("id",1));
		select.append($("<IMG>").attr("src","Imagens/ColorPicker/camada_3.png").addClass("layer-select-img").data("id",2));
		
		$(".layer-select-img").on("click",function(){
			i = $(this).data("id");
			$(".layer").fadeOut(0);
			$("#layer-"+(i+1)).fadeIn(200);
			$("#layer-select").animate({
				'background-position-x': (48+(i*30+i*5))+"px"
			},100,'linear');
		});
		
		this.atualizaBandeira();
	}
	function codBandeira(bandeira){
		cod = "f="+bandeira.F+"&cod=";
		
		for(x=1;x<=3;x++)
			cod += bandeira.C[x]+bandeira.CX[x]+bandeira.CY[x]+bandeira.CW[x]+bandeira.CH[x];
		
		for(x=1;x<=3;x++)
			cod +="&cor"+x+"1="+bandeira.CC[1][x]+"&cor"+x+"2="+bandeira.CC[2][x]+"&cor"+x+"3="+bandeira.CC[3][x];
			
		return cod;
	}
	function atualizaBandeira(){
		defaultFlag = this.codBandeira(bandeira);
		$("#flag").css("opacity","0.5").attr('src',"Imagens/Bandeiras/img.php?"+defaultFlag).load(function(){$(this).css("opacity","1")});
	}
	function layerEditorColor(layer,id,x){
		if(x==1)cor="ffffff";
		else if(x==2)cor="000000";
		else cor="ff0000";
		layer.append(
			$("<DIV>")
			 .attr("id","color-"+x+"-"+id)
			 .addClass("color-editor")
			 .css("width","36px")
			 .css("height","36px")
			 .css("background-color","#"+cor)
			 .append(
				$("<DIV>")
				 .attr("id","color-"+x+"-"+id+"-sub")
				 .css("width","36px")
				 .css("height","36px")
				 .css("background-image","url(Imagens/ColorPicker/select.png)")
				 .ColorPicker({
					color: cor,
					onShow: showColorPicker,
					onHide: hideColorPicker,
					onSubmit: function(hsb, hex, rgb, el){
						lagEditor = new FlagEditor;
						bandeira.CC[x][id] = hex;
						$("#color-"+x+"-"+id).css("background-color","#"+hex);
						flagEditor.atualizaBandeira();
					}
				})
			 )
		);
	}
	function layerEditorPos(layer,x,tipo){
		layer.append(
			$("<DIV>")
			.attr("id","pos-"+tipo+"-"+x)
			.addClass("pos-editor")
			.append($("<DIV>").addClass("editor-label")
				.append((tipo=="x")?"Horizontal: ":(tipo=="y")?"Vertical: ":(tipo=="w")?"Largura: ":"Altura: ")
			)
			.append(
				$("<DIV>")
				.attr("id","pos-"+tipo+"-"+x+"-drag-content")
				.addClass("pos-editor-drag-content")
				.append(
					$("<DIV>")
					.attr("id","pos-"+tipo+"-"+x+"-drag")
					.addClass("pos-editor-drag")
					.css("left","100px")
					.draggable({ 
						axis: "x", 
						containment: "#pos-"+tipo+"-"+x+"-drag-content",
						drag: function(event, ui){
							if(tipo == "x")
								pos = (ui.position.left-100)*4;
							else if(tipo == "y")
								pos = (ui.position.left-100)*2;
							else if(tipo == "w")
								pos = ui.position.left;
							else
								pos = ui.position.left;
							$("#pos-"+tipo+"-"+x+"-input").attr("value",parseInt(pos,10));
						},
						stop: function(event, ui){
							if(tipo == "x")
								pos = (ui.position.left-100)*4;
							else if(tipo == "y")
								pos = (ui.position.left-100)*2;
							else if(tipo == "w")
								pos = (ui.position.left/100)*400;
							else
								pos = (ui.position.left/100)*274;
								
							lagEditor = new FlagEditor;
							if(tipo == "x")
								bandeira.CX[x] = flagEditor.formatParam(pos,3,true);
							else if(tipo == "y")
								bandeira.CY[x] = flagEditor.formatParam(pos,3,true);
							else if(tipo == "w")
								bandeira.CW[x] = flagEditor.formatParam(pos,3,false);
							else
								bandeira.CH[x] = flagEditor.formatParam(pos,3,false);
							flagEditor.atualizaBandeira();
						}
					})
				)
			)
			.append(
				$("<INPUT>")
				.attr("id","pos-"+tipo+"-"+x+"-input")
				.attr("value",(tipo=="x"||tipo=="y")?0:100)
				.on("blur",function(){
					if(tipo == "x" || tipo =="y")
		 				pos = this.value;
					else if(tipo == "w")
						pos = (this.value/100)*400;
					else
						pos = (this.value/100)*274;
						
		 			lagEditor = new FlagEditor;
		 			if(tipo == "x")
						bandeira.CX[x] = flagEditor.formatParam(pos,3,true);
					else if(tipo == "y")
						bandeira.CY[x] = flagEditor.formatParam(pos,3,true);
					else if(tipo == "w")
						bandeira.CW[x] = flagEditor.formatParam(pos,3,false);
					else
						bandeira.CH[x] = flagEditor.formatParam(pos,3,false);
					flagEditor.atualizaBandeira();
					
					if(tipo == "x")
						pos = (pos/4)+100;
					else if(tipo == "y")
						pos = (pos/2)+100;
					else if(tipo == "w")
						pos = (pos/400)*100;
					else
						pos = (pos/274)*100;
					if(pos>200)pos=200;
					if(pos<0)pos=0;
					$("#pos-"+tipo+"-"+x+"-drag").css("left",pos)
				})
			)
			.append((tipo=="w" || tipo=="h")?"%":"")
		);
		
	}
	function layerEditorImg(layer,x,i){
		layer.
		append($("<DIV>").addClass("editor-label")
			.append("Imagem: ")
		)
		.append(
			$("<DIV>")
			.attr("id","select-img-"+x)
			.addClass("select-img")
			.append(
				$("<DIV>")
				.addClass("select-arrow")
				.append("<")
				.on("click",function(){
					lagEditor = new FlagEditor;
					pos = (parseInt(bandeira.C[x],10)-1);
					
					if(pos<1)pos=bandeira.CM;
					
					pos = flagEditor.formatParam(pos,2,false)
					bandeira.C[x] = pos;
					flagEditor.atualizaBandeira();
					
					$("#select-img-"+x+"-input").attr("value",pos);
				})
			)
			.append(
				$("<INPUT>")
				.attr("id","select-img-"+x+"-input")
				.attr("value",i)
				.on("blur",function(){
					lagEditor = new FlagEditor;
					pos = this.value;
					
					if(pos<1)pos=1;
					if(pos>bandeira.CM)pos = bandeira.CM;
					
					pos = flagEditor.formatParam(pos,2,false)
					this.value = pos;
					bandeira.C[x] = pos;
					flagEditor.atualizaBandeira();
				})
			)
			.append(
				$("<DIV>")
				.addClass("select-arrow")
				.append(">")
				.on("click",function(){
					lagEditor = new FlagEditor;
					pos = (parseInt(bandeira.C[x],10)+1);
					
					if(pos>bandeira.CM)pos = 1;
					
					pos = flagEditor.formatParam(pos,2,false)
					bandeira.C[x] = pos;
					flagEditor.atualizaBandeira();
					
					$("#select-img-"+x+"-input").attr("value",pos);
				})
			)
		);
	}
	function formatParam(value,quant,op){
		if(value.length==0)value=0;
		
		if(op && value>=0) add = "+";
		else if(op) add = "-";
		else add="";
		
		value = Math.abs(parseInt(value,10)).toString();
		if(value.length<quant){
			dif = quant-value.length;
			for(x=0;x<dif;x++)
				value = "0"+value;
		}
		else if(value.length>quant){
			value = "";
			for(x=0;x<quant;x++)
				value = "0"+value;
		}
		
		value = add+value;
		return value;
	}
}
function showColorPicker(colpkr){
	$(colpkr).fadeIn(500);
	return false;
}
function hideColorPicker(colpkr){
	$(colpkr).fadeOut(500);
	return false;
}
