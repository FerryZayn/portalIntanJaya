<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModels extends Model
{

	protected $table      = 'pegawai';

	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = "object";
	protected $allowedFields = ['id', 'jabatan_id', 'nip', 'created_date', 'last_modified_date', 'user_created', 'user_updated', 'notes', 'is_active', 'nama_pegawai', 'nik', 'username', 'passwd', 'golongan', 'kode', 'jenis_kelamin', 'jenis_kelamin_code', 'email', 'no_hp', 'tanggal_lahir'];

	public function tampilPegawai()
	{


		$query = $this->db->query('SELECT * FROM pegawai');
		$results = $query->getResult();

		return $results;
	}


	public function validasiPassword()
	{
		//$query = $this->db->query('SELECT * FROM pegawai_hdr JOIN pegawai_dtl ON pegawai_dtl.pegawai_hdr_id = pegawai_hdr.id where email="'.$email.'"');
		$query = $this->db->query('SELECT * FROM pegawai');

		$results = $query->getResult();

		return $results;
	}

	public function pegawaiJabatan()
	{
		$query = $this->db->query('SELECT * FROM pegawai p join jabatan j on j.id = p.jabatan_id');
		$results = $query->getResult();
		return $results;
	}

	public function getOpd()
	{
		$query = $this->db->query('SELECT * FROM pegawai p join jabatan j on j.id = p.jabatan_id');
		$results = $query->getResult();
		return $results;
	}

	public function updateActivated($email)
	{
		$builder = $this->db->table('pegawai');
		$builder->set('is_active', 1);
		$builder->where('email', $email);
		$builder->update();
	}
}
