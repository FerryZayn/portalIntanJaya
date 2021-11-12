<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'jabatan_id', 'nip', 'created_date', 'last_modified_date', 'user_created', 'user_updated', 'is_active',
        'notes', 'nama_pegawai', 'nik', 'username', 'passwd', 'golongan', 'kode', 'jenis_kelamin', 'jenis_kelamin_code', 'email', 'no_hp',
        'tanggal_lahir', 'golongan_id', 'is_pegawai'
    ];

    public function getAuth($username = false)
    {
        if ($username == false) {
            return $this->findAll();
        }
        return $this->where(['username' => $username])->first();
    }
}
