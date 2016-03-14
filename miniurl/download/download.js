$(document).ready(function(){
	$('#rangeIds').change(function(){
		if($("#rangeIds").prop('checked') ){
			$('#rangeBox').show();
		}else{
			$('#rangeBox').hide();
		}
	});
});