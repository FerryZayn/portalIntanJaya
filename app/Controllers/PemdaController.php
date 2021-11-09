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
            'j_slideshow' => $this->pemdaModel->jumlahSlideshow(),
        ];
        return view('/administrator/portal-pemda/dashboard', $data);
    }
    //Tambah Artikel__________________________________________________________________________________________________________
    public function tambahArtikel()
    {
        $data = [
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'validation' => \Config\Services::validation(),
        ];
        return view('/administrator/portal-pemda/tambah-artikel', $data);
    }
    //Insert/Simpan Artikel___________________________________________________________________________________________________________
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
        session()->setFlashdata('info', 'Proses simpan artikel berhasil');
        return redirect()->to('/administrator/portal-pemda/dashboard');
    }

    //Update Artikel___________________________________________________________________________________________________________
    public function updateArtikel()
    {
        $fileSampul = $this->request->getFile('file_gambar');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //Hapus File Gambar Lama
            $id = $this->request->getVar('id');
            $dt = $this->pemdaModel->gantiGambar($id)->getRow();
            $gambar = $dt->file_gambar;
            $path = 'templet/gambar-berita/';
            @unlink($path . $gambar);

            // Upload File Gambar Baru dan Pindahkan ke direktori berita
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
        session()->setFlashdata('info', 'Update Artikel berhasil');

        return redirect()->to('/administrator/portal-pemda/dashboard');
    }




    //Visi Pemda________________________________________________________________________________________________________________
    public function visipemda()
    {
        $data = [
            'v_visi' => $this->pemdaModel->tampilVisi(),
        ];
        return view('/administrator/portal-pemda/visi/v_visi', $data);
    }

    public function visiDetail($slug)
    {
        $data = [
            'v_visi' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        return view('/administrator/portal-pemda/visi/detail', $data);
    }

    public function visiEdit($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_visi' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/visi/edit', $data);
    }

    public function visiHapus($id)
    {
        $this->pemdaModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/visi/v_visi');
    }


    //Misi Pemda__________________________________________________________________________________________________________
    public function misipemda()
    {
        $data = [
            'v_misi' => $this->pemdaModel->tampilMisi(),
        ];
        return view('/administrator/portal-pemda/misi/v_misi', $data);
    }
    public function misiDetail($slug)
    {
        $data = [
            'v_misi' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        return view('/administrator/portal-pemda/misi/detail', $data);
    }
    public function misiEdit($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_misi' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/misi/edit', $data);
    }

    public function misiHapus($id)
    {
        $this->pemdaModel->delete($id);
        session()->setFlashdata('info', 'Data misi sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/misi/v_misi');
    }


    //Berita__________________________________________________________________________________________________________
    public function berita()
    {
        $opd_hdr_id = $this->session->id;
        $berita = $this->db->query("CALL berita_view_adm($opd_hdr_id)")->getResultArray();
        $data = [
            'title' => 'Master Data Berita',
            // 'v_berita' => $this->pemdaModel->tampilBerita(),
            'v_berita' => $berita,
        ];
        return view('/administrator/portal-pemda/berita/home', $data);
    }

    public function detailBerita($slug)
    {
        $data = [
            'title' => 'Detail Data Berita',
            'v_berita' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        if (empty($data['v_berita'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Berita ' . $slug . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/berita/detail', $data);
    }

    public function editBerita($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_berita' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/berita/edit', $data);
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



    //Informasi_______________________________________________________________________________________________________________
    public function informasi()
    {
        $data = [
            'title' => 'Master Data Informasi',
            'v_informasi' => $this->pemdaModel->tampilInformasi(),
        ];
        return view('/administrator/portal-pemda/informasi/home', $data);
    }

    public function detailInformasi($slug)
    {
        $data = [
            'title' => 'Detail Data Informasi',
            'v_informasi' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        if (empty($data['v_informasi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Informasi ' . $slug . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/informasi/detail', $data);
    }

    public function editInformasi($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_informasi' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/informasi/edit', $data);
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





    //SlideShow_______________________________________________________________________________________________________________
    public function slideShow()
    {
        $data = [
            'v_slideshow' => $this->pemdaModel->tampilSlideshow(),
        ];
        return view('/administrator/portal-pemda/slideshow/home', $data);
    }

    public function detailslideshow($slug)
    {
        $data = [
            'v_slideshow' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        if (empty($data['v_slideshow'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Slide Show ' . $slug . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/slideshow/detail', $data);
    }
    public function editSlideshow($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_slideshow' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/slideshow/edit', $data);
    }




    //Album Foto_______________________________________________________________________________________________________________
    public function Albumfoto()
    {
        $data = [
            'v_albumfoto' => $this->pemdaModel->tampilAlbumfoto(),
        ];
        return view('/administrator/portal-pemda/album-foto/home', $data);
    }
    public function detailAlbumfoto($slug)
    {
        $data = [
            'v_albumfoto' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        if (empty($data['v_albumfoto'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Slide Show ' . $slug . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/album-foto/detail', $data);
    }
    public function editAlbumfoto($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_albumfoto' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/album-foto/edit', $data);
    }



    //Album Video_______________________________________________________________________________________________________________
    public function Albumvideo()
    {
        $data = [
            'v_albumvideo' => $this->pemdaModel->tampilAlbumvideo(),
        ];
        return view('/administrator/portal-pemda/album-video/home', $data);
    }
    public function detailAlbumvideo($slug)
    {
        $data = [
            'v_albumvideo' => $this->pemdaModel->getDetailsArtikel($slug),
        ];
        if (empty($data['v_albumvideo'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Judul Album Video ' . $slug . ' tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/album-video/detail', $data);
    }
    public function editAlbumvideo($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_albumvideo' => $this->pemdaModel->getUpdateArtikel($slug),
        ];
        return view('/administrator/portal-pemda/album-video/edit', $data);
    }
}
