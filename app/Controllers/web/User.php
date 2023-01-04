<?php 
namespace App\Controllers\web;


use App\Models\UsersModel;
use App\Models\UsersCreateModel;
use App\Models\RecoveryModel;
use App\Controllers\BaseController;
use App\Models\UsersNotificationModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Libraries; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH.'ThirdParty/PHPMailer/Exception.php';
require APPPATH.'ThirdParty/PHPMailer/PHPMailer.php';
require APPPATH.'ThirdParty/PHPMailer/SMTP.php';


class User extends BaseController {

    public function login()
    {
        
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME .' | Iniciar Secion',
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
            
        ];
        // $Juegosfrecuentes = new JuegosfrecuentesModel();
        // $data = [
        //     'juegos' => $Juegosfrecuentes->asObject()->paginate(18),
        //     'pager' => $Juegosfrecuentes->pager
        // ];
        $dataFooter = [
            'js' => '            
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("'.RECAPCHAPUBLIC.'", {action: "homepage"})
                    .then(function(token) {                        
                        $("#google-response-token").val(token);                        
                        $("#google-response-token2").val(token);                        
                    });
                });
                
            </script>',
        ];
        cargarVistaLogin($dataHeader, [], 'login', $dataFooter);
        // testingText();
        return $this->_redirectAuth();
    }
    public function registrarse()
    {
        
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME .' | Registrarse',
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
            
        ];
        
        $dataFooter = [
            'js' => '
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("'.RECAPCHAPUBLIC.'", {action: "homepage"})
                    .then(function(token) {                        
                        $("#google-response-token").val(token);                        
                        $("#google-response-token2").val(token);                        
                    });
                });
            </script>',
        ];
        cargarVistaLogin($dataHeader, [], 'registrarse', $dataFooter);

        return $this->_redirectAuth();
    }
    public function login_post()
    {
        helper('user');
        $userModel = new UsersModel();

        $emailUserName = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->select('id_token, nombre, password, username, email, type, imagen, faccion, sup')->orWhere('email',$emailUserName)->orWhere('username',$emailUserName)->first();
        
        if(!$user){

            return redirect()->back()->with('message', 'Usuario y/o contraseña incorrecto');            

        }

        if(verifyPassword($password,$user['password'])){
            // construir sesion
            
            unset($user['password']);
            // var_dump($user);            
            $session = session();
            $session->set($user);
      
            // $this->load->helper('cookie');
            // $this->input->set_cookie("id", $session->id,3600, "www.midominio.com");
            return $this->_redirectAuth();
        } 

        return redirect()->back()->with('message', 'Usuario y/o contraseña incorrecto');
        
    }
    public function notifyActivate()
    {
               
        $UsersNotificationModel = new UsersNotificationModel();

       
        if($this->validate('users_active_notifications')){
                
            $user_id =  $this->request->getPost('user_id');
            $token =  $this->request->getPost('token');  
            
            $user = $UsersNotificationModel->select('token')->orWhere('token',$token)->first();


            
                                                            
    
            
            if(!$user){

                $id = $UsersNotificationModel->insert([
                    'user_id' => $this->request->getPost('user_id'),
                    'token' => $token,      
                ]);
                
                $respuesta = array(
                    'respuesta' => 'registrado'
                );
                
                die(json_encode($respuesta));

                
                
                
            } else if($user['token'] == $token){
                
                $respuesta = array(
                    'respuesta' => 'existente'
                );
                
                die(json_encode($respuesta));


            }else {
                
                
                $respuesta = array(
                    'respuesta' => 'error'
                );
                
                die(json_encode($respuesta));
               
            }
            

            
                
                
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
            
            die(json_encode($respuesta));
        }
        
    }
    public function logout()
    {
        
        $session = session();
        $session->destroy();
        return redirect()->to("/login");
        
    }

    public function registro(){
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

                    $email = $this->request->getPost('email');                    
                    $password = $this->request->getPost('password');
                    $token = createHash(10,2);
                        
                    $id = $usuario->insert([
                        'nombre' => $this->request->getPost('nombre'),
                        'username' => $this->request->getPost('username'),
                        'email' => $email ,      
                        'id_token' => $token,                          
                        'password' => hashPassword($password), 
                    ]);
                                                                    
            
                    $user = $usuario->select('id_token, nombre, password, username, email, type, imagen, faccion, sup')->orWhere('email',$email)->first();
                    
                    if(!$user){
            
                        return redirect()->back()->with('message', 'Usuario y/o contraseña incorrecto');            
            
                    }
            
                    if(verifyPassword($password,$user['password'])){
                        // construir sesion
                        unset($user['password']);
                        // var_dump($user);
                        $session = session();
                        $session->set($user);                        
                        return redirect()->to("/")->with('message','Usuario Creado con Exito');
                    }  

                    return redirect()->to('/login')->with('message','Error, intente de nuevo');
                        
                        
                    
                    // $usuario->save([
                    //     'User' => $this->request->getPost('User'),
                    //     'description' =>$this->request->getPost('descripcion')
                    // ]);

                    // $this->_upload();

                    // return redirect()->to('/User/new')->with('message','User: <b style="font-weight: bold;" >'.$this->request->getPost('User').'</b> - Guardado con Exito');
                } 
                return redirect()->to('/login')->with('message','Error al registrarse, puede que el usuario/correo ya se encuentre en uso, intente de nuevo o pruebe con otros datos');
            } else {
                return redirect()->to('/login')->with('message','Error al registrarse, intente de nuevo');
            }
        }
    }
   
    private function _redirectAuth(){
        $session = session();
        if($session->type == "administrador" || $session->type == "editor" ){
            return redirect()->to("/control")->with('message', 'Hola '.$session->username);
        } else if($session->type == 'editor'){
            return redirect()->to("/")->with('message', 'Hola '.$session->username);            
        } else if($session->type == 'usuario'){
            return redirect()->to("/")->with('message', 'Hola '.$session->username);

        }
    }


    // ========================================================== //
    //    Funciones para recuperacion de contraseña
    // ========================================================== //

    
    public function recuperarPass()
    {
       
        
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME .' | Recupera tu contraseña',
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
            
        ];
        // $Juegosfrecuentes = new JuegosfrecuentesModel();
        // $data = [
        //     'juegos' => $Juegosfrecuentes->asObject()->paginate(18),
        //     'pager' => $Juegosfrecuentes->pager
        // ];
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
        cargarVistaLogin($dataHeader, [], 'recuperarPass', $dataFooter);

        return $this->_redirectAuth();
    }
    public function recuperarPass_post()
    {
        $dataHeader = [
            'metas' => '',
            'title' => PROYECTNAME .' | Recupera tu contraseña',
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
            
        ];
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
                $pass = EMAILPASS;
                $correo = EMAILUSER;
                $server = EMAILSERVER;


                helper('user');
                $recoveryModel = new RecoveryModel();

                $emailUserName = $this->request->getPost('email');        

                $user = $recoveryModel->select('id, email, token')->orWhere('email',$emailUserName)->first();
    
                
                if(!$user){
                            
                    cargarVistaLogin($dataHeader, [], 'mailEnviado', []);
                    return;
                } 
                
                // ========================================================== //
                //    Generador de token y envio de mail
                // ========================================================== //
                $mailing = new PHPMailer(true);
                $tokenGenerate =  createHash(50,2);

                $id = $user['id'];

                $recoveryModel->update($id, [
                    'token' => $tokenGenerate,                                                                
                ]);

                try {
                    //Server settings
                    $mailing->SMTPDebug = 0;                                         //Enable verbose debug output
                    $mailing->isSMTP();                                              //Send using SMTP
                    $mailing->Host       = EMAILSERVER;                     //Set the SMTP server to send through
                    $mailing->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mailing->SMTPOptions = array(
                                                'ssl' => array(
                                                    'verify_peer' => false,
                                                    'verify_peer_name' => false,
                                                    'allow_self_signed' => true
                                                )
                                            );
                    $mailing->Username   = EMAILUSER;                     //SMTP username
                    $mailing->Password   = EMAILPASS;                               //SMTP password
                    $mailing->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mailing->Port       = 587;  #465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above 
                    //Recipients
                    $mailing->setFrom(EMAILUSER, PROYECTNAME." recovery");            
                    $mailing->addAddress($emailUserName);  
                    
                    
                    $mailing->CharSet = 'UTF-8';
                    $mailing->isHTML(true);                                  //Set email format to HTML
                    $mailing->Subject = "Tu link para recuperar el acceso a ".PROYECTNAME;
                    // preparando body
                    // $ruta = '/cambiar_pass?token='.$tokenGenerate.'&correo='.$emailUserName;

                    $body = '<p>
                        Hola! te envio tu link de recuperacion de contraseña <br>
                        Da click en el siguiente enlance o copialo directamente en tu navegador
                        </p>
                        <a href="'.URLBASEGENERAL.'cambiar_pass?token='.$tokenGenerate.'&correo='.$emailUserName.'">Cambiar Contraseña</a>
                    ';
                    // Asignando body
                    $mailing->Body  = $body;
                    // $mailing->AltBody = $mensaje;
                    // ========================================================== //
                    //    Asignando vista si se envia correctamente
                    // ========================================================== //
                    if($mailing->send()){ 
                        cargarVistaLogin($dataHeader, [], 'mailEnviadoExiste', []);
                        return;
                    } else {
                        cargarVistaLogin($dataHeader, [], 'mailEnviadoError', []);
                        return;
                    }    
                    
                // ========================================================== //
                //    Configurar pagina de error de envio pendiente
                // ========================================================== //
                } catch (Exception $e) {
                    cargarVistaLogin($dataHeader, [], 'mailEnviadoError', []);
                    return;
                }  

            } else {
                cargarVistaLogin($dataHeader, [], 'mailEnviadoError', []);
                return;
            }
        }

        
    }
    public function cambiarPass($token = null, $correo = null)
    {        
        $dataHeader = [
            'metas' => '',
			'title' => PROYECTNAME ." | $token",
            'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
            // "criticalcss"=>"",
            // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
            // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
            
        ];
        // $Juegosfrecuentes = new JuegosfrecuentesModel();
        // $data = [
        //     'juegos' => $Juegosfrecuentes->asObject()->paginate(18),
        //     'pager' => $Juegosfrecuentes->pager
        // ];
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
        helper('user');
        $recoveryModel = new RecoveryModel();
        // ========================================================== //
        //    Validar que exista token
        // ========================================================== //
        if(isset($_GET['token']) && isset($_GET['correo']) ){
            $token = $_GET['token'];
            $correo = $_GET['correo'];
        } else {
            return redirect()->to('/login');
        }


        // ========================================================== //
        //    validar que el token y correo existan
        // ========================================================== //
        $user = $recoveryModel->select('id, email, token')->orWhere('token', $token)->first();

        if(!$user){ 
            cargarVistaLogin($dataHeader, [], 'recuperacionError', []);
            return;
        }
        if($user['email'] !== $correo ){ 
            cargarVistaLogin($dataHeader, [], 'recuperacionError', []);
            return;
        }
        


        
        cargarVistaLogin($dataHeader, ['token' => $token, 'correo' => $correo], 'cambiarPass', $dataFooter);


        // return $this->_redirectAuth();
    }
    public function cambiarPass_post()
    {       
        if(isset($_POST['google-response-token']) ){
            $dataHeader = [
                'metas' => '',
                'title' => PROYECTNAME .' | Error en el proceso',
                'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
                // "criticalcss"=>"",
                // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
                // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
                
            ];
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

                $email =  $this->request->getPost('email'); 
                $token =  $this->request->getPost('token'); 
                $password =  $this->request->getPost('password'); 

                

                helper('user');
                $recoveryModel = new RecoveryModel();


                // ========================================================== //
                //    validar que el token y correo existan
                // ========================================================== //
                $user = $recoveryModel->select('id, email, token')->orWhere('token', $token)->first();


                if(!$user){ 
                    cargarVistaLogin($dataHeader, [], 'recuperacionError', []);
                    return;
                }
                

                $id = $user['id'];

                $recoveryModel->update($id, [
                    'password' => hashPassword($password),
                    'token' => '',
                ]);

                // ========================================================== //
                //    Inicio de secion automatico
                // ========================================================== //
                $userModel = new UsersModel();                               
                $user = $userModel->select('id, nombre, password, username, email, type')->orWhere('email',$email)->first();                        
                $session = session();
                $session->set($user);
            
                   
                $dataHeader2 = [
                    'metas' => '',
                    'title' => PROYECTNAME .' | Cambiaste tu contraseña correctamente',
                    'recapcha' => '<script src="https://www.google.com/recaptcha/api.js?render='.RECAPCHAPUBLIC.'"></script>', 
                    // "criticalcss"=>"",
                    // 'css_asinc_font_awesome' => 'media="print" onload="this.media=&apos;all&apos;"',
                    // 'css'=> '<link rel="stylesheet" href="/css/Juegosfrecuentes/Juegosfrecuentes.css"/>',
                    
                ];
               
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
                cargarVistaLogin($dataHeader2, [], 'cambiarPassConfirmado', $dataFooter);
                
            } else {
                cargarVistaLogin($dataHeader, [], 'recuperacionError', []);
            }
        }
    }
    
}


