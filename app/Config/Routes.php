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

//Visi Misi
$routes->get('/content/visi-misi', 'ContentController::visiMisi');


$routes->get('/content/semua-album-foto', 'ContentController::albumFoto');
$routes->get('/content/album-foto-detail', 'ContentController::albumFotodetail');
//Detail Berita
$routes->get('/content/(:any)', 'ContentController::detailBerita/$1');

//UserPortal
$routes->get('/auth/login', 'AuthController::index');

//AdminPortal
$routes->get('/administrator/index', 'AdminController::index', ['filter' => 'auth']);

//AdminMaster
$routes->get('/administrator/master/dashboard', 'MasterController::index', ['filter' => 'auth']);

//AdminPortalPemda Dashboard
$routes->get('/administrator/portal-pemda/dashboard', 'PemdaController::index', ['filter' => 'auth']);

//AdminPortalPemda Visi
$routes->get('/administrator/portal-pemda/visi/v_visi', 'PemdaController::visipemda', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/visi/(:num)', 'PemdaController::hapusVisi/$1', ['filter' => 'auth']);

//AdminPortalPemda MIsi
$routes->get('/administrator/portal-pemda/misi/v_misi', 'PemdaController::misipemda', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/misi/(:num)', 'PemdaController::hapusMisi/$1', ['filter' => 'auth']);

//AdminPortalPemda Pejabat
$routes->get('/administrator/portal-pemda/pejabat/v_pejabat', 'PejabatController::pejabatPemda', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/pejabat/tambah', 'PemdaController::pejabatTambah', ['filter' => 'auth']);

//Tambah Artikel
$routes->get('/administrator/portal-pemda/tambah-artikel', 'PemdaController::tambahArtikel', ['filter' => 'auth']);

//AdminPortalPemda Berita
$routes->get('/administrator/portal-pemda/berita/home', 'PemdaController::berita', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/edit/(:segment)', 'PemdaController::editBerita/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/berita/(:num)', 'PemdaController::hapusBerita/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/(:any)', 'PemdaController::detailBerita/$1', ['filter' => 'auth']);

//AdminPortalPemda Informasi
$routes->get('/administrator/portal-pemda/informasi/home', 'PemdaController::informasi', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/informasi/tambah', 'PemdaController::tambahinformasi', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/informasi/edit/(:segment)', 'PemdaController::editinformasi/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/informasi/(:num)', 'PemdaController::hapusInformasi/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/informasi/(:any)', 'PemdaController::detailInformasi/$1', ['filter' => 'auth']);



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
