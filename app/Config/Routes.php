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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

// Vote Routes
$routes->get('/pilih', 'Pilih');
$routes->get('/pilih/getOneData/(:any)', 'Pilih::getOneData/$1');
$routes->post('/pilih/cek', 'Pilih::cek');

// login routes
$routes->get('/login', 'Login::index');
$routes->get('/login/admin', 'Login::loginAdmin');
$routes->post('/cekLoginAdmin', 'Login::cekLoginAdmin');
$routes->post('/cekLogin', 'Login::cekLoginPeserta');

// logout routes
$routes->get('/logoutAdmin', 'Logout::admin');



// admin routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes)
{
   // get routes
   $routes->get('/', 'Dashboard');
   $routes->get('dashboard', 'Dashboard');
   $routes->get('dashboard/editAcara/(:num)', 'Dashboard::editAcara/$1');
   $routes->get('kandidat', 'Kandidat');
   $routes->get('kandidat/view/(:any)', 'Kandidat::view/$1');
   $routes->get('kandidat/edit/(:any)', 'Kandidat::edit/$1');
   $routes->get('peserta/', 'Peserta');
   $routes->get('peserta/getOneData/(:any)', 'Peserta::getOneData/$1');
   $routes->get('hasilVoting', 'Hasil');
   $routes->get('laporan/kandidat', 'LaporanKandidat');
   $routes->get('laporan/peserta', 'LaporanPeserta');
   $routes->get('laporan/hasil', 'LaporanHasil');
   $routes->get('profile', 'Profile');
   $routes->get('setting', 'Setting');
   
   // post routes
   $routes->post('kandidat/add', 'Kandidat::add');
   $routes->post('kandidat/update/(:any)', 'Kandidat::update/$1');
   $routes->post('peserta', 'Peserta');
   $routes->post('peserta/add', 'Peserta::add');
   $routes->post('peserta/edit', 'Peserta::edit');
   $routes->post('peserta/uploadExcel', 'Peserta::uploadExcel');
   $routes->post('cetakPdf/kandidat', 'LaporanKandidat::cetakPdf');
   $routes->post('cetakPdf/peserta', 'LaporanPeserta::cetakPdf');
   $routes->post('cetakExcel/peserta', 'LaporanPeserta::cetakExcel');
   $routes->post('cetakPdf/hasil', 'LaporanHasil::cetakPdf');
   $routes->post('editProfile/profile', 'Profile::editProfile');
   $routes->post('editProfile/password', 'Profile::editPassword');
   $routes->post('setting/edit', 'Setting::edit');
   
   // delete routes
   $routes->delete('kandidat/hapus/(:any)', 'Kandidat::hapus/$1');
   $routes->delete('peserta/hapus/(:any)', 'Peserta::hapus/$1');
});


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
