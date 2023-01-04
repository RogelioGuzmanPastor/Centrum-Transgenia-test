$(document).ready(function() {
  // indicamos que se ejecuta la funcion a los 5 segundos de haberse
  // cargado la pagina
  if ($('#inv').length) {
   setTimeout(clickbutton, 10);
  function clickbutton() {
    // simulamos el click del mouse en el boton del formulario
    $("#inv").click();
      }
    } else {
    }
     
});