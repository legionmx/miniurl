$(document).ready(function(){
	$("#alias").val("");
	$("#alias-group").removeClass("has-success has-error");
	$("#salvar").prop('disabled',true);
	$("#generar").prop('disabled',true);

	enlaceMin.getValoresFromUI = function(){
		this.url = $("#url").val();
		this.alias = $("#alias").val();
		this.seLogea = $("#conLog").prop('checked')
		this.protocolo = $("#protocolo").val();
		if(this.protocolo == '3'){ //Hay que obtener el txt del input
			this.protTxt = $("#prot_propio").val();
		}
		else{ //Se obtiene el txt del select
			document.getElementById("protocolo").options[($("#protocolo").val())-1].text;
		}
	};

	enlaceMin.esValidaDireccion = function(){
		return this.url.length >= 8;
	};
	enlaceMin.esValidoAlias = function(){
		return this.alias.length >= 3;
	};

	var generarHash = function(){
		enlaceMin.getValoresFromUI();
		//if($("#conLog").prop('checked')) alert("Se logeara --"+ $("#conLog").prop('checked'));
		//else alert("NO se logeara --"+ $("#conLog").prop('checked'));
		if(!enlaceMin.esValidaDireccion()){
			//$("#alias").val("");
			enlaceMin.valido = false;
			$("#alias-group").removeClass("has-success has-error");
			cambiarUIpostHash("Debe ser una direcci&oacute;n de al menos 8 caracteres",'orange',false);
		}
		else{
			$.getJSON("getHash.php",{"protocolo": enlaceMin.protocolo, "protTxt": enlaceMin.protTxt, "url": enlaceMin.url},function(response){
				$("#alias-group").removeClass("has-success has-error");
				if((response.existe==true)||enlaceMin.url.length<8){ //TODO: Revisar la 2a parte de la condicion
					cambiarUIpostHash("La URL ya ha sido minimizada",'red',false,response.hash);
					//$("#alias").val="";
					$("#alias").val(response.hash);
					enlaceMin.valido = false;
					$("#alias-group").addClass('has-error');
				}
				else{
					cambiarUIpostHash("",'green',true,response.hash);
					ultimoHash = response.hash;
					$("#alias").val(ultimoHash);
					$("#salvar").prop('disabled',false);
					enlaceMin.alias = response.hash;
					enlaceMin.valido = true;
					$("#alias-group").addClass('has-success');
				}
			});
		}
		
	};

	//var cambiarUIpostHash = function(error = "", color = "green", sePuedeGenerar = true, hashgen = ""){
	var cambiarUIpostHash = function(error, color, sePuedeGenerar, hashgen){
		var error = error || "";
		var color = color || "green";
		var sePuedeGenerar = sePuedeGenerar || true;
		var hashgen = hashgen || "";
		$("#error").html(error);
		$("#error").css('color',color);
		$("#generar").prop('disabled',!sePuedeGenerar);
		//$("#hashgen").html(hashgen);
		//$("#hashgen").css('color',color);
	};

	var revisarAlias = function(){
		enlaceMin.getValoresFromUI();
		$("#alias-group").removeClass("has-error has-success");

		//Validamos la entrada
		if(!enlaceMin.esValidoAlias()){
			//El alias es muy muy corto
			//alert("Alias muy muy corto");
			$("#error").html("Por lo menos 3 caracteres");
			$("#error").css('color','orange');
			$("#salvar").prop('disabled',true);
		}
		//Validamos la existencia en BD
		else{
			$("#error").html("");
			$("#error").css('color','black');
			$("#salvar").prop('disabled',false);

			$.getJSON("chkAlias.php", {'alias': enlaceMin.alias}, function(response){
				if(response.existe){
					//console.log("El alias existe");
					$("#alias-group").addClass('has-error');
					$("#salvar").prop('disabled',true);
					enlaceMin.valido = false;
				}
				else{
					//console.log("El alias NO existe");
					$("#salvar").prop('disabled',false);
					enlaceMin.alias = response.alias_revisado;
					enlaceMin.valido = true;
					$("#alias-group").addClass('has-success');
				}
			});
		}
	};

	/*** Handlers de eventos ***/

	$("#generar").click(function(){ //Insertamos el link minimizado
		generarHash();
	});
	$("#url").on("input",function(evento){
		enlaceMin.getValoresFromUI();
		if(!enlaceMin.esValidaDireccion()){
			//console.log("NO");
			$("#alias").val("");
			enlaceMin.valido = false;
			cambiarUIpostHash("Debe ser una direcci&oacute;n de al menos 8 caracteres",'orange',false);
		}
		else {
			//console.log("SI!!!");
			cambiarUIpostHash();
		}

		//Las siguientes lineas son para obligar a usar el button "Generar"
		$("#alias").val("");
		$("#alias-group").removeClass("has-success has-error");
		$("#salvar").prop('disabled',true);
	});

	$("#protocolo").on("change",function(evento){
		//generarHash();
		var cve_prot = $(this).val();
		var txt_prot = document.getElementById("protocolo").options[($(this).val())-1].text;
		//console.log(cve_prot+" --> "+txt_prot);
		if(cve_prot =='3'){
			//console.log('El usuario ha elegido OTRO protocolo');
			$("#prot_propio").removeClass('hidden');
		}
		else{
			//console.log('Prot: '+$(this).val());
			$("#prot_propio").addClass('hidden');
			$("#prot_propio").val('');
		}
	});

	$("#alias").on("input",function(evento){
		revisarAlias();
	});

	$("#salvar").click(function(){
		if(enlaceMin.valido){
			enlaceMin.getValoresFromUI();
			$.getJSON("crtEnlace.php",enlaceMin,function(response){
				cambiarUIpostHash(response.status,'blue',false,response.alias);
				$("#salvar").prop('disabled',true);
				$("#generar").prop('disabled',true);
			});
		}
		else{
			//TODO: Teoricamente si esta enabled el button, la entrada es valida. Pero hay q revisarlo.
		}
	});
});

var ultimoHash = "";
var enlaceMin = {
	protocolo: 1,
	protTxt: "HTTP",
	url: "",
	alias: "",
	existe: false,
	valido: false,
	seLogea: false
};