$(document).ready(function(){
	$("#alias").val("");
	$("#alias-group").removeClass("has-success has-error");
	$("#salvar").prop('disabled',true);
	$("#generar").prop('disabled',true);

	enlaceMin.getValoresFromUI = function(){
		this.url = $("#url").val();
		this.alias = $("#alias").val();
		this.seLogea = $("#conLog").prop('checked')
		if(typeof this.seLogea === "undefined") this.seLogea = false;
		this.protocolo = $("#protocolo").val();
		if(this.protocolo == '3'){ //The protocol is obtained from the text input
			this.protTxt = $("#prot_propio").val();
		}
		else{ //The protocol is obtained from the select
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
		if(!enlaceMin.esValidaDireccion()){
			enlaceMin.valido = false;
			$("#alias-group").removeClass("has-success has-error");
			cambiarUIpostHash("The URL should be at least 8 characters",'orange',false);
		}
		else{
			//$.getJSON("getAlias.php",{"protocolo": enlaceMin.protocolo, "protTxt": enlaceMin.protTxt, "url": enlaceMin.url},function(response){
			$.getJSON("getAlias.php",{"protocol": enlaceMin.protocolo, "url": enlaceMin.url},function(response){
				$("#alias-group").removeClass("has-success has-error");
				if((response.exists==true)||enlaceMin.url.length<8){ //TODO: Review the second part of the condition
					cambiarUIpostHash("La URL ya ha sido minimizada",'red',false,response.alias);
					$("#alias").val(response.alias);
					enlaceMin.valido = false;
					$("#alias-group").addClass('has-error');
				}
				else{
					cambiarUIpostHash("",'green',true,response.alias);
					ultimoHash = response.alias;
					$("#alias").val(ultimoHash);
					$("#salvar").prop('disabled',false);
					enlaceMin.alias = response.alias;
					enlaceMin.valido = true;
					$("#alias-group").addClass('has-success');
				}
			});
		}
		
	};

	//var cambiarUIpostHash = function(error = "", color = "green", sePuedeGenerar = true, hashgen = ""){
	var cambiarUIpostHash = function(error, color, sePuedeGenerar){
		var error = error || "";
		var color = color || "green";
		var sePuedeGenerar = sePuedeGenerar || true;
		$("#error").html(error);
		$("#error").css('color',color);
		$("#generar").prop('disabled',!sePuedeGenerar);
	};

	var revisarAlias = function(){
		enlaceMin.getValoresFromUI();
		$("#alias-group").removeClass("has-error has-success");

		//Validations
		if(!enlaceMin.esValidoAlias()){
			//The alias is too short
			$("#error").html("Por lo menos 3 caracteres");
			$("#error").css('color','orange');
			$("#salvar").prop('disabled',true);
		}
		else{
			//Check if the it already exists in DB
			$("#error").html("");
			$("#error").css('color','black');
			$("#salvar").prop('disabled',false);

			$.getJSON("chkAlias.php", {'alias': enlaceMin.alias}, function(response){
				if(response.exists){
					$("#alias-group").addClass('has-error');
					$("#salvar").prop('disabled',true);
					enlaceMin.valido = false;
				}
				else{
					$("#salvar").prop('disabled',false);
					enlaceMin.alias = response.alias_revisado;
					enlaceMin.valido = true;
					$("#alias-group").addClass('has-success');
				}
			});
		}
	};

	/*** Event handlers ***/

	$("#generar").click(function(){ //We generate a hash
		generarHash();
	});

	$("#url").on("input",function(evento){
		enlaceMin.getValoresFromUI();
		if(!enlaceMin.esValidaDireccion()){
			$("#alias").val("");
			enlaceMin.valido = false;
			cambiarUIpostHash("The URL should be at least 8 characters",'orange',false);
		}
		else {
			cambiarUIpostHash();
		}

		//The following lines are to force the user to use the "Generate" button
		$("#alias").val("");
		$("#alias-group").removeClass("has-success has-error");
		$("#salvar").prop('disabled',true);
	});

	//It triggers the field for protocol input, if needed
	$("#protocolo").on("change",function(evento){
		//generarHash();
		var cve_prot = $(this).val();
		var txt_prot = document.getElementById("protocolo").options[($(this).val())-1].text;
		if(cve_prot =='3'){ //Another protocol will be selected
			$("#prot_propio").removeClass('hidden');
		}
		else{
			$("#prot_propio").addClass('hidden');
			$("#prot_propio").val('');
		}
	});

	//Validation of the currently input alias
	$("#alias").on("input",function(evento){
		revisarAlias();
	});

	//Checks if the cool link is valid, and persists it if so
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
			//TODO: In theory, if the button is enabled (clickable), the input is valid. But one should validate it.
		}
	});
});

var ultimoHash = ""; //This is a leftover string, left for compatibility. It should be eliminated
var enlaceMin = {
	protocolo: 1,
	protTxt: "HTTP",
	url: "",
	alias: "",
	existe: false,
	valido: false,
	seLogea: false
};