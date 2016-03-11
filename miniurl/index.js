$(document).ready(function(){
	$("#alias").val("");
	$("#alias-group").removeClass("has-success has-error");
	$("#salvar").prop('disabled',true);
	$("#generar").prop('disabled',true);

	var MainForm = function(){
		this.keyProtocol = $("#protocolo").val();
		this.url = $("#url").val();
		this.alias = $("#alias").val();
		this.seLogea = $("#conLog").prop('checked');
		if(this.protocolo == '3'){ // The 'other' option is selected
			this.protTxt = $("#prot_propio").val(); //The input is taken from the text box
		}
		else{
			document.getElementById()
		}
	}

	enlaceMin.getValoresFromUI = function(){
		this.url = $("#url").val();
		this.alias = $("#alias").val();
		this.seLogea = $("#conLog").prop('checked');
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
	var cambiarUIpostHash = function(error, color, itCanBeGenerated, hashgen){
		var error = error || "";
		var color = color || "green";
		var itCanBeGenerated = itCanBeGenerated || true;
		var hashgen = hashgen || "";
		$("#error").html(error);
		$("#error").css('color',color);
		if(error.length>0){
			$("#error").removeClass('hidden');
		}
		else{
			$("#error").addClass('hidden');
		}
		$("#generar").prop('disabled',!itCanBeGenerated);
	};

	var revisarAlias = function(){
		enlaceMin.getValoresFromUI();
		$("#alias-group").removeClass("has-error has-success");

		//Validamos la entrada
		if(!enlaceMin.esValidoAlias()){
			//The alias is short
			/*$("#error").html("Por lo menos 3 caracteres");
			$("#error").css('color','orange');*/
			cambiarUIpostHash("At least 3 characters",'orange');
			$("#salvar").prop('disabled',true);
		}
		//Validamos la existencia en BD
		else{
			/*$("#error").html("");
			$("#error").css('color','black');*/
			cambiarUIpostHash("");
			$("#salvar").prop('disabled',false);

			$.getJSON("chkAlias.php", {'alias': enlaceMin.alias}, function(response){
				if(response.existe){
					//The alias exists.
					$("#alias-group").addClass('has-error');
					$("#salvar").prop('disabled',true);
					enlaceMin.valido = false;
				}
				else{
					//The alias does not exist
					$("#salvar").prop('disabled',false);
					enlaceMin.alias = response.alias_revisado;
					enlaceMin.valido = true;
					$("#alias-group").addClass('has-success');
				}
			});
		}
	};

	/*** Event handlers ***/

	$("#generar").click(function(){
		generarHash();
	});
	$("#url").on("input",function(evento){
		enlaceMin.getValoresFromUI();
		if(!enlaceMin.esValidaDireccion()){
			$("#alias").val("");
			enlaceMin.valido = false;
			cambiarUIpostHash("The address must have at least 8 characters",'orange',false);
		}
		else {
			cambiarUIpostHash();
		}

		//The next lines are used to enforce the use of the "Generate" button
		//TODO: the workflow needs to be checked for the necessity of this.
		$("#alias").val("");
		$("#alias-group").removeClass("has-success has-error");
		$("#salvar").prop('disabled',true);
	});

	$("#protocolo").on("change",function(evento){
		var cve_prot = $(this).val();
		var selectedOption = $("#protocolo option:selected")[0];
		//console.log(selectedOption.innerHTML+' --- '+selectedOption.value);
		var txt_prot = selectedOption.innerHTML;
		//console.log(' --- '+txt_prot)
		if(cve_prot =='3'){
			$("#prot_propio").removeClass('hidden');
		}
		else{
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
			//TODO: In theory, if the button is enabled, the input is valid. But an exception could be handled here.
		}
	});

	
	$("#sameUrl").change(function(){
		if($("#sameUrl").prop('checked') ){
			$('#sameUrlBox').show();
		}else{
			$('#sameUrlBox').hide();
		}
		
	});

	$('#rangeIds').change(function(){
		if($("#rangeIds").prop('checked') ){
			$('#rangeBox').show();
		}else{
			$('#rangeBox').hide();
		}
	});

	$('#fileToUpload').change(function(e){
		$('#upload1').removeAttr('disabled');
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