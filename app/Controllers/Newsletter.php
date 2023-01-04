<?php

namespace App\Controllers;

use App\Models\NewsletterModel;

class Newsletter extends BaseController
{
	public function index()
    {
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME.' | Registros Newsletter',
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            // 'css'=> '<link rel="stylesheet" href="/css/user/user.css"/>',
            
        ];
        $usuario = new NewsletterModel();
        $data = [
            'usuarios' => $usuario->asObject()->paginate(18),
            'pager' => $usuario->pager
        ];
        $dataFooter = [                      
			// <script src='/js/app.js' defer></script>
			// 'app' => '               
			// ',
		];	

        // $this->_loadDefaultView($dataHeader, $data, 'index', []);

        // ========================================================== //
		//    path, pathTemplate, view, dataHeader, data, dataFooter
		// ========================================================== //
		$path = 'control/dashboard/Newsletter/';
		$pathTemplate = 'control/dashboard/templates/';
		_loadDefaultView($path, $pathTemplate, 'index', $dataHeader, $data, $dataFooter, false);
    }
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

    public function delete($id = null){

        $usuario = new NewsletterModel();       

        if ($usuario->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $usuario->delete($id);
        return redirect()->to('/control/newsletter')->with('message','Registro Borrado con Exito');
        
    }
	
}
