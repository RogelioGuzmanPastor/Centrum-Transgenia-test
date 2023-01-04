$(document).ready(function(){

	$('#login-admin').on('submit', function(e){
		e.preventDefault();


		var datos = $(this).serializeArray();
		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
				var resultado = data;
				console.log(data);
				if(resultado.respuesta == 'exitoso') {
					Swal.fire(
					  'Login Correcto',
					  'Bienvenid@ '+resultado.usuario+' !!',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'index.php';
					}, 2000)
				} else if(resultado.respuesta == 'revalidando') {
					Swal.fire(
					  'Revalidacion Correcta',
					  'Puedes continuar haciendo tus ediciones',
					  'success'
					)
					setTimeout(function(){
						let ruta = resultado.url;
						window.location.href = ruta;
					}, 2000)
				}else if(resultado.respuesta == 'desactivada'){
					
					Swal.fire(
						'Cuenta Desactivada',
						'Tu cuenta ha sido desactivada por solicitud de cambio de contraseña <br> Revisa tu correo o solicita un nuevo enlace de recuperacion <br><br> en unos momentos sera redirigido a la pagina correspondiente',
						'question'
					  )
					  setTimeout(function(){
						  window.location.href = 'recuperar_contrasena.php';
					  }, 9000)
				}else {
					Swal.fire(
					  'Error',
					  'Usuario o Contraseña incorrecto',
					  'error'
					)
				}

			}
		})
		
	});
});