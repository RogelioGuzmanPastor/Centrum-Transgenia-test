$(document).ready(function(){

	$('#agregar_categoria').on('submit', function(e){
		e.preventDefault();


		var datos = $(this).serializeArray();

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
				var resultado = data;
				console.log(datos);
				if(resultado.respuesta == 'exito') {
					Swal.fire(
					  'Correcto',
					  'La categoria se agrego correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'categorias.php';
					}, 2500)
				} else if(resultado.respuesta == 'actualizado') {
					Swal.fire(
					  'Correcto',
					  'La categoria se actualizo correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'categorias.php';
					}, 2500)
				} else {
					Swal.fire(
					  'Error',
					  'Ha ocurrido un error <br> <ul><li>Revisar la conexión a internet </li><li> No pueden existir dos Areas con el mismo nombre </li> </ul>',
					  'error'
					)
				}
			}
		})
	});
 
	// modelo propiedades

	$('#guardar_producto').on('submit', function(e){
		e.preventDefault();


		var datos = $(this).serializeArray();
		console.log(datos);

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
				var resultado = data;
				console.log(datos);
				if(resultado.respuesta == 'exito') {
					Swal.fire(
					  'Correcto',
					  'El Producto se agrego correctamente',
					  'success'
					)
					
				} else if(resultado.respuesta == 'correcto') {
					Swal.fire(
					  'Correcto',
					  'eL producto se agrego correctamente',
					  'success'
					)
					
				} else {
					Swal.fire(
					  'Error',
					  'Ha ocurrido un error',
					  'error'
					)
				}
			}
		})
	});

	//borrar foto

	$('.borrar-foto').on('click', function(e) {
		e.preventDefault();
		console.log('probando boton de borrar');
		var id = $(this).attr('data-id');
		var tipo = $(this).attr('data-tipo');
		var foto = $(this).attr('data-foto');
		var nombre = $(this).attr('data-nombre');
		Swal.fire({
		  title: '¿Estas seguro que quieres borrar este elemento?',
		  text: "Esta accion no se puede revertir",
		  imageUrl: '../img/borrar.png',
		  imageHeight: 100,
		  imageAlt: 'Custom image',
		  showCancelButton: true,
		  confirmButtonColor: 'rgb(55, 179, 179)',
		  cancelButtonColor: 'rgb(157, 123, 85)',
		  confirmButtonText: 'Si, Eliminar!'
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					type: 'post',
					data: {
						'id' : id,
						'foto' : foto,
						'nombre-foto' : nombre,
						'registro' : 'eliminarfoto'
					},
					url: 'modelo-'+tipo+'.php',
					success: function(data){
						console.log(data);
						var resultado = JSON.parse(data);
						if (resultado.respuesta == 'exito') {
							Swal.fire(
						      'Borrado!',
						      'Tu registro a sido borrado.',
						      'success')
							console.log('se borro c:');
							// $("#seccion_productos").load("fotos.php?id="+id);
							$("#fotosCargadas").load("fotos.php?id="+id);
						} else {
							Swal.fire(
							  'Error',
							  'Ha ocurrido un error',
							  'error'
							)
						}
						
					}
				})
			} else {
				Swal.fire(
			      'Cancelado!',
			      'Tu datos <b>NO</b> han sufrido cambios.',
			      'warning')
			}
		});
	});
	// registro nuevo de usuario por formulario publico e interno
	$('#guardar-registro').on('submit', function(e){
		e.preventDefault();


		var datos = $(this).serializeArray();
        console.log(datos);
		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
				var resultado = data;
				console.log(datos);
				if(resultado.respuesta == 'exito') {
					Swal.fire(
					  'Correcto',
					  'El administrador se creo correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'lista-admin.php';
					}, 2500)
				} else if(resultado.respuesta == 'activacion_pendiente') {
					Swal.fire(
					  'Correcto',
					  'El usuario se creo correctamente correctamente <br><br> Revisa tu correo para poder activar tu cuenta',
					  'success'
					)
					setTimeout(function(){
						window.location.href = '../activando.php?k='+resultado.key;
					}, 3500)
				} else if(resultado.respuesta == 'actualizado') {
					Swal.fire(
					  'Correcto',
					  'El administrador se actualizo correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'lista-admin.php';
					}, 2500)
				}  else if(resultado.respuesta == 'usuario_exito') {
					Swal.fire(
						'Correcto',
						'El usuario se creo correctamente',
						'success'
					  )
					  setTimeout(function(){
						  window.location.href = 'lista-user.php';
					  }, 2500)
				} else if(resultado.respuesta == 'usuario_actualizado') {
					Swal.fire(
					  'Correcto',
					  'El usuario se actualizo correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'lista-user.php';
					}, 2500)
				} else {
					Swal.fire(
					  'Error',
					  'Ha ocurrido un error',
					  'error'
					)
				}
			}
		})
	});


	////// Guardar Registro Con archivo
	$('#guardar-registro-archivo').on('submit', function(e){
		e.preventDefault();
		console.log('hola, probando boton de producto');

		var datos = new FormData(this);

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			contentType: false,
			processData: false,
			async: true,
			cache: false,
			success: function(data) {
				var resultado = data;
				console.log(resultado);
				if(resultado.respuesta == 'exito') {
					Swal.fire(
					  'Correcto',
					  'El administrador se creo correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'lista-admin.php';
					}, 2500)
				} else if(resultado.respuesta == 'actualizado') {
					Swal.fire(
					  'Correcto',
					  'El administrador se actualizo correctamente',
					  'success'
					)
					if ( $('#permiso').val() == 'true') {
						setTimeout(function(){
							window.location.href = 'lista-admin.php';
						}, 2500)	} else {
							setTimeout(function(){
							window.location.href = 'index.php';
						}, 2500)
						} 
				}  else if(resultado.respuesta == 'usuario_exito') {
					Swal.fire(
						'Correcto',
						'El usuario se creo correctamente',
						'success'
					  )
					  setTimeout(function(){
						  window.location.href = 'lista-user.php';
					  }, 2500)
				}  else if(resultado.respuesta == 'restablecer_contrasena') {
					Swal.fire(
						'Correcto',
						'La contraseña se actualizo satisfactoriamente <br><br> >Inicia Sesión para entrar a tu cuenta',
						'success'
					  )
					  setTimeout(function(){
						  window.location.href = 'login.php';
					  }, 2500)
				} else if(resultado.respuesta == 'usuario_actualizado') {
					Swal.fire(
					  'Correcto',
					  'El usuario se actualizo correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'lista-user.php';
					}, 2500)
				} else {
					Swal.fire(
					  'Error',
					  'Ha ocurrido un error',
					  'error'
					)
				}
			}
		})
	});
	
	// Generando claves
	$('#agregar_claves').on('submit', function(e){
		e.preventDefault();
		var datos = $(this).serializeArray();
		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
				var resultado = data;
				console.log(datos);
				if(resultado.respuesta == 'exito_claves') {
					Swal.fire(
					  'Correcto',
					  'La clave de aceso de un solo uso se agrego correctamente',
					  'success'
					)
					setTimeout(function(){
						window.location.href = 'claves.php';
					}, 2500)
				}  else {
					Swal.fire(
					  'Error',
					  'Ha ocurrido un error <br> <ul><li>Revisar la conexión a internet </li><li> No pueden existir dos Categorias con el mismo nombre </li> </ul>',
					  'error'
					)
				}
			}
		})
	});
	// Cambiar Disponibilidad de elementos, Requiere modulo active en la misma carpeta
	$('.producto-disponible').on('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var tipo = $(this).attr('data-tipo');	
		var disp = $(this).attr('data-disp');
		var urld = $(this).attr('data-url');
		$.ajax({
			type: 'post',
			data: {
				'id' : id,
				'disp' : disp
			},
			url: 'modelo-'+tipo+'-disp.php',
			success: function(data){
				var resultado = JSON.parse(data);
				if (resultado.respuesta == 'exito') {
					Swal.fire(
				      'Correcto',
				      'Tu disponibilidad ha sido cambiada.',
				      'success')
				    $('#disp-'+id).load('active.php?id='+id);//actualizas el div
				} else {
				
				}
				
			}
		})
	});

	// Reutiliar codigo borrar 
	$('.borrar-registro').on('click', function(e) {
		e.preventDefault();
		// console.log('probando boton de borrar');
		var id = $(this).attr('data-id');
		var tipo = $(this).attr('data-tipo');
		var lista = $(this).attr('data-lista');
		Swal.fire({
		  title: '¿Estas seguro que quieres borrar este elemento?',
		  text: "Esta accion no se puede revertir",
		  imageUrl: '../img/borrar.png',
		  imageHeight: 100,
		  imageAlt: 'Custom image',
		  showCancelButton: true,
		  confirmButtonColor: 'rgb(55, 179, 179)',
		  cancelButtonColor: 'rgb(157, 123, 85)',
		  confirmButtonText: 'Si, Eliminar!'
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					type: 'post',
					data: {
						'id' : id,
						'lista' : lista,
						'registro' : 'eliminar'
					},
					url: 'modelo-'+tipo+'.php',
					success: function(data){
						console.log(data);
						var resultado = JSON.parse(data);
						if (resultado.respuesta == 'exito') {
							Swal.fire(
						      'Borrado!',
						      'Tu registro a sido borrado.',
						      'success')
							jQuery('[data-id="'+resultado.id_eliminado+'"]').parents('tr').remove();
						} else {
							Swal.fire(
							  'Error',
							  'Ha ocurrido un error',
							  'error'
							)
						}
						
					}
				})
			} else {
				Swal.fire(
			      'Cancelado!',
			      'Tu datos <b>NO</b> han sufrido cambios.',
			      'warning')
			}
		});
	});
});