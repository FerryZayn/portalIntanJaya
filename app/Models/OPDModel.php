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


    //Contet OPD per ID
    public function opdViewsite()
    {
        // $builder = $this->db->table('tipe_penerima_pengirim_surat');
        // $query = $builder->get()->getResult();
        // return $query;

        // $opd_id = $this->getVar->opd_id;

        // $query = $this->db->query("call artikel_view('$opd_id')");
        // $results = $query->getResult();
        // return $results;
    }




    //GET Tampil Semua OPD_______________________________________________________________________________________________
    public function getSemuaOPD()
    {
        return $this->db
            ->table('opd_hdr')
            ->join('artikel', 'artikel.opd_hdr_id=opd_hdr.id')
            // ->where(['is_active' => 1])
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
}
