$(document).ready(function(){
	$("#alias").val("");
	$("#alias-group").removeClass("has-success has-error");
	$("#salvar").prop('disabled',true);
	$("#generar").prop('disabled',true);

	var LnkCool = function(){
		/*this.keyProtocol = $("#protocolo").val();
		this.url = $("#url").val();
		this.alias = $("#alias").val();
		this.seLogea = $("#conLog").prop('checked');
		if(this.protocolo == '3'){ // The 'other' option is selected
			this.protTxt = $("#prot_propio").val(); //The input is taken from the text box
		}
		else{
			//document.getElementById();
			var selectedOption = $("#protocolo option:selected")[0];
			this.protTxt = selectedOption.innerHTML;
		}*/
		this.getValuesFromUI = function(){
			this.keyProtocol = $("#protocolo").val();
			this.url = $("#url").val();
			this.alias = $("#alias").val();
			this.isTracked = $("#conLog").prop('checked');
			this.exists = false;
			this.isValid = false;
			if(this.keyProtocol == '3'){ // The 'other' option is selected
				this.protocol = $("#prot_propio").val(); //The input is taken from the text box
			}
			else{
				//document.getElementById();
				var selectedOption = $("#protocolo option:selected")[0];
				this.protocol = selectedOption.innerHTML;
			}
		};
		this.hasValidAddress = function(){
			console.log(this.url.length);
			return this.url.length >= 8;
		};
		this.hasValidAlias = function(){
			return this.alias.length >= 3;
		}
		this.getValuesFromUI();
	};

	/*enlaceMin.getValoresFromUI = function(){
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
	};*/

	var newLink = new LnkCool();

	var generarHash = function(){
		//enlaceMin.getValoresFromUI();
		newLink.getValuesFromUI(); //TODO an on access refreseh would be better
		//if(!enlaceMin.esValidaDireccion()){
		console.log(newLink);
		if(!newLink.hasValidAddress()){
			//This path shouldn't ocurr. The input validates it on change.
			//enlaceMin.valido = false;
			newLink.isValid = false;
			$("#alias-group").removeClass("has-success has-error");
			cambiarUIpostHash("#####The address must have at least 8 characters",'orange',false);
		}
		else{
			$.getJSON("getHash.php",{"protocolo": newLink.keyProtocol, "protTxt": newLink.protocol, "url": newLink.url},function(response){
				$("#alias-group").removeClass("has-success has-error");
				if((response.existe==true)||newLink.url.length<8){ //TODO: Check if the second clause of the condition is needed
					//cambiarUIpostHash("The URL has already been minimized",'red',false,response.hash);
					cambiarUIpostHash("The URL has already been minimized",'red',false);
					$("#alias").val(response.hash);
					//enlaceMin.valido = false;
					newLink.isValid = false;
					$("#alias-group").addClass('has-error');
				}
				else{
					cambiarUIpostHash("",'green',true,response.hash);
					ultimoHash = response.hash;
					$("#alias").val(ultimoHash); //TODO: the 'ultimoHash' schema should be deprecated
					$("#salvar").prop('disabled',false);
					newLink.alias = response.hash;
					newLink.isValid = true;
					$("#alias-group").addClass('has-success');
				}
			});
		}
		
	};

	//var cambiarUIpostHash = function(error = "", color = "green", sePuedeGenerar = true, hashgen = ""){
	//var cambiarUIpostHash = function(error, color, itCanBeGenerated, hashgen){
	var cambiarUIpostHash = function(error, color, itCanBeGenerated){
		var error = error || "";
		var color = color || "green";
		//var itCanBeGenerated = itCanBeGenerated || true;
		if(typeof itCanBeGenerated === "undefined"){
			var itCanBeGenerated = true;
		}
		else{
			var itCanBeGenerated = itCanBeGenerated;
		}
		//var itCanBeGenerated = itCanBeGenerated || true;
		//var hashgen = hashgen || "";
		$("#error").html(error);
		$("#error").css('color',color);
		if(error.length>0){
			$("#error").removeClass('hidden');
		}
		else{
			$("#error").addClass('hidden');
			$("#success-row").addClass('hidden');
		}
		$("#generar").prop('disabled',!itCanBeGenerated);
	};

	var checkAlias = function(){
		newLink.getValuesFromUI();
		$("#alias-group").removeClass("has-error has-success");

		//Input validation
		if(!newLink.hasValidAlias()){
			//The alias is short
			/*$("#error").html("Por lo menos 3 caracteres");
			$("#error").css('color','orange');*/
			cambiarUIpostHash("At least 3 characters",'orange');
			$("#salvar").prop('disabled',true);
		}
		//Persisted alias validation
		else{
			cambiarUIpostHash("");
			$("#salvar").prop('disabled',false);

			$.getJSON("chkAlias.php", {'alias': newLink.alias}, function(response){
				if(response.existe){
					//The alias exists.
					$("#alias-group").addClass('has-error');
					$("#salvar").prop('disabled',true);
					newLink.isValid = false;
				}
				else{
					//The alias doesn't exist
					$("#salvar").prop('disabled',false);
					newLink.alias = response.alias_revisado;
					newLink.isValid = true;
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
		newLink.getValuesFromUI();
		//console.log(newLink);
		if(!newLink.hasValidAddress()){
			$("#alias").val("");
			newLink.isValid = false;
			cambiarUIpostHash("--The address must have at least 8 characters",'orange',false);
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
		if(cve_prot =='3'){
			$("#prot_propio").removeClass('hidden');
		}
		else{
			$("#prot_propio").addClass('hidden');
			$("#prot_propio").val('');
		}
	});

	$("#alias").on("input",function(evento){
		checkAlias();
	});

	$("#salvar").click(function(){
		if(newLink.isValid){
			newLink.getValuesFromUI();
			//$.getJSON("crtEnlace.php",enlaceMin,function(response){
			$.getJSON("crtEnlace.php",newLink,function(response){
				//cambiarUIpostHash(response.status,'blue',false,response.alias);
				//cambiarUIpostHash(response.status,'blue',false);
				//cambiarUIpostHash("The Cool Link was saved: ",'blue',false);
				cambiarUIpostHash("",'blue',false);
				//$("#alias-success").val(response.status);
				$("#alias-success").text(response.status);
				$("#alias-success").prop('href','http://'+response.status);
				$("#success-row").removeClass('hidden');
				$("#salvar").prop('disabled',true);
				$("#generar").prop('disabled',true);
			});
		}
		else{
			//TODO: In theory, if the button is enabled, the input is valid. But an exception could be handled here.
		}
	});

	$("#copy-link-btn").click(function(){
		copyToClipboard($("#alias-success").text());
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
	protocolo: 1, //keyProtocol
	protTxt: "HTTP", //protocol
	url: "",
	alias: "",
	existe: false, //exists
	valido: false, //isValid
	seLogea: false //isTracked
};

var copyToClipboard = function(link){
	var textArea = document.createElement("textarea");
	textArea.value = link;
	document.body.appendChild(textArea);
	textArea.select();
	try{
		var copied = document.execCommand('copy');
		var status = copied ? 'copied' : 'not copied';
		console.log("The link was "+status);
	}catch (err){
		console.log("The browser was unable to copy the link");
	}

	document.body.removeChild(textArea);
}