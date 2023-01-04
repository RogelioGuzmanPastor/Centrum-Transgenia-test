<?php 

namespace loadDefaultView\loadDefaultView;
use CodeIgniter\Libraries; 
class loadDefaultView
{
    public function cargarVista($dataHeader, $data, $view, $dataFooter){

        $session = session();
        $iniciado = $session->id;
        
        if($iniciado > 0) {
            $iniciado =  true;
        } else {
            // ========================================================== //
            //    Cargando helper de cookies y borrando cookies
            // ========================================================== //
            helper('cookie');
            if(get_cookie("type")){
                delete_cookie('id');
                delete_cookie('nombre');
                delete_cookie('username');
                delete_cookie('email');
                delete_cookie('type');
            }
            $iniciado = false; 
        }

        array_push($dataFooter, $dataFooter['iniciado'] = $iniciado);
        
        echo view("user/templates/header", $dataHeader);
        echo view("user/control/$view", $data );
        echo view("user/templates/footer", $dataFooter);
    }
    public function testingText(){
        echo "hola";
    }
}



    // // ========================================================== //
    // //    Funcion de automatizacion para carga de vistas e informacion
    // // ========================================================== //
    // public function _loadDefaultView($dataHeader, $data, $view, $dataFooter){

    //     $session = session();
    //     $iniciado = $session->id;
        
    //     if($iniciado > 0) {
    //         $iniciado =  true;
    //     } else {
    //         // ========================================================== //
    //         //    Cargando helper de cookies y borrando cookies
    //         // ========================================================== //
    //         helper('cookie');
    //         if(get_cookie("type")){
    //             delete_cookie('id');
    //             delete_cookie('nombre');
    //             delete_cookie('username');
    //             delete_cookie('email');
    //             delete_cookie('type');
    //         }
    //         $iniciado = false; 
    //     }

    //     array_push($dataFooter, $dataFooter['iniciado'] = $iniciado);
        
    //     echo view("user/templates/header", $dataHeader);
    //     echo view("user/control/$view", $data );
    //     echo view("user/templates/footer", $dataFooter);
    // }
    // private function _createHash($num_Chars, $complexity){

    //     $chars = [
    //         'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz',
    //         'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ',
    //         'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ123456789012345678901234567890',
    //     ];
    
    //     return substr(str_shuffle($chars[$complexity]),0,$num_Chars);
    // } 
?>