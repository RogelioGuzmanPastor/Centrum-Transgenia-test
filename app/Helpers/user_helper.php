<?php


function hashPassword($password){        
    $opciones = array(
        'cost' => 12
    );
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
    return $password_hashed;
};


function verifyPassword($password, $password_hash){
    return password_verify($password, $password_hash);
};