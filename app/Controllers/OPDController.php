<?php

namespace App\Controllers;

use App\Models\PemdaModel;
// use App\Models\TipeArtikelModel;
use App\Models\OPDModel;

class OPDController extends BaseController
{
    protected $pemdaModel;
    protected $opdModel;
    protected $tipertikelModel;
    public function __construct()
    {
        $this->pemdaModel = new PemdaModel();
        $this->opdModel = new OPDModel();
        // $this->tipeArtikelModel = new TipeArtikelModel();
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

    // Admin Dashboard________________________________________________________________________________________________
    public function indexAdmin()
    {
        return view('/administrator/portal-opd/dashboard');
    }

    //Admin Link OPD________________________________________________________________________________________________
    public function vOPD()
    {
        $data = [
            'opdtampil' => $this->opdModel->getSemuaOPD(),
        ];
        return view('/administrator/portal-opd/v_opd', $data);
    }

    // GET View OPD________________________________________________________________________________________________
    public function opdDetail($id)
    {
        $data = [
            // 'validation' => \Config\Services::validation(),
            'v_opddetail' => $this->opdModel->getDetailsOPD($id),
            // 'level_opd' => $this->opdModel->getLevelopd()
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
}
