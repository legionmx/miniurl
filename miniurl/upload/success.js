$(document).ready(function(){
    //var mensaje = $('#successUpload').filter();
    var mensaje = $('#successUpload').text();
    var numberRead= $('#readSms').text();
//alert("ON LOAD");
    //console.log('successUpload.text -->'+$("#successUpload").text());
        $('#successUpload').remove();
        $('#readSms').remove();
        //$('#errorSuccess').append(mensaje)
        $("#errorSuccess").text(mensaje+numberRead);
    //console.log(mensaje);
});