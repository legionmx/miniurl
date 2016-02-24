$(document).ready(function(){
	enlaceMin.getValoresFromUI = function(){
		this.protocolo = $("#protocolo").val();
		this.url = $("#url").val();
		this.alias = $("#alias").val();
		this.seLogea = $("#conLog").prop('checked')
	};

	enlaceMin.esValidaDireccion = function(){
		return this.url.length >= 8;
	};
	enlaceMin.esValidoAlias = function(){
		return this.alias.length >= 3;
	};

	var generarHash = function(){
		//var prot = $("#protocolo").val();
		//var uerele = $("#url").val();
		enlaceMin.getValoresFromUI();
		//if($("#conLog").prop('checked')) alert("Se logeara --"+ $("#conLog").prop('checked'));
		//else alert("NO se logeara --"+ $("#conLog").prop('checked'));
		if(!enlaceMin.esValidaDireccion()){
			cambiarUIpostHash("Debe ser una direcci&oacute; de al menos 8 caracteres",'orange',false);
		}
		else{
			$.getJSON("getHash.php",{"protocolo": enlaceMin.protocolo, "url": enlaceMin.url},function(response){
				if((response.existe==true)||enlaceMin.url.length<8){ //TODO: Revisar la 2a parte de la condicion
					cambiarUIpostHash("La URL ya ha sido minimizada",'red',false,response.hash);
				}
				else{
					cambiarUIpostHash("",'green',true,response.hash);
					ultimoHash = response.hash;
				}
			});
		}
		
	};

	var cambiarUIpostHash = function(error = "", color = "green", sePuedeGenerar = true, hashgen = ""){
		$("#error").html(error);
		$("#error").css('color',color);
		$("#generar").prop('disabled',!sePuedeGenerar);
		$("#hashgen").html(hashgen);
		$("#hashgen").css('color',color);
	};

	var salvarAlias = function(){
		enlaceMin.getValoresFromUI();

		//Validamos la entrada
		if(!enlaceMin.esValidoAlias()){
			//El alias es muy muy corto
			//alert("Alias muy muy corto");
			$("#error").html("Por lo menos 3 caracteres");
			$("#error").css('color','orange');
			$("#salvar").prop('disabled',true);
			//$("#salvar").removeClass();
		}
		else{
			//alert("El alias es de buen tamaño. Se comprobara existencia en BD");
			$("#error").html("");
			$("#error").css('color','black');
			$("#salvar").prop('disabled',false);
			$("#alias-group").removeClass("has-error has-success");

			$.getJSON("chkAlias.php", {'alias': enlaceMin.alias}, function(response){
				if(response.existe){
					//alert("El alias existe");
					$("#alias-group").addClass('has-error');
					$("#salvar").prop('disabled',true);
				}
				else{
					//alert("El alias NO existe");
					$("#alias-group").addClass('has-success');
					$("#salvar").prop('disabled',false);
				}
			});
		}
	};

	/*** Handlers de eventos ***/

	$("#generar").click(function(){ //Insertamos el link minimizado
		enlaceMin.getValoresFromUI();
		$.getJSON("crtEnlace.php",{"hash": ultimoHash, "url": enlaceMin.url, "protocolo" : enlaceMin.protocolo, "seLogea": enlaceMin.seLogea},function(response){
			//cambiarUIpostHash(response.status+" --- "+response.query,'blue',false,ultimoHash);
			cambiarUIpostHash(response.status,'blue',false,ultimoHash);
		});
	});
	$("#url").on("input",function(evento){
		generarHash();
	});
	$("#protocolo").on("change",function(evento){
		generarHash();
	});

	$("#alias").on("input",function(evento){
		salvarAlias();
	});
});

var ultimoHash = "";
var enlaceMin = {
	protocolo: 1,
	url: "",
	alias: "",
	existe: false,
	valido: false,
	seLogea: false
};