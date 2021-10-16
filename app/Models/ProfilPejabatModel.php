<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilPejabatModel extends Model
{
    protected $table = 'profil_pejabat';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'pegawai_id', 'file_foto', 'path_file_foto', 'user_created', 'user_updated',
        'created_date', 'last_modified_date', 'is_active', 'status_sistem_id', 'deskripsi', 'slug'
    ];

    public function getTampilpejabat($p_input_id)
    {
        $query = $this->db->query("call profil_pejabat_view('$p_input_id')");
        $results = $query->getResult();
        return $results;
    }

    public function getPegawai()
    {
        $query = $this->db->query('select p.* from pegawai p join jabatan j on j.id = p.jabatan_id where j.opd_hdr_id in (select p2.id from pegawai p2 where p2.id=1) and p.is_active = 1');
        $results = $query->getResult();
        return $results;
    }

    public function getDetailpPejabat($id)
    {
        return $this->db
            ->table('profil_pejabat')
            ->where('id', $id)
            ->get()
            ->getRow();
    }
    public function getUpdatePpejabat($pegawai_id)
    {
        return $this->db
            ->table('profil_pejabat')
            ->where('pegawai_id', $pegawai_id)
            ->get()
            ->getRow();
    }
}
