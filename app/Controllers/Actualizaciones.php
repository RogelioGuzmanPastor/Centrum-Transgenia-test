<?php 
namespace App\Controllers;
use App\Models\UsersModel;
use App\Controllers\BaseController;
use App\Models\ActualizacionesModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Actualizaciones extends BaseController {

    public function index()
    {
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME.' | Actualizaciones',
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            'css'=> '<link rel="stylesheet" href="/css/actualizaciones/actualizaciones.css"/>',
            
        ];
        $actualizacionesModel = new ActualizacionesModel();        

        $actualizaciones = $actualizacionesModel->asObject()
                                            ->select('actualizaciones.*, users.nombre, users.imagen')
                                            ->orderBy('id', 'DESC')
                                            ->join('users', "users.id_token = actualizaciones.creador_token_id", 'left')      
                                            ->paginate(10);
        
        $data = [
            'actualizaciones' => $actualizaciones,            
            'pager' => $actualizacionesModel->pager
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
		$path = 'control/dashboard/Actualizaciones/';
		$pathTemplate = 'control/dashboard/templates/';
		_loadDefaultView($path, $pathTemplate, 'index', $dataHeader, $data, $dataFooter, true);
    }
    
    public function new(){
        $dataHeader = [
            'title' => PROYECTNAME .' | Agregar informacion de actualizacion',
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
        ];
        
        $validation = \Config\Services::validation();
        $dataFooter = [
            'js' => '
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("'.RECAPCHAPUBLIC.'", {action: "homepage"})
                    .then(function(token) {                        
                        $("#google-response-token").val(token);                        
                    });
                });
            </script>',
            ];

        // ========================================================== //
        //    path, pathTemplate, view, dataHeader, data, dataFooter, autorizacion
        // ========================================================== //
        _loadDefaultView('control/dashboard/Actualizaciones/', 'control/dashboard/templates/', 'new', $dataHeader,  ['validation' => $validation, 'actualizacion' => new ActualizacionesModel()], $dataFooter, true);        
        
    }    

    
    public function create(){
        
        if(isset($_POST['google-response-token']) ){
            
            $filter = $_POST['google-response-token'];
            
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
                //    Traemos el id del creador
                // ========================================================== //

                $usuario = new UsersModel();


                $session = session();
                $token = $session->id_token;

               
                $infoUsuario = $usuario->select('id')->orWhere('id_token',$token)->asObject()->first();
                $id = $infoUsuario->id;

                
                if($id > 0 ){
                    
                    // ========================================================== //
                    //    traemos la informacion del usuario
                    // ========================================================== //

                    if ($usuario->find($id) == null) {
                        throw PageNotFoundException::forPageNotFound();
                    }

                } else {
                    header("Location: /login");
                }

                $actualiacion = new ActualizacionesModel();
                if($this->validate('actualizacion')){
                
                    // ========================================================== //
                    //    Guardando datos
                    // ========================================================== //
                    
                    $actualiacion->save([
                        'titulo' => $this->request->getPost('titulo'),                        
                        'actualizacion' => $this->request->getPost('actualizacion'),                        
                        'version' => $this->request->getPost('version'),        
                        'color' => $this->request->getPost('color'),        
                        'creador_token_id' => $token,                
                        
                    ]);
                                                                
                    return redirect()->to('/actualizaciones')->with('message','Actualizacion Creada con Exito');
                                        
                } 
                return redirect()->back()->withInput();
            } else {
                return redirect()->to('/actualizaciones/new')->with('message','Error, intente de nuevo');
            }
        }


        
    }

    public function edit($id = null){
        $actualizaciones = new ActualizacionesModel();
        
        // helper("user");
        // echo verifyPassword('123456789','$2y$12$u9g95bnSA8ElprURG8ZKZ.fRjQPCrcOHQPdgWwfbHksv8rSjgzJa.');
        
        if ($actualizaciones->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $dataHeader = [
            'title' => PROYECTNAME.' | Actualizar Usuario',
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
        ];
        $validation = \Config\Services::validation();
        $dataFooter = [
            'js' => '
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("'.RECAPCHAPUBLIC.'", {action: "homepage"})
                    .then(function(token) {                        
                        $("#google-response-token").val(token);                        
                    });
                });
            </script>',
            ];

        // ========================================================== //
        //    path, pathTemplate, view, dataHeader, data, dataFooter, autorizacion
        // ========================================================== //
        _loadDefaultView('control/dashboard/Actualizaciones/', 'control/dashboard/templates/', 'edit', $dataHeader,  ['validation' => $validation, 'actualizacion'=>$actualizaciones->asObject()->find($id)], $dataFooter, true);                
        
    }
    public function update($id = null){
        if(isset($_POST['google-response-token'])){
            
            $filter = $_POST['google-response-token'];
            
            // ========================================================== //
            //    Configuracion re captcha
            // ========================================================== //            
            $googleToken = $filter;

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPCHAPRIVATE."&response={$googleToken}"); 
            $response = json_decode($response);

            $response = (array) $response;
            if($response['success'] && ($response['score'] && $response['score'] > 0.5))
            {
                $actualizacion = new ActualizacionesModel();
        
                if ($actualizacion->find($id) == null) {
                    throw PageNotFoundException::forPageNotFound();
                }

                // 'password' =>$this->request->getPost('password'),  
                if($this->validate('actualizacion')){                    
                                                            
                            $actualizacion->update($id, [
                                'titulo' => $this->request->getPost('titulo'),                        
                                'actualizacion' => $this->request->getPost('actualizacion'),                        
                                'version' => $this->request->getPost('version'),        
                                'color' => $this->request->getPost('color'),                                                                                                                                           
                            ]);

                        
                        
                        return redirect()->to('/actualizaciones')->with('message','Actualizacion modificada con Exito');
                        
                        
                } 
                
                    
                return redirect()->back()->withInput();
            } else {
                return redirect()->to('/actualizaciones')->with('message','Intente Editar nuevamente');
            }
        }
    }


    // public function delete($id = null){

    //     $categorias = new CategoriasModel();
        
    //     if ($categorias->find($id) == null) {
    //         throw PageNotFoundException::forPageNotFound();
    //     }
    //     $categorias->delete($id);
    //     return redirect()->to('/categorias')->with('message','Categoria Borrada con Exito');
        
    // }
 
    // private function _upload(){
    //     if ($imagefile = $this->request->getFile('imagen')) {

    //         if ($imagefile->isValid() && ! $imagefile->hasMoved()) {
    //             $validated = $this->validate([
    //                 'imagen' => [
    //                     'uploaded[imagen]',
    //                     'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png]',
    //                     'max_size[imagen,4096]',
    //                 ],
    //             ]);
    //             if ($validated) {
    //                 $newName = $imagefile->getRandomName();
    //                 $imagefile->move(WRITEPATH.'uploads/actualizaciones', $newName);                    
    //                 return $newName;
    //             }else{
    //                 return false;
    //             }
    //         } else {
    //             return null;
    //         }
            
    //     }
    // }
    
    
}


