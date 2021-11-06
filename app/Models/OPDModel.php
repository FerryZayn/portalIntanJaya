<?php

namespace App\Models;

use CodeIgniter\Model;

class OPDModel extends Model
{
    protected $table = 'opd_hdr';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'kode', 'create_date', 'last_modified_date', 'is_active', 'user_created', 'user_updated', 'notes', 'is_visible',
        'nama_opd', 'alamat_opd', 'kode_pos', 'telepon', 'fax', 'email', 'website', 'level', 'nomor_unit_kerja'
    ];

    //GET Tampil Semua OPD_______________________________________________________________________________________________
    public function getSemuaOPD()
    {
        return $this->db
            ->table('opd_hdr')
            ->where(['is_active' => 1])
            // ->orderBy('RA
            ->get()
            ->getResultArray();
    }

    // GET Details Artikel________________________________________________________________________________________________
    public function getDetailsOPD($id)
    {
        return $this->db
            ->table('opd_hdr')
            ->where('id', $id)
            ->get()
            ->getRow();
    }
    // GET Update OPD___________________________________________________________________________________________________________
    public function getUpdateOPD($id)
    {
        return $this->db
            ->table('opd_hdr')
            ->where('id', $id)
            ->get()
            ->getRow();
    }
    public function getLevelopd()
    {
        return $this->db
            ->table('level_opd')
            ->get()
            ->getResultArray();
    }

    //GET Artikel_______________________________________________________________________________________________
    public function getUpdateArtikel($id)
    {
        return $this->db
            ->table('artikel')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function hakakseshdr()
    {
        $query = $this->db->query("CALL hak_akses_hdr_view()");
        $results = $query->getResult();
        return $results;
    }


    public function getartikelDetail()
    {
        // $opd_hdr_id = 2;
        // $tipe_artikel_id = 1;
        // return $this->db
        //     ->table('artikel')
        //     ->where(['opd_hdr_id' => $opd_hdr_id, 'tipe_artikel_id' => $tipe_artikel_id])
        //     ->get()
        //     ->getRow();
    }
}
