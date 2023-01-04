<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require APPPATH.'ThirdParty/PHPMailer/Exception.php';
require APPPATH.'ThirdParty/PHPMailer/PHPMailer.php';
require APPPATH.'ThirdParty/PHPMailer/SMTP.php';

class Mail extends BaseController
{
	
	public function mail()
	{   
        if(isset($_POST['google-response-token']) || isset($_POST['google-response-token-2'])){
            if(isset($_POST['google-response-token'])){
                $filter = $_POST['google-response-token'];
            }else {
                $filter = $_POST['google-response-token-2'];
            }
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
                if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['msg'])){
                
                    // ========================================================== //
                    //    asignando variables post
                    // ========================================================== //
                    $nombre = $_POST['nombre'];
                    $correo = $_POST['correo'];                   
                    $msg = $_POST['msg'];
                    // ========================================================== //
                    //    configuraciones phpmailer
                    // ========================================================== //
                    $mailing = new PHPMailer(true);
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
                        $mailing->Port       = 587;    // #465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above 
                        //Recipients
                        // $mailing->addAddress('rogelio.guzman@meridasoft.com');  
                        $mailing->addAddress('rogelio.guzman@fundatusitioweb.com');  
                        

                        
                        // $mailing->addAddress('daniel.oliver@fundatusitioweb.com');  
                        
                        $mailing->setFrom(EMAILUSER,"Contacto ".PROYECTNAME);            
                                                
                        
                                    //Name is optional
                        //Attachments
                        // $mailing->addAttachment(dirname(__DIR__,2).'\public\img\home\amesi_1.png');         //Add attachments
                        // $mailing->addAttachment(dirname(__DIR__,2).'\public\img\home\amesi_2.png');    //Optional name
                        // $mailing->addAttachment(dirname(__DIR__,2).'\public\img\home\amesi_3.png');    //Optional name
                        //Content
                        $mailing->CharSet = 'UTF-8';
                        $mailing->isHTML(true);                                  //Set email format to HTML
                        $mailing->Subject = "Envío de correo desde formulario de contacto";
                        // preparando body
                        $body = "<p>Nombre: ".$nombre."</p><br>";
                        $body .= "<p>Correo: ".$correo."</p><br>";                
                        $body .= "<p>Mensaje: ".$msg."</p><br>";                        
                        // Asignando body
                        $mailing->Body  = $body;
                        // $mailing->AltBody = $mensaje;
                        // ========================================================== //
                        //    Asignando vista si se envia correctamente
                        // ========================================================== //
                        if($mailing->send()){ 
                          
                            $respuesta = array(
                                'respuesta' => 'exito',                                
                            );
                            
                        } else { 
                            $respuesta = array(
                                'respuesta' => 'error',                                
                            );
                        }    
                        die(json_encode($respuesta));
                        // echo 'Message has been sent';
                    // ========================================================== //
                    //    Configurar pagina de error de envio pendiente
                    // ========================================================== //
                    } catch (Exception $e) {
                        $respuesta = array(
                            'respuesta' => 'configuracion',                                
                        );
                        die(json_encode($respuesta));
                    }
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
