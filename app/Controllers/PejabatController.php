<?php

namespace App\Controllers;

use \App\Models\ProfilPejabatModel;

class PejabatController extends BaseController
{
    protected $pejabatModel;
    public function __construct()
    {
        $this->pejabatModel = new ProfilPejabatModel();
        $this->db = \Config\Database::connect();
    }

    //Pejabat PEMDA
    public function pejabatPemda()
    {
        $p_input_id = $this->session->id;
        // $pegawai = $this->db->query("call profil_pejabat_view('$p_input_id')")->getResult();

        $data = [
            'p_tampil' => $this->pejabatModel->getTampilpejabat($p_input_id),
            'pegawai' => $this->pejabatModel->getPegawai(),
        ];
        return view('/administrator/portal-pemda/pejabat/v_pejabat', $data);
    }
    public function simpanPejabat()
    {
        // dd($_POST);
        $fileSampul = $this->request->getFile('file_foto');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('templet/foto-pejabat', $namaSampul);
        }

        $pegawai_id = $this->request->getVar('pegawai_id');
        $p_id = $this->request->getVar('p_id');
        $file_foto = $namaSampul;
        $path_file_foto = $this->request->getVar('path_file_foto');
        $deskripsi = $this->request->getVar('deskripsi');

        $this->db->query(
            "CALL profil_pejabat_insert('$pegawai_id', '$p_id', '$file_foto', '$path_file_foto', '$deskripsi')"
        );
        session()->setFlashdata('info', 'Profile Pejabat berhasil di upload...');
        return redirect()->to('/administrator/portal-pemda/pejabat/v_pejabat');
    }


    public function detailPpejabat($id)
    {
        $data = [
            'title' => 'Detail Data Informasi',
            'v_pejabat' => $this->pejabatModel->getDetailpPejabat($id),
        ];
        if (empty($data['v_pejabat'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Profil Pejabat tidak ditemukan'
            );
        }
        return view('/administrator/portal-pemda/pejabat/detail', $data);
    }

    public function editPpejabat($pegawai_id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'v_tipeartikel' => $this->tipeArtikelModel->getTipeArtikel(),
            'v_informasi' => $this->pemdaModel->getUpdateArtikel($pegawai_id),
        ];
        return view('/administrator/portal-pemda/pejabat/edit', $data);
    }


    public function hapusPpejabat($id)
    {
        $delppejabat = $this->pejabatModel->find($id);
        if ($delppejabat['file_foto'] != 'default.png') {
            unlink('templet/foto-pejabat/' . $delppejabat['file_foto']);
        }
        $this->pejabatModel->delete($id);
        session()->setFlashdata('info', 'Data sudah di hapus...');
        return redirect()->to('/administrator/portal-pemda/pejabat/v_pejabat');
    }
}
