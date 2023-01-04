<?php

namespace App\Controllers;

use App\Models\NewsletterModel;

class Newsletter extends BaseController
{
	
	public function register()
	{   
        if(isset($_POST['google-response-token-2'])){
           
            $filter = $_POST['google-response-token-2'];
            
            // ========================================================== //
            //    Configuracion re captcha
            // ========================================================== //            
            $googleToken = $filter;

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPCHAPRIVATE."&response={$googleToken}"); 
            $response = json_decode($response);

            $response = (array) $response;
            if($response['success'] && ($response['score'] && $response['score'] > 0.5))
            {
                // ========================================================== //
                //    Validando datos de entrada
                // ========================================================== //
                if(isset($_POST['email'])){
                
                        $datosNewsletter = new NewsletterModel();
                        $id = $datosNewsletter->insert([                           
                            'email' =>$this->request->getPost('email'),                                                           
                        ]);
                        if($id > 0){ 
                          
                            $respuesta = array(
                                'respuesta' => 'exito',                                
                            );
                            
                        } else { 
                            $respuesta = array(
                                'respuesta' => 'error',                                
                            );
                        }    
                        die(json_encode($respuesta));                      
                }  else {
                    $respuesta = array(
                        'respuesta' => 'sindatos',                                
                    );
                    die(json_encode($respuesta));
                }
            } else {
                echo 'error no robot';
            }
        }

		
	}
	
}
