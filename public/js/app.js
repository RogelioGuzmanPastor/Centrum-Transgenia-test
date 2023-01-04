document.addEventListener("DOMContentLoaded", function() {
    const botonSiguiente = document.getElementById('botonSiguiente');
    const botonAnterior = document.getElementById('botonAnterior');
    const contenedoresPasos = document.getElementsByClassName('contenido-pasos');
    const circulosNumeros = document.getElementsByClassName('numero');    
    const rellenosBarras = document.getElementsByClassName('relleno');    

    class MostrarContenido {
        static paginaSiguiente(pasoSolicitado){
            if(pasoSolicitado <= 4){                                
                if(pasoSolicitado == 2){MostrarContenido.mostrarRegresar()};
                if(pasoSolicitado == 4){MostrarContenido.deshabilitarSiguiente()};
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
                    if(numero < 3){
                        rellenosBarras[numero].style.width = "50%";                    
                    }
                },200);
            },200);
        }
        static regresarNumeroBarra(pasoSolicitado){
            console.log(pasoSolicitado);
            let numero;
            isNaN(pasoSolicitado)?numero = pasoSolicitado:numero = parseInt(pasoSolicitado);   
            
            if(numero < 3){
                rellenosBarras[numero].style.width = "0%"; 
            }
            setTimeout(function(){
                circulosNumeros[numero].classList.remove('active');                
                numero--;
                setTimeout(function(){                                           
                    rellenosBarras[numero].style.width = "50%";                                        
                },200);
            },200);

            // rellenosBarras[numero].style.width = "100%";            
            // numero++;
            // setTimeout(function(){
            //     circulosNumeros[numero].classList.add('active');                
            //     setTimeout(function(){                       
            //         if(numero < 3){
            //             rellenosBarras[numero].style.width = "50%";                    
            //         }
            //     },200);
            // },200);
        }
    }
    
    

    botonSiguiente.addEventListener('click', function(){        
        MostrarContenido.paginaSiguiente(this.dataset.step)
    });
    botonAnterior.addEventListener('click', function(){        
        MostrarContenido.paginaAnterior(this.dataset.step)        
    });


});