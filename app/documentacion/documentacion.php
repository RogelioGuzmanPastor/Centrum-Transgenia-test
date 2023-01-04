<?php

// ========================================================== //
//      Autor: Rogelio G.
//      Descripcion:
// 
//     En este documento se enlistan las funciones personalizadas
//     asi como una descripcion de las mismas,
//     Se recomienda agregar los snipets aqui mencionados para facilitar el desarrollo 
// ========================================================== //


// ========================================================== //
//      Funcion: createHash
//      Helper: Hash
//      Descripcion:
//      
//      la funcion nos permite crear un string con diferentes caracteristicas para generar tokens randoms
//      y con ello generar la funcionabilidad de recuperar contraseña de forma mas segura
//      
//      El primer parametro definira la longitud del string, y el segundo parametro define si sera complejidad 0, 1, 2, siendo el 2 el que incluye la mayor complejidad
// 
// ========================================================== //


createHash($num_Chars, $complexity){

    $chars = [
        'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz',
        'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ123456789012345678901234567890',
    ];

    return substr(str_shuffle($chars[$complexity]),0,$num_Chars);
}

// ========================================================== //
//      Funcion: _loadDefaultView
//      Helper: vistas
//      Descripcion:
//      
//      Funcion base para cargar vistas con funcionabilidades de cokies y secion
// 
// ========================================================== //

function _loadDefaultView($path, $view, $dataHeader, $data, $dataFooter){
    
    // $path        = ruta donde se encuentra la vista
    // $view        = nombre de la vista
    // $dataHeader  = data para el header
    // $data        = data para el body
    // $dataFooter  = data para el Footer

}


// ========================================================== //
//      Funcion: cargarVistaLogin
//      Helper: vistas
//      Descripcion:
// 
//      Funcion base para cargar vistas con enfoque a paginas de login
// 
// ========================================================== //

function cargarVistaLogin($dataHeader, $data, $view, $dataFooter){

    // $view        = nombre de la vista
    // $dataHeader  = data para el header
    // $data        = data para el body
    // $dataFooter  = data para el Footer

    // El path apunta a ->  "user/control/$view"

}

// ========================================================== //
//      Funcion Random
//      Helper: 
//      Descripcion:
// 
// ========================================================== //

