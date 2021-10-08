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

//Portal Berita Content___________________________________________________________________________________________________________
$routes->get('/content/home', 'ContentController::dashboardPortal');
$routes->get('/content/berita-detail', 'ContentController::detail');
$routes->post('/content/search-article', 'ContentController::searchArtikel');
$routes->get('/content/semua-informasi', 'ContentController::semuaInformasi');
$routes->get('/content/semua-berita', 'ContentController::semuaBerita');
$routes->get('/content/semua-artikel', 'ContentController::semuaArtikel');
$routes->get('/content/visi-misi', 'ContentController::visiMisi');
$routes->get('/content/semua-album-foto', 'ContentController::albumFoto');
$routes->get('/content/semua-album-video', 'ContentController::albumVideo');
$routes->get('/content/(:any)', 'ContentController::detailBerita/$1');

//Administrator Portal Login_______________________________________________________________________________________________________
$routes->get('/auth/login', 'AuthController::index');

//Admin Portal
$routes->get('/administrator/index', 'AdminController::index', ['filter' => 'auth']);

//Admin Portal Master_____________________________________________________________________________________________________________
$routes->get('/administrator/master/dashboard', 'MasterController::index', ['filter' => 'auth']);

//AdminPortal Pemda________________________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/dashboard', 'PemdaController::index', ['filter' => 'auth']);

//Admin Portal Pemda Visi___________________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/visi/v_visi', 'PemdaController::visipemda', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/visi/edit/(:segment)', 'PemdaController::visiEdit/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/visi/(:num)', 'PemdaController::visiHapus/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/visi/(:any)', 'PemdaController::visiDetail/$1', ['filter' => 'auth']);

//Admin Portal Pemda Misi__________________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/misi/v_misi', 'PemdaController::misipemda', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/misi/edit/(:segment)', 'PemdaController::misiEdit/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/misi/(:num)', 'PemdaController::misiHapus/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/misi/(:any)', 'PemdaController::misiDetail/$1', ['filter' => 'auth']);

//Admin Portal Pemda Pejabat
$routes->get('/administrator/portal-pemda/pejabat/v_pejabat', 'PejabatController::pejabatPemda', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/pejabat/(:num)', 'PejabatController::hapusPpejabat/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/pejabat/(:any)', 'PejabatController::detailPpejabat/$1', ['filter' => 'auth']);


//AdminPortal Pemda Tambah Artikel
$routes->get('/administrator/portal-pemda/tambah-artikel', 'PemdaController::tambahArtikel', ['filter' => 'auth']);

//AdminPortal Pemda Berita
$routes->get('/administrator/portal-pemda/berita/home', 'PemdaController::berita', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/edit/(:segment)', 'PemdaController::editBerita/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/berita/(:num)', 'PemdaController::hapusBerita/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/(:any)', 'PemdaController::detailBerita/$1', ['filter' => 'auth']);


//AdminPortal Pemda Informasi
$routes->get('/administrator/portal-pemda/informasi/home', 'PemdaController::informasi', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/informasi/edit/(:segment)', 'PemdaController::editInformasi/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/informasi/(:num)', 'PemdaController::hapusInformasi/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/informasi/(:any)', 'PemdaController::detailInformasi/$1', ['filter' => 'auth']);

//AdminPortal Pemda Slide Show
$routes->get('/administrator/portal-pemda/slideshow/home', 'PemdaController::slideShow', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/slideshow/edit/(:segment)', 'PemdaController::editSlideshow/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/slideshow/(:num)', 'PemdaController::hapusSlideshow/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/slideshow/(:any)', 'PemdaController::detailslideshow/$1', ['filter' => 'auth']);

//AdminPortal Pemda Album Foto
$routes->get('/administrator/portal-pemda/album-foto/home', 'PemdaController::albumFoto', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/album-foto/edit/(:segment)', 'PemdaController::editAlbumfoto/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/album-foto/(:num)', 'PemdaController::hapusAbumfoto/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/album-foto/(:any)', 'PemdaController::detailAlbumfoto/$1', ['filter' => 'auth']);

//AdminPortal Pemda Album Video
$routes->get('/administrator/portal-pemda/album-video/home', 'PemdaController::albumVideo', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/album-video/edit/(:segment)', 'PemdaController::editAlbumvideo/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/album-video/(:num)', 'PemdaController::hapusAlbumvideo/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/album-video/(:any)', 'PemdaController::detailAlbumvideo/$1', ['filter' => 'auth']);

//AdminPortal OPD_________________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/dashboard', 'OPDController::index', ['filter' => 'auth']);

//AdminPortal E-SAKIP_________________________________________________________________________________________________________________________________
$routes->get('/administrator/e-sakip/dashboard', 'OPDController::index', ['filter' => 'auth']);


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
