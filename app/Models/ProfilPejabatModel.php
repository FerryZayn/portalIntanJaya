<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilPejabatModel extends Model
{
    protected $table = 'profil_pejabat';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'pegawai_id', 'file_foto', 'path_file_foto', 'user_created', 'user_updated', 'created_date',
        'last_modified_date', 'is_active', 'status_sistem_id', 'deskripsi'
    ];

    public function getProfilpejabat($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
