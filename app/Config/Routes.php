<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// ========================================================== //
//    Manejo de imagenes
// ========================================================== //
$routes->get('/image', 'Home::image');
$routes->get('/image/(:any)/(:any)', 'Home::image/$1/$2',['as'=> 'get_image']);


// ========================================================== //
//    Rutas de login y recuperacion de pass
// ========================================================== //
$routes->get('/login', 'web/User::login', ['as' => 'user_login_get']);
$routes->get('/registrarse', 'web/User::registrarse', ['as' => 'user_register_get']);
$routes->post('/login_post', 'web/User::login_post', ['as' => 'user_login_post']);
$routes->get('/logout', 'web/User::logout', ['as' => 'user_logout']);
$routes->post('/register', 'web/User::registro', ['as' => 'registro']);
$routes->get('/cookie', 'Myhelper::cookie');

$routes->get('/recuperar', 'web/User::recuperarPass', ['as' => 'recuperar_pass_get']);
$routes->post('/recuperar_post', 'web/User::recuperarPass_post', ['as' => 'recuperar_pass_post']);

$routes->get('/cambiar_pass/', 'web/User::cambiarPass/');
$routes->post('/cambiar_pass_post', 'web/User::cambiarPass_post', ['as' => 'cambiar_pass_post']);


// ========================================================== //
//    Rutas home
// ========================================================== //
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// ========================================================== //
//    rutas de usuario
// ========================================================== //
$routes->resource('user', ['except' => ['show']]);

// ========================================================== //
//    Rutas base panel de control
// ========================================================== //

$routes->get('/control', 'panelControl/Control::index');


// ========================================================== //
//    Ruta para news letter
// ========================================================== //
$routes->resource('newsletter', ['except' => ['show']]);
$routes->post('/register-newsletter', 'Newsletter::register');
$routes->get('/control/newsletter', 'Newsletter::index');
// ========================================================== //
//    Ruta para Datos
// ========================================================== //
$routes->resource('Datos', ['except' => ['show']]);
$routes->post('/register-data', 'Datos::register');
$routes->get('/control/datos', 'Datos::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
