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

//Portal Berita Content_________________________________________________________________________________________________________
$routes->get('/content/home', 'ContentController::dashboardPortal');
$routes->get('/content/opd', 'OPDController::index');
$routes->get('/content/berita-detail', 'ContentController::detail');
$routes->post('/content/search-article', 'ContentController::searchArtikel');
$routes->get('/content/semua-informasi', 'ContentController::semuaInformasi');
$routes->get('/content/semua-berita', 'ContentController::semuaBerita');
$routes->get('/content/semua-artikel', 'ContentController::semuaArtikel');
$routes->get('/content/visi-misi', 'ContentController::visiMisi');
$routes->get('/content/semua-album-foto', 'ContentController::albumFoto');
$routes->get('/content/semua-album-video', 'ContentController::albumVideo');
$routes->get('/content/(:any)', 'ContentController::detailBerita/$1');

//Administrator Portal Login_____________________________________________________________________________________________________
$routes->get('/auth/login', 'AuthController::index');
$routes->get('/logout', 'AuthController::logout');

//Hak Akses________________________________________________________________________________________________________________________
$routes->get('/administrator/index', 'AdminController::index', ['filter' => 'auth']);
$routes->get('/administrator/hak-akses', 'AdminController::hakAkses', ['filter' => 'auth']);
$routes->get('/administrator/view-hak-akses', 'AdminController::hakAksesview', ['filter' => 'auth']);
$routes->get('/ambilakses/(:any)', 'AdminController::settingChecked/$1/$2', ['filter' => 'auth']);

//Admin Portal Master_____________________________________________________________________________________________________________
$routes->get('/administrator/master/dashboard', 'MasterController::index', ['filter' => 'auth']);

$routes->get('/administrator/master/v_pegawai', 'MasterController::pegawaiHome', ['filter' => 'auth']);
$routes->post('/prosesaddPegawai', 'MasterController::prosesaddPegawai', ['filter' => 'auth']);
$routes->delete('/hapuspegawai', 'MasterController::hapusPegawai', ['filter' => 'auth']);


$routes->get('/administrator/master/v_bidang', 'MasterController::bidang', ['filter' => 'auth']);
$routes->post('/addbidang', 'MasterController::addBidang', ['filter' => 'auth']);
$routes->put('/updatebidang', 'MasterController::updateBidang', ['filter' => 'auth']);
$routes->delete('/hapusbidang', 'MasterController::hapusBidang', ['filter' => 'auth']);


$routes->get('/administrator/master/v_jabatan', 'MasterController::jabatan', ['filter' => 'auth']);
$routes->post('/addjabatan', 'MasterController::addJabatan', ['filter' => 'auth']);
$routes->put('/updatejabatan', 'MasterController::updateJabatan', ['filter' => 'auth']);
$routes->delete('/deletejabatan', 'MasterController::deleteJabatan', ['filter' => 'auth']);


















// =============================================================== PEMDA PORTAL ========================================================================// 

//AdminPortal Pemda________________________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/dashboard', 'PemdaController::index', ['filter' => 'auth']);

//Admin Portal Pemda Visi___________________________________________________________________________________________________________
// $routes->get('/administrator/portal-pemda/visi/v_visi', 'PemdaController::visipemda', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/visi/edit/(:segment)', 'PemdaController::visiEdit/$1', ['filter' => 'auth']);
// $routes->delete('/administrator/portal-pemda/visi/(:num)', 'PemdaController::visiHapus/$1', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/visi/(:any)', 'PemdaController::visiDetail/$1', ['filter' => 'auth']);

//Admin Portal Pemda Misi__________________________________________________________________________________________________________
// $routes->get('/administrator/portal-pemda/misi/v_misi', 'PemdaController::misipemda', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/misi/edit/(:segment)', 'PemdaController::misiEdit/$1', ['filter' => 'auth']);
// $routes->delete('/administrator/portal-pemda/misi/(:num)', 'PemdaController::misiHapus/$1', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/misi/(:any)', 'PemdaController::misiDetail/$1', ['filter' => 'auth']);

//Admin Portal Pemda Pejabat_____________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/pejabat/v_pejabat', 'PejabatController::pejabatPemda', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/pejabat/(:num)', 'PejabatController::hapusPpejabat/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/pejabat/(:any)', 'PejabatController::detailPpejabat/$1', ['filter' => 'auth']);


//AdminPortal Pemda Tambah Artikel_____________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/tambah-artikel', 'PemdaController::tambahArtikel', ['filter' => 'auth']);

//AdminPortal Pemda Berita_____________________________________________________________________________________________________
$routes->get('/administrator/portal-pemda/berita/home', 'PemdaController::berita', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/edit/(:segment)', 'PemdaController::editBerita/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-pemda/berita/(:num)', 'PemdaController::hapusBerita/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-pemda/berita/(:any)', 'PemdaController::detailBerita/$1', ['filter' => 'auth']);


//AdminPortal Pemda Informasi_____________________________________________________________________________________________________
// $routes->get('/administrator/portal-pemda/informasi/home', 'PemdaController::informasi', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/informasi/edit/(:segment)', 'PemdaController::editInformasi/$1', ['filter' => 'auth']);
// $routes->delete('/administrator/portal-pemda/informasi/(:num)', 'PemdaController::hapusInformasi/$1', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/informasi/(:any)', 'PemdaController::detailInformasi/$1', ['filter' => 'auth']);

//AdminPortal Pemda Slide Show_____________________________________________________________________________________________________
// $routes->get('/administrator/portal-pemda/slideshow/home', 'PemdaController::slideShow', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/slideshow/edit/(:segment)', 'PemdaController::editSlideshow/$1', ['filter' => 'auth']);
// $routes->delete('/administrator/portal-pemda/slideshow/(:num)', 'PemdaController::hapusSlideshow/$1', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/slideshow/(:any)', 'PemdaController::detailslideshow/$1', ['filter' => 'auth']);

//AdminPortal Pemda Album Foto_____________________________________________________________________________________________________
// $routes->get('/administrator/portal-pemda/album-foto/home', 'PemdaController::albumFoto', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/album-foto/edit/(:segment)', 'PemdaController::editAlbumfoto/$1', ['filter' => 'auth']);
// $routes->delete('/administrator/portal-pemda/album-foto/(:num)', 'PemdaController::hapusAbumfoto/$1', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/album-foto/(:any)', 'PemdaController::detailAlbumfoto/$1', ['filter' => 'auth']);

//AdminPortal Pemda Album Video_____________________________________________________________________________________________________
// $routes->get('/administrator/portal-pemda/album-video/home', 'PemdaController::albumVideo', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/album-video/edit/(:segment)', 'PemdaController::editAlbumvideo/$1', ['filter' => 'auth']);
// $routes->delete('/administrator/portal-pemda/album-video/(:num)', 'PemdaController::hapusAlbumvideo/$1', ['filter' => 'auth']);
// $routes->get('/administrator/portal-pemda/album-video/(:any)', 'PemdaController::detailAlbumvideo/$1', ['filter' => 'auth']);


//AdminPortal OPD Berita_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/berita/v_berita', 'OPDController::vBerita', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/artikel-tambah', 'OPDController::tambahArtikel', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/artikel-edit/(:segment)', 'OPDController::artikelEdit/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/publish/(:segment)', 'OPDController::publishArtikel/$1', ['filter' => 'auth']);


$routes->get('/administrator/portal-opd/penarikan-artikel/(:segment)', 'OPDController::artikelPenarikan/$1', ['filter' => 'auth']);


$routes->delete('/administrator/portal-opd/(:num)', 'OPDController::hapusOpdArtikel/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/detail-artikel/(:any)', 'OPDController::detailArtikel/$1', ['filter' => 'auth']);


// =========================================== OPD PORTAL ADMIN ==================================================// 

//AdminPortal OPD Informasi_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/informasi/v_informasi', 'OPDController::vInformasi', ['filter' => 'auth']);


//AdminPortal OPD Foto_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/foto/v_foto', 'OPDController::vFoto', ['filter' => 'auth']);

//AdminPortal OPD Video_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/video/v_video', 'OPDController::vVideo', ['filter' => 'auth']);

//AdminPortal OPD Visi_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/visi/v_visi', 'OPDController::vVisi', ['filter' => 'auth']);

//AdminPortal OPD Misi_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/misi/v_misi', 'OPDController::vMisi', ['filter' => 'auth']);

//AdminPortal OPD Slide_____________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/slide/v_slide', 'OPDController::vSlide', ['filter' => 'auth']);

//AdminPortal OPD_________________________________________________________________________________________________________________________________
$routes->get('/administrator/portal-opd/dashboard', 'OPDController::indexAdmin', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/v_opd', 'OPDController::vOPD', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/v_edit/(:segment)', 'OPDController::opdEdit/$1', ['filter' => 'auth']);
$routes->delete('/administrator/portal-opd/(:num)', 'OPDController::opdHapus/$1', ['filter' => 'auth']);
$routes->get('/administrator/portal-opd/(:any)', 'OPDController::opdDetail/$1', ['filter' => 'auth']);


// =========================================== OPD PORTAL CONTENT ==================================================// 
// Content OPD
$routes->get('/organisasi-pemerintah-daerah/(:any)', 'OPDController::websiteOPD/$1/$2');



//AdminPortal E-SAKIP_________________________________________________________________________________________________________________________________
$routes->get('/administrator/e-sakip/dashboard', 'EsakipController::index', ['filter' => 'auth']);




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
