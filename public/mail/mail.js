$(document).ready(function(){
    // console.log('cargado...');
    $('.form-contacto').on('submit', function(e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            success: function(data){
                console.log(data);
                var resultado = JSON.parse(data);
                resultado.respuesta == 'exito'?$('#alertaOk').fadeIn(300):$('#alertaError').fadeIn(300);                
            }
        })
    });

    $('.mask, #alert_contact a').on('click', function(e){
        e.preventDefault();
        $('.alert_contact').fadeOut(300);
    });
});