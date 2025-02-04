<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin\Admin::index');

// Reset Password
$routes->post('resetPassword', 'Home::resetPassword');

// Pages
$routes->get('/cara-membeli', 'Pages::cara_membeli');
$routes->match(['post', 'get'], '/status', 'Pages::status');
$routes->get('/terms', 'Pages::terms');
$routes->get('/faq', 'Pages::faq');
$routes->get('/bantuan', 'Pages::help');

// Provider
$routes->group('provider', ['namespace' => 'App\Controllers'], function(RouteCollection $routes) {
    $routes->get('/admin/provider', 'Provider::index');
    $routes->get('/admin/provider/create', 'Provider::create');
    $routes->post('/admin/provider/store', 'Provider::store');
    $routes->get('/admin/provider/edit/(:num)', 'Provider::edit/$1');
    $routes->post('/admin/provider/update/(:num)', 'Provider::update/$1');
    $routes->get('/admin/provider/delete/(:num)', 'Provider::delete/$1');
});

// Deposit
$routes->get('/deposit', 'Deposit::deposit');
$routes->match(['post', 'get'], '/deposit', 'Deposit::deposit');

$routes->match(['post', 'get'], '/profile', 'Pages::profile');
$routes->get('/logout', 'Home::logout');

// API VIP
$routes->get('/admin/profile-vip', 'Sistem::profile_vip');
$routes->get('/admin/get-services-vip', 'Sistem::get_services_vip');

// API DIGIFLAZZ
$routes->get('/admin/ceksaldodf', 'Sistem::CekSaldoDigiflazz');

// Tripay Status
$routes->get('/tripay/status', 'Sistem::tripay');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
