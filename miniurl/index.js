$(document).ready(function(){
	var generarHash = function(){
		var prot = $("#protocolo").val();
		var uerele = $("#url").val();
		//if($("#conLog").prop('checked')) alert("Se logeara");
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
		//alert("Statgefunden Input");
		generarHash();
	});
	$("#protocolo").on("change",function(evento){
		//alert("Statgefunden Select Change");
		generarHash();
	});
});

var ultimoHash = "";