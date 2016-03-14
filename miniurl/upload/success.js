$(document).ready(function(){
    //var mensaje = $('#successUpload').filter();
    var mensaje = $('#successUpload').text();
//alert("ON LOAD");
    //console.log('successUpload.text -->'+$("#successUpload").text());
        $('#successUpload').remove();
        //$('#errorSuccess').append(mensaje)
        $("#errorSuccess").text(mensaje);
    //console.log(mensaje);
});