<?php

namespace App\Models;

use CodeIgniter\Model;

class PemdaModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'judul', 'file_gambar', 'path_file_gambar', 'isi_artikel', 'created_date', 'last_modified_date', 'nama_pengarang',
        'user_created', 'user_updated', 'notes', 'opd_hdr_id', 'is_active', 'tipe_artikel_id', 'status_sistem_id'
    ];

    public function getTipeArtikel($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
