<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('ContentController');
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

//PortalBerita
$routes->get('/content/berita-detail', 'ContentController::detail');
$routes->get('/content/semua-berita-informasi', 'ContentController::semuaberitainformasi');
$routes->get('/content/visi-misi', 'ContentController::visiMisi');
$routes->get('/content/semua-album-foto', 'ContentController::albumFoto');
$routes->get('/content/album-foto-detail', 'ContentController::albumFotodetail');

//UserPortal
$routes->get('/auth/login', 'AuthController::index');
$routes->get('/auth/register', 'AuthController::register');


//AdminPortal
$routes->get('/administrator/index', 'AdminController::index', ['filter' => 'auth']);

//AdminMaster
$routes->get('/administrator/master/dashboard', 'MasterController::index', ['filter' => 'auth']);

//AdminPortalPemda
$routes->get('/administrator/portal-pemda/dashboard', 'PemdaController::index', ['filter' => 'auth']);

$routes->get('/administrator/portal-pemda/visi', 'PemdaController::visipemda', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/misi', 'PemdaController::misipemda', ['filter' => 'auth']);

$routes->get('/administrator/portal-pemda/pejabat', 'PemdaController::pejabatpemda', ['filter' => 'auth']);

$routes->get('/administrator/portal-pemda/berita/home', 'PemdaController::berita', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/tambah', 'PemdaController::tambahberita', ['filter' => 'auth']);




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
