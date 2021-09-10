<?php

namespace App\Controllers;

use App\Models\PemdaModel;
use App\Models\TipeArtikelModel;

class PemdaController extends BaseController
{
    protected $pemdaModel;
    protected $tipertikelModel;
    public function __construct()
    {
        $this->pemdaModel = new PemdaModel();
        $this->tipeArtikelModel = new TipeArtikelModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'j_berita' => $this->pemdaModel->jumlahBerita(),
            'j_informasi' => $this->pemdaModel->jumlahInformasi(),
            'j_visi' => $this->pemdaModel->jumlahVisi(),
            'j_misi' => $this->pemdaModel->jumlahMisi(),
            'j_foto' => $this->pemdaModel->jumlahFoto(),
            'j_video' => $this->pemdaModel->jumlahVideo(),
        ];
        return view('/administrator/portal-pemda/dashboard', $data);
    }

    //VisiPemda
    public function visipemda()
    {
        $data = [
            'v_visi' => $this->pemdaModel->tampilVisi(),
        ];
        return view('/administrator/portal-pemda/visi/v_visi', $data);
    }
    public function hapusVisi($id)
    {
        $this->pemdaModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/visi/v_visi');
    }

    //Misi Pemda
    public function misipemda()
    {
        $data = [
            'v_misi' => $this->pemdaModel->tampilMisi(),
        ];
        return view('/administrator/portal-pemda/misi/v_misi', $data);
    }
    public function hapusMisi($id)
    {
        $this->pemdaModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/misi/v_misi');
    }

    //Tambah Artikel
    public function tambahArtikel()
    {
        $data = [
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'validation' => \Config\Services::validation(),
        ];
        return view('/administrator/portal-pemda/tambah-artikel', $data);
    }

    //Berita......
    public function berita()
    {
        $data = [
            'title' => 'Master Data Berita',
            'v_berita' => $this->pemdaModel->tampilBerita(),
        ];
        return view('/administrator/portal-pemda/berita/home', $data);
    }

    public function simpanBerita()
    {

        $fileSampul = $this->request->getFile('file_gambar');

        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('templet/gambar-berita', $namaSampul);
        }

        $ambilJudul = url_title($this->request->getVar('judul'), '-', true);
        $judul = $this->request->getVar('judul');
        $slug = $ambilJudul;
        $file_gambar = $namaSampul;
        $path_file_gambar = $this->request->getVar('path_file_gambar');
        $isi_artikel = $this->request->getVar('isi_artikel');
        $opd_hdr_id = $this->request->getVar('opd_hdr_id');
        $tipe_artikel_id = $this->request->getVar('tipe_artikel_id');
        $nama_pengarang = $this->request->getVar('nama_pengarang');

        $this->db->query(
            "CALL artikel_insert('$judul', '$file_gambar', '$path_file_gambar', '$isi_artikel', '$opd_hdr_id', '$tipe_artikel_id', '$nama_pengarang', '$slug')"
        );

        session()->setFlashdata('info', 'add berita/informasi');
        return redirect()->to('/administrator/portal-pemda/dashboard');
    }

    public function detailBerita($slug)
    {
        $data = [
            'title' => 'Detail Data Berita',
            'v_berita' => $this->pemdaModel->getBeritaDetail($slug),
        ];
        if (empty($data['v_berita'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Berita ' . $slug . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/berita/detail', $data);
    }

    public function hapusBerita($id)
    {
        $v_berita = $this->pemdaModel->find($id);
        if ($v_berita['file_gambar'] != 'default.png') {
            unlink('templet/gambar-berita/' . $v_berita['file_gambar']);
        }
        $this->pemdaModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/berita/home');
    }

    public function editBerita($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_berita' => $this->pemdaModel->getBeritaUpdate($slug),
        ];
        return view('/administrator/portal-pemda/berita/edit', $data);
    }

    public function updateBerita()
    {
        $fileSampul = $this->request->getFile('file_gambar');

        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('templet/gambar-berita', $namaSampul);
        }

        $ambilJudul = url_title($this->request->getVar('judul'), '-', true);

        $judul = $this->request->getVar('judul');
        $id = $this->request->getVar('id');
        $file_gambar = $this->request->getVar('file_gambar');
        $file_gambar = $namaSampul;
        $path_file_gambar = $this->request->getVar('path_file_gambar');
        $isi_artikel = $this->request->getVar('isi_artikel');
        $opd_hdr_id = $this->request->getVar('opd_hdr_id');
        $nama_pengarang = $this->request->getVar('nama_pengarang');

        $slug = $ambilJudul;

        $this->db->query("CALL artikel_update('$id', '$judul', '$file_gambar', '$path_file_gambar', '$isi_artikel', '$opd_hdr_id', '$nama_pengarang', '$slug')");
        echo "<pre>";
        var_dump($this->request->getVar());
        // session()->setFlashdata('info', 'Update berita/informasi berhasil');
        // return redirect()->to('/administrator/portal-pemda/berita/home');
    }

    //Informasi......
    public function informasi()
    {
        $data = [
            'title' => 'Master Data Informasi',
            'v_informasi' => $this->pemdaModel->tampilInformasi(),
        ];
        return view('/administrator/portal-pemda/informasi/home', $data);
    }
    public function detailInformasi($judul)
    {
        $data = [
            'title' => 'Detail Data Informasi',
            'v_informasi' => $this->pemdaModel->getInformasiDetail($judul),
        ];
        if (empty($data['v_informasi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Informasi ' . $judul . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/informasi/detail', $data);
    }

    public function hapusInformasi($id)
    {
        $v_informasi = $this->pemdaModel->find($id);
        if ($v_informasi['file_gambar'] != 'default.png') {
            unlink('templet/gambar-berita/' . $v_informasi['file_gambar']);
        }
        $this->pemdaModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/informasi/home');
    }

    //SlideShow......
    public function slideShow()
    {
        $data = [
            'v_slideshow' => $this->pemdaModel->tampilSlideshow(),
        ];
        return view('/administrator/portal-pemda/slideshow/home', $data);
    }

    //Album Foto......
    public function Albumfoto()
    {
        $data = [
            'v_albumfoto' => $this->pemdaModel->tampilAlbumfoto(),
        ];
        return view('/administrator/portal-pemda/album-foto/home', $data);
    }

    //Album Video......
    public function Albumvideo()
    {
        $data = [
            'v_albumvideo' => $this->pemdaModel->tampilAlbumvideo(),
        ];
        return view('/administrator/portal-pemda/album-video/home', $data);
    }
}
