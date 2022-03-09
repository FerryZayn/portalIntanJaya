<?php

namespace App\Controllers;

use App\Models\PemdaModel;
use App\Models\TipeArtikelModel;

class ContentController extends BaseController
{
    protected $pemdaModel;
    protected $tipertikelModel;
    public function __construct()
    {
        $this->pemdaModel = new PemdaModel();
        $this->tipeArtikelModel = new TipeArtikelModel();
        $this->db = \Config\Database::connect();
    }

    //Halaman Depan Portal_______________________________________________________________________________________________________________
    public function index()
    {
        $data = [
            'title' => 'DASHBOARD PORTAL'
        ];
        return view('/content/dashboard', $data);
    }



    //Halaman Depan Artikel Portal_______________________________________________________________________________________________________________
    public function dashboardPortal()
    {

        // $opd_hdr_id = $this->session->id;
        $vberita = $this->db->query("call artikel_view('0', '1')")->getResultArray();
        $vinformasi = $this->db->query("call artikel_view('0', '2')")->getResultArray();
        $valbumfoto = $this->db->query("call artikel_view('0', '3')")->getResultArray();
        $valbumvideo = $this->db->query("call artikel_view('0', '4')")->getResultArray();
        $vslideshow = $this->db->query("call artikel_view('0', '7')")->getResultArray();

        $data = [
            'v_slideshow' => $vslideshow,
            'v_berita' => $vberita,
            'v_informasi' => $vinformasi,
            'v_albumfoto' => $valbumfoto, //$this->pemdaModel->tampilAlbumfoto(),
            'v_albumvideo' => $valbumvideo, //$this->pemdaModel->tampilAlbumvideo(),




            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),


            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),

            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),

            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),
        ];
        return view('/content/home', $data);
    }

    //Tampil Detail Berita dan Informasi______________________________________________________________________________________________
    // public function opd()
    // {
    //     $data = [
    //         'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
    //         'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
    //         'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
    //         'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
    //         'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
    //         'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
    //         'v_costumpost' => $this->pemdaModel->getCostumpost(),
    //     ];
    //     return view('/content/opd', $data);
    // }


    //Tampil Detail Berita dan Informasi______________________________________________________________________________________________
    public function detailBerita($slug)
    {
        $vberita = $this->db->query("call artikel_view('0', '1')")->getResultArray();
        $vinformasi = $this->db->query("call artikel_view('0', '2')")->getResultArray();

        $data = [
            'v_beritarelasi' => $vberita, //$this->pemdaModel->tampilBerita(),
            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            'v_beritalain' => $vberita, //$this->pemdaModel->contentBerita(),
            'v_informasilain' => $vinformasi, //$this->pemdaModel->contentInformasi(),
            'v_notif' => $this->pemdaModel->bacaIni(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),

            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),

            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),

            'v_berita' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        return view('/content/berita-detail', $data);
    }

    //Tampil Semua Artikel_________________________________________________________________________________________________________________
    public function semuaArtikel()
    {
        $data = [
            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),

            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            //Pagin
            'v_semuaArtikel' => $this->pemdaModel->where(['status_sistem_id' => 2])->orderBy('RAND()')->paginate(20, 'artikel'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-artikel', $data);
    }

    //Tampil Semua Informasi______________________________________________________________________________________________________________
    public function semuaInformasi()
    {
        $vinformasi = $this->db->query("call artikel_view('0', '2')")->getResultArray();

        $paginate = 20;
        $data = [
            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),

            'v_informasi' => $vinformasi,
            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            //Pagin
            // 'v_informasii' => $this->pemdaModel->where('tipe_artikel_id', 2)->paginate($paginate, 'informasi'),
            'v_informasii' => $this->pemdaModel->where(['status_sistem_id' => 2, 'tipe_artikel_id' => 2])->orderBy('RAND()')->paginate($paginate, 'informasi'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-informasi', $data);
    }

    //Tampil Semua Berita______________________________________________________________________________________________________________
    public function semuaBerita()
    {
        // $berita = $this->db->query("call artikel_view('0', '1')")->getResultArray();


        // $paginate = 20;
        $data = [
            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),

            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            // 'v_berita' => $berita,
            //Pagin
            // 'v_beritaa' => $this->pemdaModel->paginate(2, 'berita'),
            // 'v_beritaa' => $this->pemdaModel->where('tipe_artikel_id', 1)->paginate($paginate, 'berita'),
            'v_beritaa' => $this->pemdaModel->where(['status_sistem_id' => 2, 'tipe_artikel_id' => 1])->orderBy('RAND()')->paginate(20, 'berita'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-berita', $data);
    }

    //Tampil Visi Misi______________________________________________________________________________________________________________
    public function visiMisi()
    {
        $berita = $this->db->query("call artikel_view('0', '1')")->getResultArray();
        $informasi = $this->db->query("call artikel_view('0', '2')")->getResultArray();
        $visi = $this->db->query("call artikel_view('0', '5')")->getResultArray();
        $misi = $this->db->query("call artikel_view('0', '6')")->getResultArray();
        $data = [
            'v_visi' => $visi, //$this->pemdaModel->tampilVisi(),
            'v_misi' => $misi, //$this->pemdaModel->tampilMisi(),
            'v_beritarelasi' => $berita, //$this->pemdaModel->tampilBerita(),
            'v_beritalain' => $berita, //$this->pemdaModel->contentBerita(),
            'v_informasilain' => $informasi, //$this->pemdaModel->contentInformasi(),
            'v_latestpostlist' => $berita, //$this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $berita, //$this->pemdaModel->contentLatestpostBox(),
            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),

            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),
        ];
        return view('/content/visi-misi', $data);
    }

    //Album Foto____________________________________________________________________________________________________________________
    public function albumFoto()
    {
        $data = [
            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),

            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            'v_beritalain' => $this->pemdaModel->contentBerita(),
            'v_informasilain' => $this->pemdaModel->contentInformasi(),
            'v_albumfoto' => $this->pemdaModel->tampilAlbumfoto(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),

            //Pagin
            'v_albumfoto' => $this->pemdaModel->where('tipe_artikel_id', 3)->paginate(20, 'albumfoto'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-album-foto', $data);
    }
    // public function albumFotodetail()
    // {
    //     $data = [
    //         'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
    //         'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
    //         'v_beritaheader' => $this->pemdaModel->tampilBerita(),
    //         'v_beritaa' => $this->pemdaModel->contentBerita(),
    //         'v_informasii' => $this->pemdaModel->contentInformasi(),
    //         'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
    //         'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
    //     ];
    //     return view('/content/album-foto-detail', $data);
    // }

    //Album Video__________________________________________________________________________________________________________________
    public function albumVideo()
    {
        $data = [
            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),

            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            'v_beritalain' => $this->pemdaModel->contentBerita(),
            'v_informasilain' => $this->pemdaModel->contentInformasi(),
            'v_albumvideo' => $this->pemdaModel->tampilAlbumvideo(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),

            //Pagin
            'v_albumvideo' => $this->pemdaModel->where('tipe_artikel_id', 4)->paginate(20, 'albumvideo'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-album-video', $data);
    }

    //Pencarian Artikel_______________________________________________________________________________________________
    public function searchArtikel()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $ambil = $this->pemdaModel->search($keyword);
        } else {
            $ambil = "Tidak ada data";
        }

        $data = [
            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            'v_ambil' => $ambil,

            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),
        ];
        return view('/content/search-article', $data);
    }
}
