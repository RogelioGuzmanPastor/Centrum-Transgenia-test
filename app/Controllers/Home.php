<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index(){
		$dataHeader = [
			'metas' => '
				<meta name="description" content="Formulario generado para prueba tecnica">
				<meta name="keywords" content="prueba tecnica, centrum,transgenia, test">
				<meta name="author" content="Rogelio Guzman Pastor">',
			'title' => PROYECTNAME.' | index',
			'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>',
			// 'css_asinc_font_mastercss' => 'media="print" onload="this.media=&apos;all&apos;"',
			// 'criticalcss'=>'<style>body{padding: 0!important}</style>',
			// 'css'=> '<link rel="stylesheet" href="/css//.css">'
		];
		$data = [
			// 
		];        
		$dataFooter = [                      
			// <script src='/js/app.js' defer></script>
			'js' => '            
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("'.RECAPCHAPUBLIC.'", {action: "homepage"})
                    .then(function(token) {                        
						let inputRecaptcha = document.getElementById("google-response-token");
                        inputRecaptcha.value = token;
						let inputRecaptcha2 = document.getElementById("google-response-token-2");
                        inputRecaptcha2.value = token;
                    });
                });
                
            </script>',
		];	
		
		
		// ========================================================== //
		//    path, pathTemplate, view, dataHeader, data, dataFooter
		// ========================================================== //
		$path = '/home/';
		$pathTemplate = '/dashboard/templates/';
		_loadDefaultView($path, $pathTemplate, 'index', $dataHeader, $data, $dataFooter, false);
	}
	function image($recurso = null, $image = null){

        if(!$recurso){
            $recurso = $this->request->getGet('recurso');
        }
        if(!$image){
            $image = $this->request->getGet('image');
        }


        if($recurso == '' || $image  == ''){
            throw PageNotFoundException::forPageNotFound();
        }
        
        $name = WRITEPATH.'uploads/'.$recurso.'/'.$image;
        // abre el archivo en modo binario
        
        if(!file_exists($name)){            
            throw PageNotFoundException::forPageNotFound();
        }
        $fp = fopen($name, 'rb');

        // env??a las cabeceras correctas
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));

        // vuelca la imagen y detiene el script
        fpassthru($fp);
        exit;

    }
}
