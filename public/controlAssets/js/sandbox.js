	/*=============================================
AGREGAR MULTIMEDIA CON DROPZONE
=============================================*/

var arrayFiles = [];

$(".multimediaFisica").dropzone({

	url: "/",
	addRemoveLinks: true,
	acceptedFiles: "image/jpeg, image/png",
	maxFilesize: 5, //5mb
	maxFiles: 50, 	//maximo 10 archivos
	init: function(){

		this.on("addedfile", function(file){

			arrayFiles.push(file);

			// console.log("arrayFiles", arrayFiles);

		})

		this.on("removedfile", function(file){

			var index = arrayFiles.indexOf(file);

			arrayFiles.splice(index, 1);

			// console.log("arrayFiles", arrayFiles);

		})

	}

})


/*=============================================
GUARDAR EL PRODUCTO
=============================================*/

var multimediaFisica = null;



$(".guardarProducto").click(function(){

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/

	if($(".tituloProducto").val() != "" && arrayFiles != "" ){

		/*=============================================
	   	PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
	   	=============================================*/

	   		if(arrayFiles.length > 0 ){

	   			var listaMultimedia = [];
	   			var finalFor = 0;

	   			for(var i = 0; i < arrayFiles.length; i++){

	   				var datosMultimedia = new FormData();
	   				var id = $(".tituloProducto").val();
	   				datosMultimedia.append("file", arrayFiles[i]);
					datosMultimedia.append("tituloProducto", $(".tituloProducto").val());

					$.ajax({
						url:"producto.ajax.php",
						method: "POST",
						data: datosMultimedia,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function() {
						    $('.guardarProducto').html("Enviando ...");
						 },
						success: function(respuesta){
							
							listaMultimedia.push({"foto" : respuesta})
							multimediaFisica = JSON.stringify(listaMultimedia);
							

							if((finalFor + 1) == arrayFiles.length){

								agregarMiProducto(multimediaFisica); 
								finalFor = 0; 

							}

							finalFor++;
							
							$('.guardarProducto').html("Guardar fotos");
							$("#fotosCargadas").load("fotos.php?id="+id);
							
							
							
						}

					})

	   			}

	   		}

	   		

	}else{
		swal.fire({
	      title: "Llenar todos los campos obligatorios",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;
	}

})


function agregarMiProducto(imagen){

		/*=============================================
		ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
		=============================================*/

		var tituloProducto = $(".tituloProducto").val();

	 	var datosProducto = new FormData();
	 	var id = $(".tituloProducto").val();
		datosProducto.append("tituloProducto", tituloProducto);
		datosProducto.append("multimedia", imagen);
		$.ajax({
				url:"producto.ajaxSubida.php",
				method: "POST",
				data: datosProducto,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
				    $('.guardarProducto').html("Enviando ...");
				 },
				success: function(respuesta){
						
					// console.log("respuesta", respuesta);

					if(respuesta == "ok"){

						swal.fire({
						  type: "success",
						  title: "Las fotos se han guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							$('.guardarProducto').html("Guardar Fotos");
							
							$("#fotosCargadas").load("fotos.php?id="+id);
							}
						})
					}else if(respuesta == "error"){
						swal.fire({
						  type: "error",
						  title: "¡Ocurrio un error!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
						  $('.guardarProducto').html("Guardar producto");	
							
						})
					}

				}

		})


}
