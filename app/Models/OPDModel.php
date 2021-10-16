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
            ->orderBy('RAND ()')
            // ->limit('5')
            ->get()
            ->getResultArray();
    }

    // GET Details Artikel________________________________________________________________________________________________
    public function getDetailsOPD($id)
    {
        return $this->db
            ->table('opd_hdr')
            // ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            // ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('id', $id)
            ->get()
            ->getRow();
    }
    // GET Update OPD___________________________________________________________________________________________________________
    public function getUpdateOPD($id)
    {
        return $this->db
            ->table('opd_hdr')
            // ->join('level_opd', 'level_opd.kode=opd_hdr.level')
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
}
