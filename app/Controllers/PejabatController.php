<?php

namespace App\Controllers;

use \App\Models\PejabatProfilModel;

class PejabatController extends BaseController
{
    protected $pejabatModel;
    public function __construct()
    {
        $this->pemdaModel = new PejabatProfilModel();
        $this->db = \Config\Database::connect();
    }

    //Pejabat PEMDA
    public function pejabatPemda()
    {
        return view('/administrator/portal-pemda/pejabat/v_pejabat');
    }
    public function simpanPejabat()
    {
        $fileSampul = $this->request->getFile('file_foto');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('foto-pejabat', $namaSampul);
        }

        $file_foto = $namaSampul;
        $path_file_foto = $this->request->getVar('path_file_foto');
        $pegawai_id = $this->request->getVar('pegawai_id');

        $this->db->query("CALL profil_pejabat_insert('$file_foto', '$path_file_foto', '$pegawai_id')");

        session()->setFlashdata('info', 'Profile Pejabat berhasil di upload...');
        return redirect()->to('/administrator/portal-pemda/pejabat/v_pejabat');
    }
}
