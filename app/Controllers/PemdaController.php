<?php

namespace App\Controllers;

use \App\Models\PemdaModel;
use \App\Models\TipeArtikelModel;

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
        return view('/administrator/portal-pemda/dashboard');
    }
    public function visipemda()
    {
        return view('/administrator/portal-pemda/visi');
    }
    public function misipemda()
    {
        return view('/administrator/portal-pemda/misi');
    }
    public function pejabatpemda()
    {
        return view('/administrator/portal-pemda/pejabat');
    }

    public function berita()
    {
        return view('/administrator/portal-pemda/berita/home');
    }
    public function tambahberita()
    {
        $data = [
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'validation' => \Config\Services::validation()
        ];
        return view('/administrator/portal-pemda/berita/tambah', $data);
    }

    public function simpanBerita()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[artikel.judul]',
                'errors' => [
                    'required' => 'Judul harus diisi',
                    'is_unique' => 'Judul sudah terdaftar.'
                ]
            ],
            'file_gambar' => [
                'rules' => 'max_size[file_gambar,1024]|is_image[file_gambar]|mime_in[file_gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'Error Gambar File Gambar => Ini bukan file gambar',
                    'mime_in' => 'Error Mime File Gambar => Ini bukan file gambar',
                ]
            ]
        ])) {
            return redirect()->to('/administrator/portal-pemda/berita/tambah')->withInput();
        }

        $fileGambar = $this->request->getFile('file_gambar');

        if ($fileGambar->getError() == 4) {
            $namaGambar = 'user.jpg';
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('templet/gambar-berita', $namaGambar);
        }

        $id_pegawai = session()->get('id');
        $this->pemdaModel->save([
            'judul' => $this->request->getVar('judul'),
            'isi_artikel' => $this->request->getVar('isi_artikel'),
            'nama_pengarang' => $this->request->getVar('nama_pengarang'),
            'file_gambar' => $namaGambar,
            'id_pegawai' => $id_pegawai,
            'tipe_artikel_id' => $this->request->getVar('tipe_artikel_id'),
        ]);
        session()->setFlashdata('info', 'Data sudah di simpan...');
        return redirect()->to('/administrator/portal-pemda/berita/home');
    }
}
