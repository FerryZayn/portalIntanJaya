<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Database\BaseBuilder;

class ProcedureModel
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // PROCEDUR VIEW
    // Query Procedure untuk menampilkan opd View pada halaman opd
    public function opdView()
    {
        $id = $this->session->id;
        $query = $this->db->query("CALL bidang_view('$id')");
        $results = $query->getResult();
        return $results;
    }

    // Queri Procedure untuk menampilkan bidang view pada halaman bidang
    public function bidangView($user)
    {

        $query = $this->db->query("CALL bidang_view('$user')");
        $results = $query->getResult();
        return $results;
    }

    // Query Procedure untuk menampilkan sub bidang view pada halaman subidang

    public function subidView($bidang)
    {
        $query = $this->db->query("CALL sub_bidang_view('$bidang')");
        $results = $query->getResult();
        return $results;
    }

    // Query Procedure untuk menampilkan hak akses pada halaman hak akses
    public function hakAkses($role, $user)
    {
        $query = $this->db->query("CALL hak_akses_view('$role','$user')");
        $results = $query->getResult();
        return $results;
    }

    // Query untuk menampilkan sub bidang pada select option 
    public function selectSubid($bidang)
    {
        $query = $this->db->query("CALL sub_bidang_view('$bidang')");
        $results = $query->getResult();
        return json_encode($results);
    }

    // Query Procedure menampikan sifat surat berdasarkan kategori id
    public function sifatsuratView($kat_id)
    {
        $query = $this->db->query("CALL sifat_surat_view('$kat_id')");
        $results = $query->getResult();
        return $results;
    }

    // Query Procedure untuk menampilkan Sifat surat pada select option untuk tingkat keamanan 
    public function selectAman()
    {
        $query = $this->db->query("CALL sifat_surat_view(1)");
        $results = $query->getResult();
        return $results;
    }

    // Query procedure untuk menampilkan Sifat surat pada select option untuk tingkat kecepatan surat
    public function selectCepat()
    {
        $query = $this->db->query("CALL sifat_surat_view(2)");
        $results = $query->getResult();
        return $results;
    }

    public function selectPola()
    {
        $query = $this->db->query("CALL pola_klasifikasi_surat_view()");
        $results = $query->getResult();
        return $results;
    }

    // Query mengambil jumlah Total Disposisi masuk pada dashbord 
    // tdm -> Total disposisi Surat Masuk
    public function tdm()
    {
        $query = $this->db->query("CALL lihat_disposisi_masuk('17')");
        $results = $query->getNumRows();
        return $results;
    }

    // Query mengambil jumlah Total Disposisi masuk pada dashbord 
    // tdm -> Total disposisi Surat Masuk
    public function tdk()
    {
        $query = $this->db->query("CALL lihat_disposisi_keluar('17')");
        $results = $query->getNumRows();
        return $results;
    }
    // Query untuk menampilkan menu sidebire 
    public function iscrud($user)
    {
        $query = $this->db->query("CALL cek_hak_akses('$user')");
        $results = $query->getResult();
        return $results;
    }


    // Query menampilkan Hak Akses Hdr
    public function hakakseshdr()
    {
        $query = $this->db->query("CALL hak_akses_hdr_view()");
        $results = $query->getResult();
        return $results;
    }

    // query menampilkan bidang view super user berdasarkan id OPD
    public function bidangViewsu($opd_id)
    {
        $query = $this->db->query("CALL bidang_view_su('$opd_id')");
        $results = $query->getResult();
        return $results;
    }

    // query menampilkan select jabatan insert super user

    public function selectjabatansu()
    {
        $query = $this->db->query("CALL jabatan_insert_su('')");
        $results = $query->getResult();
        return $results;
    }

    // query select opd pada master tambah bidang 

    public function selectOpd()
    {
        $query = $this->db->query("CALL opd_view()");
        $results = $query->getResult();
        return $results;
    }





    // PROCEDURE INSERT 

    // PROCEDURE DELETE


    // PROCEDURE MASTER 




}
