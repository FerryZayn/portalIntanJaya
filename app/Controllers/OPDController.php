<?php

namespace App\Controllers;

use App\Models\PemdaModel;
use App\Models\TipeArtikelModel;
use App\Models\OPDModel;

class OPDController extends BaseController
{
    protected $pemdaModel;
    protected $opdModel;
    protected $tipeArtikelModel;
    public function __construct()
    {
        $this->pemdaModel = new PemdaModel();
        $this->opdModel = new OPDModel();
        $this->tipeArtikelModel = new TipeArtikelModel();
        $this->db = \Config\Database::connect();
    }

    // Content
    public function index()
    {
        $data = [
            'v_artikelheader' => $this->pemdaModel->getSemuaartikel(),
            'v_contentmenuinformasi' => $this->pemdaModel->contentInformasiMenu(),
            'v_contentmenuberita' => $this->pemdaModel->contentBeritaMenu(),
            'v_contentmenualbumfoto' => $this->pemdaModel->contentAlbumfotoMenu(),
            'v_contentmenualbumvideo' => $this->pemdaModel->contentAlbumvideoMenu(),
            'v_contentfooterfoto' => $this->pemdaModel->getFotofooter(),
            'v_costumpost' => $this->pemdaModel->getCostumpost(),
            'v_contentopd' => $this->opdModel->getSemuaOPD(),
        ];
        return view('/content/opd', $data);
    }
    // Content Website OPD_____________________________________________________________________________________________
    public function websiteOPD()
    {
        $id = $this->session->id;
        $tipe_artikel_id = 1;

        $vartikel = $this->db->query("call artikel_view('$id', '$tipe_artikel_id')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
        ];
        return view('/opd/home', $data);
    }



    // Admin Dashboard________________________________________________________________________________________________
    public function indexAdmin()
    {
        $data = [
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/dashboard', $data);
    }

    //Admin Link OPD________________________________________________________________________________________________
    public function vOPD()
    {
        $data = [
            'opdtampil' => $this->opdModel->getSemuaOPD(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/v_opd', $data);
    }

    // GET View OPD________________________________________________________________________________________________
    public function opdDetail($id)
    {
        $data = [
            'v_opddetail' => $this->opdModel->getDetailsOPD($id),
        ];
        return view('/administrator/portal-opd/detail', $data);
    }

    // GET Edit OPD________________________________________________________________________________________________
    public function opdEdit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_opdedit' => $this->opdModel->getUpdateOPD($id),
            'level_opd' => $this->opdModel->getLevelopd()
        ];
        return view('/administrator/portal-opd/v_edit', $data);
    }

    //Update Artikel___________________________________________________________________________________________________________
    public function updateOPD()
    {

        $id = $this->request->getVar('id');
        $pegawai_id = $this->session->id;
        $kode = $this->request->getVar('kode');
        $nama_opd = $this->request->getVar('nama_opd');

        $alamat_opd = $this->request->getVar('alamat_opd');
        $kode_pos = $this->request->getVar('kode_pos');
        $telepon = $this->request->getVar('telepon');
        $fax = $this->request->getVar('fax');
        $email = $this->request->getVar('email');
        $website = $this->request->getVar('website');

        $level = $this->request->getVar('level');
        $nomor_unit_kerja = $this->request->getVar('nomor_unit_kerja');

        $this->db->query("CALL opd_update('$id','$pegawai_id', '$kode','$nama_opd','$alamat_opd','$kode_pos','$telepon','$fax','$email','$website','$level', '$nomor_unit_kerja')");
        session()->setFlashdata('pesan', 'update');


        return redirect()->to('/administrator/portal-opd/v_opd');
    }

    // GET Hapus OPD________________________________________________________________________________________________
    public function opdHapus($id)
    {
        $this->opdModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-opd/v_opd');
    }

    public function vBerita()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '1')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/berita/v_berita', $data);
    }

    public function vInformasi()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '2')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/informasi/v_informasi', $data);
    }
    public function vFoto()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '3')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/foto/v_foto', $data);
    }
    public function vVideo()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '4')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/video/v_video', $data);
    }
    public function vVisi()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '5')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/visi/v_visi', $data);
    }
    public function vMisi()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '6')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/misi/v_misi', $data);
    }
    public function vSlide()
    {
        $opd_hdr_id = $this->session->id;
        $vartikel = $this->db->query("call artikel_view_adm('$opd_hdr_id', '7')")->getResultArray();
        $data = [
            'v_artikel' => $vartikel,
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
        ];
        return view('/administrator/portal-opd/slide/v_slide', $data);
    }







    public function tambahArtikel()
    {
        $data = [
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'validation' => \Config\Services::validation(),
        ];
        return view('/administrator/portal-opd/artikel-tambah', $data);
    }
    //Insert/Simpan Artikel___________________________________________________________________________________________________________
    public function simpanBerita()
    {
        $fileSampul = $this->request->getFile('file_gambar');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('templet/img-opd-post', $namaSampul);
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
        $this->db->query("CALL artikel_insert('$judul', '$file_gambar', '$path_file_gambar', '$isi_artikel', '$opd_hdr_id', '$tipe_artikel_id', '$nama_pengarang', '$slug')");
        session()->setFlashdata('info', 'Proses simpan artikel berhasil');
        return redirect()->to('/administrator/portal-opd/dashboard');
    }

    public function artikelEdit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'artikel_edit' => $this->opdModel->getUpdateArtikel($id),
            'level_opd' => $this->opdModel->getLevelopd()
        ];
        return view('/administrator/portal-opd/artikel-edit', $data);
    }

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
            $path = 'templet/img-opd-post/';
            @unlink($path . $gambar);

            // Upload File Gambar Baru dan Pindahkan ke direktori berita
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('templet/img-opd-post', $namaSampul);
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

        return redirect()->to('/administrator/portal-opd/dashboard');
    }

    // GET Hapus OPD________________________________________________________________________________________________
    public function hapusOpdArtikel($id)
    {
        $this->opdModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-opd/dashboard');
    }


    public function vAlbumfoto()
    {
        $opd_hdr_id = 1;
        $tipe_artikel_id = 3;

        $albumfoto = $this->db->query("call artikel_view_adm('$opd_hdr_id', '$tipe_artikel_id')")->getResultArray();
        $data = [
            'v_albumfoto' => $albumfoto,
        ];
        return view('/administrator/portal-opd/foto', $data);
    }
}
