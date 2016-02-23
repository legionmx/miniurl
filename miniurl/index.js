$(document).ready(function(){
	var generarHash = function(){
		var prot = $("#protocolo").val();
		var uerele = $("#url").val();
		//if($("#conLog").prop('checked')) alert("Se logeara --"+ $("#conLog").prop('checked'));
		//else alert("NO se logeara --"+ $("#conLog").prop('checked'));
		if(uerele.length<8){
			cambiarUIpostHash("Debe ser una direcci&oacute; de al menos 8 caracteres",'orange',false);
		}
		else{
			$.getJSON("getHash.php",{"protocolo": prot, "url": uerele},function(response){
				if((response.existe==true)||uerele.length<8){
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
		//Obtenemos valores a enviar
		var prot = $("#protocolo").val();
		var uerele = $("#url").val();
		var alias = $("#alias").val();

		//Validamos la entrada
		if(alias.length<3){
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
			//$("#salvar").removeClass("has-error has-success");
			$("#alias-group").removeClass("has-error has-success");

			$.getJSON("chkAlias.php", {'alias': alias}, function(response){
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

	$("#generar").click(function(){
		//Insertamos el link minimizado
		var prot = $("#protocolo").val();
		var uerele = $("#url").val();
		var seLogea = $("#conLog").prop('checked')
		$.getJSON("crtEnlace.php",{"hash": ultimoHash, "url": uerele, "protocolo" : prot, "seLogea": seLogea},function(response){
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