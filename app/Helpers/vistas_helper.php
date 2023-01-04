<?php 

function _loadDefaultView($path, $pathTemplate, $view, $dataHeader, $data, $dataFooter, $protected){
    // ========================================================== //
    //    Cargando helper de cookies
    // ========================================================== //
    helper('cookie');
    // ========================================================== //
    //    Generando sesion inicial
    // ========================================================== //
    $session = session();
    $iniciado = $session->id_token;
    $type = $session->type;
    // $id = $session->id;
    // ========================================================== //
    //    Generando cookies para moderadores y administradores
    // ========================================================== //
    if($session->secionActiva == true){            
        set_cookie("type", $session->type , 1296000);  
        set_cookie("id_token", $session->id_token , 1296000);  
        set_cookie("faccion", $session->faccion , 1296000);  
        set_cookie("nombre", $session->nombre , 1296000);  
        set_cookie("username", $session->username , 1296000);  
        set_cookie("sup", $session->sup , 1296000);  
        set_cookie("email", $session->email , 1296000);  
        set_cookie("secionActiva", $session->secionActiva , 1296000);  
        set_cookie("imagen", $session->imagen , 1296000);  
    }

    // ========================================================== //
    //    verificando que exista secion abierta
    // ========================================================== //
    if($iniciado != NULL ){
        $iniciado =  true;         

    } else {
        // ========================================================== //
        //    En caso de que no exista, validando si existen cookies de administrador
        // ========================================================== //
        if(get_cookie("secionActiva")){
            helper('user');
            $user = [
                'id_token' => get_cookie("id_token"),
                'nombre' => get_cookie("nombre"),
                'username' => get_cookie("username"),
                'sup' => get_cookie("sup"),
                'faccion' => get_cookie("faccion"),
                'email' => get_cookie("email"),
                'type' => get_cookie("type"),
                'imagen' => get_cookie("imagen"),
                'secionActiva' => get_cookie("secionActiva"),
            ];
            $session = session();
            $session->set($user);
            $id_token = $session->id_token;
            $type = $session->type;
            $iniciado = true;
        } else {
            $iniciado = false;
            
            if($protected == true){
                
                // ========================================================== //
                //    si se solicita que inicie secion este fragmento te enviara el login
                // ========================================================== //
                header("Location: /login");
                die;                
                
            }
        }

    }
    
    

    array_push($dataHeader, $dataHeader['iniciado'] = $iniciado);
    array_push($dataHeader, $dataHeader['id_token'] =  $session->id_token);
    array_push($dataHeader, $dataHeader['imagen'] =  $session->imagen);
    array_push($dataHeader, $dataHeader['typeUser'] = $type);
    array_push($data, $data['typeUser'] = $type);
    array_push($data, $data['faccion'] = $session->faccion);

    array_push($data, $data['iniciado'] = $iniciado);   
    array_push($data, $data['sup'] = $session->sup);   
    array_push($dataFooter, $dataFooter['iniciado'] = $iniciado);
    
    
    echo view($pathTemplate."header", $dataHeader);
    // echo view("dashboard/templates/header", $dataHeader);
    echo view($path.$view, $data );
    echo view($pathTemplate."footer",  $dataFooter);
    // echo view("dashboard/templates/footer",  $dataFooter);
}

function cargarVistaLogin($dataHeader, $data, $view, $dataFooter){

    $session = session();
    $iniciado = $session->id_token;
    echo $iniciado; 
    
    if($iniciado != NULL) {
        $iniciado =  true;
        
    } else {
        helper('cookie');
        // ========================================================== //
        //    Cargando helper de cookies y borrando cookies
        // ========================================================== //
        if(get_cookie("type")){
            delete_cookie('id_token');
            delete_cookie('nombre');
            delete_cookie('username');
            delete_cookie('sup');
            delete_cookie('faccion');            
            delete_cookie('email');
            delete_cookie('type');
            delete_cookie('secionActiva');
        }
        $iniciado = false; 
    }

    array_push($dataFooter, $dataFooter['iniciado'] = $iniciado);
    
    echo view("user/templates/header", $dataHeader);
    echo view("user/control/$view", $data );
    echo view("user/templates/footer", $dataFooter);
}

?>