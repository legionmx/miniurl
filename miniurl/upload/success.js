$(document).ready(function(){
    var mensaje = $('#successUpload').filter();
        $('#successUpload').remove();
        $('#errorSuccess').append(mensaje)
    console.log(mensaje);
});