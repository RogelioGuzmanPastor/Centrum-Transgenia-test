<?php 
namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\UsersCreateModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;


class User extends BaseController {

    public function index()
    {
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME.' | Listado usuarios',
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            'css'=> '<link rel="stylesheet" href="/css/user/user.css"/>',
            
        ];
        $usuario = new UsersModel();
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
		$path = 'control/dashboard/User/';
		$pathTemplate = 'control/dashboard/templates/';
		_loadDefaultView($path, $pathTemplate, 'index', $dataHeader, $data, $dataFooter, false);
    }
    
    public function new(){
        $dataHeader = [
            'title' => PROYECTNAME .' | Agregar Usuario a la lista',
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
        _loadDefaultView('control/dashboard/User/', 'control/dashboard/templates/', 'new', $dataHeader,  ['validation' => $validation, 'usuario' => new UsersModel()], $dataFooter, true);        
        
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
                $usuario = new UsersCreateModel();
                if($this->validate('users')){
                
                    // ========================================================== //
                    //    encriptaando password
                    // ========================================================== //
                    helper("user"); 

                    $token = createHash(10,2);
 
                    $usuario->save([
                        'nombre' => $this->request->getPost('nombre'),
                        'username' => $this->request->getPost('username'),
                        'email' =>$this->request->getPost('email'),                                
                        'id_token' => $token,   
                        'password' => hashPassword($this->request->getPost('password')), 
                        'type' =>$this->request->getPost('type'),                                
                    ]);
                    
                        
                        
                    return redirect()->to('/User')->with('message','User Creado con Exito');
                    
                    // $usuario->save([
                    //     'User' => $this->request->getPost('User'),
                    //     'description' =>$this->request->getPost('descripcion')
                    // ]);

                    // $this->_upload();

                    // return redirect()->to('/User/new')->with('message','User: <b style="font-weight: bold;" >'.$this->request->getPost('User').'</b> - Guardado con Exito');
                } 
                return redirect()->back()->withInput();
            } else {
                return redirect()->to('/User/new')->with('message','Error, intente de nuevo');
            }
        }


        
    }

    public function edit($token = null){
        $usuario = new UsersModel();
        
        // helper("user");
        // echo verifyPassword('123456789','$2y$12$u9g95bnSA8ElprURG8ZKZ.fRjQPCrcOHQPdgWwfbHksv8rSjgzJa.');
        
        $infoUsuario = $usuario->select('id')->orWhere('id_token',$token)->asObject()->first();
        $id = $infoUsuario->id;
        
        if ($usuario->find($id) == null) {
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
        _loadDefaultView('control/dashboard/User/', 'control/dashboard/templates/', 'edit', $dataHeader,  ['validation' => $validation, 'usuario'=>$usuario->asObject()->find($id)], $dataFooter, true);                
        
    }
    public function update($token = null){
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
                $usuario = new UsersModel();
                
                $infoUsuario = $usuario->select('id')->orWhere('id_token',$token)->asObject()->first();
                $id = $infoUsuario->id;

                if ($usuario->find($id) == null) {
                    throw PageNotFoundException::forPageNotFound();
                }

                // 'password' =>$this->request->getPost('password'),  
                if($this->validate('users_edit')){                    
                    // ========================================================== //
                    //    Validando modificacion de pass
                    // ========================================================== //
                    $existPass = $this->request->getPost('password');

                    if($existPass !== ''){
                        if($this->validate('passwordValidate')){
                            helper("user");                            
                            $usuario->update($id, [
                                'password' => hashPassword($existPass),                                                                
                            ]);
                        } else {
                        
                            return redirect()->to('/User')->with('message','Error, la contraseña debe contener al menos 8 caracteres');
                        }

                    } 

                    // ========================================================== //
                    //    validando carga de imagen
                    // ========================================================== //
                    $newName = $this->_upload();


                    if($newName !== false) {
                        // ========================================================== //
                        //    En caso de que se carge la imagen cambia el valor de null
                        // ========================================================== //
                        if($newName !== null ){
                            
                            $imagenAllOld = $usuario->asObject()->find($id);
                            
                            $imagenOld = $imagenAllOld->imagen;
                             
                            if($imagenOld !== '' && $imagenOld !== null){
                                $imagenOldRute = WRITEPATH.'uploads/avatars/'.$imagenOld;

                                if(file_exists($imagenOldRute)){
                                    unlink($imagenOldRute);
                                }
                            }

                            if($this->request->getPost('type') !== NULL){
                                
                                $usuario->update($id, [
                                    'nombre' => $this->request->getPost('nombre'),     
                                    'type' =>$this->request->getPost('type'),                                                                                                    
                                    'imagen' => $newName,
                                ]);
                                
                            } else {
                                $usuario->update($id, [
                                    'nombre' => $this->request->getPost('nombre'),                                         
                                    'imagen' => $newName,
                                ]);

                            }
                        } else {
                            if($this->request->getPost('type') !== NULL){
                                $usuario->update($id, [
                                    'nombre' => $this->request->getPost('nombre'),                                                                                        
                                    'type' =>$this->request->getPost('type'),                 
                                ]);
                                
                            } else {
                                
                                $usuario->update($id, [
                                    'nombre' => $this->request->getPost('nombre'),                                                                                                                         
                                ]);
                            }

                        }
                        if($this->request->getPost('type') !== NULL){

                            return redirect()->to('/User')->with('message','Usuario Guardado con Exito');
                        } else {
                            
                            return redirect()->to('/control')->with('message','La informacion se modifico con exito');
                        }
                                                
                    } else {
                        
                        return redirect()->to('/User')->with('message','Error al guardar el registro, la imagen no se pudo cargar, intente de nuevo y confirme que sea menor a 4MB');
                    }


                } 

                return redirect()->back()->withInput();
            } else {
                return redirect()->to('/User')->with('message','Intente Editar nuevamente');
            }
        }
    }


    public function delete($token = null){

        $usuario = new UsersModel();
        
        $infoUsuario = $usuario->select('id')->orWhere('id_token',$token)->asObject()->first();
        $id = $infoUsuario->id;

        if ($usuario->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $usuario->delete($id);
        return redirect()->to('/User')->with('message','Usuario Borrado con Exito');
        
    }

    private function _upload(){
        if ($imagefile = $this->request->getFile('imagen')) {

            if ($imagefile->isValid() && ! $imagefile->hasMoved()) {
                $validated = $this->validate([
                    'imagen' => [
                        'uploaded[imagen]',
                        'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[imagen,4096]',
                    ],
                ]);
                if ($validated) {
                    $newName = $imagefile->getRandomName();
                    $imagefile->move(WRITEPATH.'uploads/avatars', $newName);                    
                    return $newName;
                }else{
                    return false;
                }
            } else {
                return null;
            }
            
        }
    }
    
    // ========================================================== //
    //    Funcion de automatizacion para carga de vistas e informacion
    // ========================================================== //
    // private function _loadDefaultView($dataHeader, $data, $view, $dataFooter){


    //     // ========================================================== //
    //     //    Cargando helper de cookies
    //     // ========================================================== //
    //     helper('cookie');
    //     // ========================================================== //
    //     //    Generando sesion inicial
    //     // ========================================================== //
    //     $session = session();
    //     $iniciado = $session->id;
    //     $type = $session->type;
    //     $id = $session->id;
    //     // ========================================================== //
    //     //    Generando cookies para moderadores y administradores
    //     // ========================================================== //
    //     if($session->type == 'administrador' || $session->type == 'moderador'){            
    //         set_cookie("type", $session->type , 1296000);  
    //         set_cookie("id", $session->id , 1296000);  
    //         set_cookie("nombre", $session->nombre , 1296000);  
    //         set_cookie("username", $session->username , 1296000);  
    //         set_cookie("email", $session->email , 1296000);  
    //     }

    //     // ========================================================== //
    //     //    verificando que exista secion abierta
    //     // ========================================================== //
    //     if($iniciado > 0 ){
    //         $iniciado =  true;            
    //     } else {
    //         // ========================================================== //
    //         //    En caso de que no exista, validando si existen cookies de administrador
    //         // ========================================================== //
    //         if(get_cookie("type")){
    //             helper('user');
    //             $user = [
    //                 'id' => get_cookie("id"),
    //                 'nombre' => get_cookie("nombre"),
    //                 'username' => get_cookie("username"),
    //                 'email' => get_cookie("email"),
    //                 'type' => get_cookie("type"),
    //             ];
    //             $session = session();
    //             $session->set($user);
    //             $id = $session->id;
    //             $type = $session->type;
    //             $iniciado = true;
    //         } else {
    //             $iniciado = false;
    //         }

    //     }
        
    //     array_push($dataFooter, $dataFooter['iniciado'] = $iniciado);        
    //     array_push($data, $data['typeUser'] = $type, $data['id'] = $id);

    //     echo view("dashboard/templates/header", $dataHeader);
    //     echo view("dashboard/User/$view", $data );
    //     echo view("dashboard/templates/footer", $dataFooter);
    // }
}


