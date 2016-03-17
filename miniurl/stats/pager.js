$(function(){
	//
	var limit = 10;
	var offset = 0;

	var uid = $("#uid").val();

	$("#pager_next").click(function(event){
		var from = offset + limit;
		$.get("/stats/getLinks.php?uid="+uid+"&from="+from+"&limit="+limit,function(data,success){
			if(success == 'success'){
				if(data != 'false'){
					$("#table-body").html(data);
					$("#pager_prev").parent().removeClass('disabled');
					offset = from;
				}
				else{
					$("#pager_next").parent().addClass('disabled');//This should be controlled/prevented in a different way
				}
			}
			else{
				console.log(data+" --- "+success);
			}
		});
	});

	$("#pager_prev").click(function(event){
		var from = offset - limit;
		$.get("/stats/getLinks.php?uid="+uid+"&from="+from+"&limit="+limit,function(data,success){
			if(success == 'success'){
				if(data != 'false'){
					$("#table-body").html(data);
					$("#pager_next").parent().removeClass('disabled');
					offset = from;
					if(offset <= 0){
						$("#pager_prev").parent().addClass('disabled');
					}
				}
				else{
					//NOP for the time being
				}
			}
			else{
				console.log(data+" --- "+success);
			}
		});
	});
});