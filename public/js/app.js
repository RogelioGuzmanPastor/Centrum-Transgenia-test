document.addEventListener("DOMContentLoaded", function() {
    // botones de accion para mostrar paginas
    const botonSiguiente = document.getElementById('botonSiguiente');
    const botonAnterior = document.getElementById('botonAnterior');

    const contenedoresPasos = document.getElementsByClassName('contenido-pasos');
    const circulosNumeros = document.getElementsByClassName('numero');    
    const rellenosBarras = document.getElementsByClassName('relleno');    
    
    // botones de servicios 
    const botonesServicios = document.getElementsByClassName('servicio');
    const inputServicio = document.getElementById('inputServicio');
    // botones de rangos 
    const botonesRango = document.getElementsByClassName('rango');
    const inputRango = document.getElementById('inputRango');

    const formulario = document.getElementById('formulario');
    const newsletter = document.getElementById('newsletter');
    

    class MostrarContenido {
        static paginaSiguiente(pasoSolicitado){
            if(pasoSolicitado <= 4){                                
                if(pasoSolicitado == 2){MostrarContenido.mostrarRegresar()};
                if(pasoSolicitado == contenedoresPasos.length){MostrarContenido.deshabilitarSiguiente()};
                MostrarContenido.ocultarPresentar(pasoSolicitado)
                MostrarContenido.activarSiguienteNumeroBarra(pasoSolicitado);                
                pasoSolicitado++; 
                let paginaSolicitada;
                isNaN(pasoSolicitado)?paginaSolicitada = pasoSolicitado:paginaSolicitada = parseInt(pasoSolicitado);                                                                        
                botonSiguiente.dataset.step = paginaSolicitada;
                botonAnterior.dataset.step = paginaSolicitada - 2;                
            }
        }
        static paginaAnterior(pasoSolicitado){
            if(pasoSolicitado >= 1){                                
                if(pasoSolicitado == 1){MostrarContenido.ocultarRegresar();}
                if(pasoSolicitado == 3){MostrarContenido.habilitarSiguiente();}
                MostrarContenido.ocultarPresentar(pasoSolicitado)    
                MostrarContenido.regresarNumeroBarra(pasoSolicitado);                 
                pasoSolicitado++; 
                let paginaSolicitada;
                isNaN(pasoSolicitado)?paginaSolicitada = pasoSolicitado:paginaSolicitada = parseInt(pasoSolicitado);                                                                        
                botonSiguiente.dataset.step = paginaSolicitada;
                botonAnterior.dataset.step = paginaSolicitada - 2;                
                
            } 
        }
        static ocultarPresentar(pagina){
            for (let index = 0; index < contenedoresPasos.length; index++) {
                const element = contenedoresPasos[index];
                if(element.classList.contains(`paso-${pagina}`)){
                    element.classList.remove('fadeOut')                
                    element.classList.add('fadeInt')                
                    setTimeout(function(){
                        element.classList.add('active')                                        
                    },200)
                }else {
                    element.classList.remove('fadeInt')                
                    element.classList.add('fadeOut')                
                    setTimeout(function(){
                        element.classList.remove('active')                
                    },200)
                }
            }
            // contenedoresPasos
        }
        static mostrarRegresar(){
            botonAnterior.classList.remove('fadeOut');
            botonAnterior.classList.add('fadeIn');
        }
        static ocultarRegresar(){
            botonAnterior.classList.remove('fadeIn');
            botonAnterior.classList.add('fadeOut');
            
        }
        static habilitarSiguiente(){
            botonSiguiente.classList.remove('fadeOut');
            botonSiguiente.classList.add('fadeIn');
        }
        static deshabilitarSiguiente(){
            botonSiguiente.classList.remove('fadeIn');
            botonSiguiente.classList.add('fadeOut');
        }
        static activarSiguienteNumeroBarra(pasoSolicitado){
            pasoSolicitado--;
            let numero;
            isNaN(pasoSolicitado)?numero = pasoSolicitado:numero = parseInt(pasoSolicitado);   
            numero--;
            rellenosBarras[numero].style.width = "100%";            
            numero++;
            setTimeout(function(){
                circulosNumeros[numero].classList.add('active');                
                setTimeout(function(){                       
                    if(numero < rellenosBarras.length){
                        rellenosBarras[numero].style.width = "50%";                    
                    }
                },200);
            },200);
        }
        static regresarNumeroBarra(pasoSolicitado){            
            let numero;
            isNaN(pasoSolicitado)?numero = pasoSolicitado:numero = parseInt(pasoSolicitado);   
            
            if(numero < rellenosBarras.length){
                rellenosBarras[numero].style.width = "0%"; 
            }
            setTimeout(function(){
                circulosNumeros[numero].classList.remove('active');                
                numero--;
                setTimeout(function(){                                           
                    rellenosBarras[numero].style.width = "50%";                                        
                },200);
            },200);
        }
    }
    
    botonSiguiente.addEventListener('click', function(){        
        MostrarContenido.paginaSiguiente(this.dataset.step)
    });
    botonAnterior.addEventListener('click', function(){        
        MostrarContenido.paginaAnterior(this.dataset.step)        
    });
        
    for (let index = 0; index < botonesServicios.length; index++) {        
        botonesServicios[index].addEventListener('click', function(){                           
            for (let index = 0; index < botonesServicios.length; index++) {
                botonesServicios[index].classList.remove('active');
            }
            this.classList.add('active');            
            inputServicio.value = this.dataset.servicio;
        });
    }
    for (let index = 0; index < botonesRango.length; index++) {        
        botonesRango[index].addEventListener('click', function(){                           
            for (let index = 0; index < botonesRango.length; index++) {
                botonesRango[index].classList.remove('active');
            }
            this.classList.add('active');            
            inputRango.value = this.dataset.rango;
        });
    }

    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        const datosFormulario = new FormData(formulario);
        fetch('/register-data',{
            method: 'POST',
            body: datosFormulario
        })
            .then(res => res.json())
            .then(data=> {
                if(data.respuesta == 'exito'){
                    let botonEnvio = document.getElementById('envioFormulario');                
                    // botonEnvio.classList.add('disabled');
                    botonEnvio.innerText = "Successful registration";
                    
                } else {
                    let botonEnvio = document.getElementById('envioFormulario');
                    botonEnvio.innerText = "Error, Reintente";
                    
                }
                
            })
    });
    newsletter.addEventListener('submit',function(e){        
        e.preventDefault();
        const datosNewsletter = new FormData(newsletter);
        console.log(datosNewsletter.get('email'));
        fetch('/register-newsletter',{
            method: 'POST',
            body: datosNewsletter
        })
            .then(res => res.json())
            .then(data=> {
                if(data.respuesta == 'exito'){
                    let botonEnvio = document.getElementById('enviarNewsletter');
                    let inputNewsletter = document.getElementById('inputNewsletter');

                    botonEnvio.classList.add('disabled');
                    botonEnvio.innerText = "Successful registration";
                    inputNewsletter.value = "";
                } else {
                    let botonEnvio = document.getElementById('enviarNewsletter');
                    botonEnvio.innerText = "Error, Reintente";
                    
                }
                
            })

    });

});