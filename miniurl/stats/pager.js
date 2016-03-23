$(function(){
	var limit = 10;
	var offset = 0;
	var currentPage = 1;
	var currentTopPage = 10;
	var currentBottomPage = 1;
	var numberOfPagesToSlide = 5
	var showedPagesAtOnce = 10;
	
	var uid = $("#uid").val();

	$("#page-1").addClass('active');

	$("#pager_next").click(function(event){
		var filterCategory = $("#filterCategory").val();
		var from = offset + limit;
		if(currentPage == currentTopPage){
			console.log("Pager reached its maximum -- Charging the other divs");

			for(var i = currentPage;i<=currentPage+numberOfPagesToSlide;i++){
				var nextPage = i + 1;
				var nextPageLi = $("#page-"+nextPage);
				if(nextPageLi.length > 0){ //There is a next object
					var oppositeLi = $("#page-"+(nextPage-showedPagesAtOnce));
					if(oppositeLi.length > 0) oppositeLi.addClass('hidden');
					nextPageLi.removeClass('hidden');
				}
				else{//There isnt a next object
					console.log("No further pages");
					if(i == currentPage) return true;//There are no more pages from the current page
					break;
				}
			}
			//console.log("i = "+i+" -- "+(currentPage+numberOfPagesToSlide));
			currentTopPage = i;
			currentBottomPage = i - (showedPagesAtOnce - 1)

		}
		else{
			//console.log("current: "+currentPage+" --- currentMax: "+currentTopPage);
		}
		$.get("/stats/getLinks.php?filterCategory="+filterCategory+"&uid="+uid+"&from="+from+"&limit="+limit,function(data,success){
			if(success == 'success'){
				if(data != 'false'){
					$("#table-body").html(data);
					$("#pager_prev").parent().removeClass('disabled');
					offset = from;
					$("#page-"+currentPage).removeClass('active');
					currentPage++;
					$("#page-"+currentPage).addClass('active');
					/*if(currentPage == currentMaxPage){
						//TODO: The paginator should slide
						console.log("Pager reached its maximum");
					}*/
				}
				else{
					//$("#pager_next").parent().addClass('disabled');//This should be controlled/prevented in a different way
					//TODO:Invalid data was requested. This should throw an exception somehow
					console.log("Links request returned false: "+data);
				}
			}
			else{
				console.log(data+" --- "+success);
			}
		});
	});

	$("#pager_prev").click(function(event){
		var from = offset - limit;
		/////////////////////////////
		var filterCategory = $("#filterCategory").val();
		if(currentPage == currentBottomPage){
			console.log("Pager reached its minimum -- Charging previous divs");

			for(var i = currentPage;i>=currentPage-numberOfPagesToSlide;i--){
				var nextPage = i - 1;
				var nextPageLi = $("#page-"+nextPage);
				if(nextPageLi.length > 0){ //There is a next object
					var oppositeLi = $("#page-"+(nextPage+showedPagesAtOnce));
					if(oppositeLi.length > 0) oppositeLi.addClass('hidden');
					nextPageLi.removeClass('hidden');
				}
				else{//There isnt a next object
					console.log("No further pages");
					if(i == currentPage) return true;//There are no more pages from the current page
					break;
				}
			}
			//console.log("i = "+i+" -- "+(currentPage+numberOfPagesToSlide));
			currentBottomPage = i;
			currentTopPage = i + (showedPagesAtOnce - 1);

		}
		else{
			//console.log("current: "+currentPage+" --- currentMax: "+currentTopPage);
		}

		///////////////////////////
		$.get("/stats/getLinks.php?filterCategory="+filterCategory+"&uid="+uid+"&from="+from+"&limit="+limit,function(data,success){
			if(success == 'success'){
				if(data != 'false'){
					$("#table-body").html(data);
					$("#pager_next").parent().removeClass('disabled');
					offset = from;
					/*if(offset <= 0){
						$("#pager_prev").parent().addClass('disabled');
					}*/
					$("#page-"+currentPage).removeClass('active');
					currentPage--;
					$("#page-"+currentPage).addClass('active');
					if(currentPage<=1){
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

	$(".page-selector").click(function(event){
		//console.log("---> "+this.nodeName+" ////// "+event.target.nodeName+" +++++ "+this.attributes['offset']+' ****** '+$(this).attr('offset'));
		var filterCategory = $("#filterCategory").val();
		var offset_page = parseInt($(this).attr('offset'));
		var clickedPage = parseInt($(this).text());
		$.get("/stats/getLinks.php?filterCategory="+filterCategory+"&uid="+uid+"&from="+offset_page+"&limit="+limit,function(data,success){
			if(success == 'success'){
				if(data != 'false'){
					$("#table-body").html(data);
					//$("#pager_next").parent().removeClass('disabled');
					offset = offset_page;
					if(offset <= 0){
						$("#pager_prev").parent().addClass('disabled');
					}
					$("#page-"+currentPage).removeClass('active');
					//currentPage--;
					currentPage = clickedPage;
					$("#page-"+currentPage).addClass('active');
					if(currentPage == 1) $("#pager_prev").parent().addClass('disabled');
					else $("#pager_prev").parent().removeClass('disabled');

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
	
	$("#filterCategory").change(function(event){
		var filterCategory = $("#filterCategory").val();
		//console.log("---> "+this.nodeName+" ////// "+event.target.nodeName+" +++++ "+this.attributes['offset']+' ****** '+$(this).attr('offset'));
		var offset_page = 0;
		var clickedPage = parseInt($(this).text());
		$.get("/stats/getLinks.php?filterCategory="+filterCategory+"&uid="+uid+"&from="+offset_page+"&limit="+limit,function(data,success){
			if(success == 'success'){
				if(data != 'false'){
					$("#table-body").html(data);
					//$("#pager_next").parent().removeClass('disabled');
					offset = offset_page;
					if(offset <= 0){
						$("#pager_prev").parent().addClass('disabled');
					}
					$("#page-"+currentPage).removeClass('active');
					//currentPage--;
					currentPage = clickedPage;
					$("#page-"+currentPage).addClass('active');
					if(currentPage == 1) $("#pager_prev").parent().addClass('disabled');
					else $("#pager_prev").parent().removeClass('disabled');

				}
				else{
					$("#table-body").html("<td colspan='6'>You haven't any links with this category :=(</td>");
				}
			}
			else{
				console.log(data+" --- "+success);
			}
		});
		$.get("/class/Register.php?method=getLinkPaginations&filterCategory="+filterCategory+"&uid="+uid+"&from="+offset_page+"&limit="+limit,function(data,success){
			console.log('estoy en paginador');
				$('.row-paginator').empty();
				$('.row-paginator').html(data);
			
		});	
	});
});