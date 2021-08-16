<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_berita', 'judul_berita', 'slug_berita', 'posisi_berita', 'teks_berita', 'sampul', 'cretaed_at', 'updated_at'];

    public function getKomik($slug_berita = false)
    {
        if ($slug_berita == false) {
            return $this->findAll();
        }
        return $this->where(['slug_berita' => $slug_berita])->first();
    }
}
