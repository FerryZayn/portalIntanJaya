<?php

namespace App\Models;

use CodeIgniter\Model;

class TipeArtikelModel extends Model
{
    protected $table = 'tipe_artikel';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'tipe', 'notes'];

    public function getTipeArtikel($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
