<?php

namespace App\Controllers;

use App\Models\PemdaModel;
use App\Models\TipeArtikelModel;
use phpDocumentor\Reflection\Types\This;

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

    //Halaman Depan Portal
    public function index()
    {
        $data = [
            'v_berita' => $this->pemdaModel->tampilBerita(),
            'v_informasi' => $this->pemdaModel->tampilInformasi(),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
            'v_slideshow' => $this->pemdaModel->tampilSlideshow(),
            'v_albumfoto' => $this->pemdaModel->tampilAlbumfoto(),
            'v_albumvideo' => $this->pemdaModel->tampilAlbumvideo()
        ];
        return view('/content/home', $data);
    }

    //Tampil Detail Berita dan Informasi
    public function detailBerita($slug)
    {
        $data = [
            'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
            'v_berita' => $this->pemdaModel->getDetailsArtikel($slug),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            'v_beritalain' => $this->pemdaModel->contentBerita(),
            'v_informasilain' => $this->pemdaModel->contentInformasi(),
            'v_notif' => $this->pemdaModel->bacaIni(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
        ];
        return view('/content/berita-detail', $data);
    }

    //Tampil Semua Artikel
    public function semuaArtikel()
    {
        $data = [
            // 'v_informasi' => $this->pemdaModel->tampilInformasi(),
            // 'v_semuaArtikel' => $this->pemdaModel->getSemuaartikel(),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            //Pagin
            'v_semuaArtikel' => $this->pemdaModel->paginate(12, 'artikel'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-artikel', $data);
    }


    //Tampil Semua Informasi
    public function semuaInformasi()
    {
        $paginate = 2;
        $data = [
            'v_informasi' => $this->pemdaModel->tampilInformasi(),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            //Pagin
            'v_informasii' => $this->pemdaModel->where('tipe_artikel_id', 2)->paginate($paginate, 'informasi'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-informasi', $data);
    }



    //Tampil Semua Berita
    public function semuaBerita()
    {
        $paginate = 2;
        $data = [
            'v_berita' => $this->pemdaModel->tampilBerita(),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            //Pagin
            // 'v_beritaa' => $this->pemdaModel->paginate(2, 'berita'),
            'v_beritaa' => $this->pemdaModel->where('tipe_artikel_id', 1)->paginate($paginate, 'berita'),
            'pager' => $this->pemdaModel->pager,
        ];
        return view('/content/semua-berita', $data);
    }


    //Tampil Visi Misi
    public function visiMisi()
    {
        $data = [
            'v_visi' => $this->pemdaModel->tampilVisi(),
            'v_misi' => $this->pemdaModel->tampilMisi(),
            'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
            'v_beritalain' => $this->pemdaModel->contentBerita(),
            'v_informasilain' => $this->pemdaModel->contentInformasi(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
        ];
        return view('/content/visi-misi', $data);
    }

    //Album Foto
    public function albumFoto()
    {
        $data = [
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            'v_beritalain' => $this->pemdaModel->contentBerita(),
            'v_informasilain' => $this->pemdaModel->contentInformasi(),
            'v_albumfoto' => $this->pemdaModel->tampilAlbumfoto(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
        ];
        return view('/content/semua-album-foto', $data);
    }
    public function albumFotodetail()
    {
        $data = [
            'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            'v_beritaa' => $this->pemdaModel->contentBerita(),
            'v_informasii' => $this->pemdaModel->contentInformasi(),
            'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
            'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
        ];
        return view('/content/album-foto-detail', $data);
    }

    //Pencarian Artikel
    public function searchArtikel()
    {

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $ambil = $this->pemdaModel->search($keyword);
        } else {
            $ambil = "Tidak ada data"; //$this->pemdaModel->getSemuaartikel();
        }

        $data = [
            'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
            'v_beritaheader' => $this->pemdaModel->tampilBerita(),
            'v_ambil' => $ambil,
        ];
        return view('/content/search-article', $data);
    }
}
