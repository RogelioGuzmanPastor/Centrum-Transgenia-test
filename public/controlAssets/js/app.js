$(document).ready(function() {
  
    // funcion de esconder y mostrar barra lateral
    $('#boton-menu-dashboard').on('click', function(){        
        if($('body').hasClass('sidebar-closed') || $('body').hasClass('sidebar-collapse')){
          $('body').removeClass('sidebar-closed');
          $('body').removeClass('sidebar-collapse');          
        }else {
          $('body').addClass('sidebar-closed');
          $('body').addClass('sidebar-collapse');
        }
    });

  

});

    
  
   
    
