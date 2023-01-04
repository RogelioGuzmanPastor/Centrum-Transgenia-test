<?php 

function fechaBase($fecha){
    return $fecha = str_replace('T',' ',$fecha.':00');
}
function horaBase($hora, $minutos){
    if($hora == ''){
        $hora = '00';
    };
    if($minutos == ''){
        $minutos = '00'; 
    };
    
    return $hora = $hora.':'.$minutos.':00';
}
?>