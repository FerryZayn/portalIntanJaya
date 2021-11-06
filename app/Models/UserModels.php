<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Database\BaseBuilder;

class UserModels
{

	protected $db;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
	}


	public function insertUser($data)
	{
		$builder = $this->db->table('pegawai');
		$builder->insert($data);
	}
	public function insertToken($token, $email)
	{
		return $this->db->query("CALL token_insert('$token','$email','2','1')");
	}

	public function cekEmail($email)
	{
		$builder = $this->db->table('pegawai');
		$query = $builder->getWhere(['email' => $email])->getRow();
		return $query;
	}

	public function cekToken($token)
	{
		$builder = $this->db->table('token');
		$query = $builder->getWhere(['token' => $token])->getRow();
		return $query;
	}

	public function updateActivated($email)
	{
		$builder = $this->db->table('pegawai');
		$builder->set('is_active', 1);
		$builder->where('email', $email);
		$builder->update();
	}


	public function hapusUser($email)
	{
		$builder = $this->db->table('pegawai');
		$builder->where('email', $email);
		$builder->delete();
	}

	public function hapusToken($email)
	{
		$builder = $this->db->table('token');
		$builder->where('email', $email);
		$builder->delete();
	}

	public function editOpd($id)
	{

		$builder = $this->db->table('opd_hdr');
		$query = $builder->getWhere(['id' => $id])->getRow();

		return $query;
	}

	public function selectOpd()
	{
		$builder = $this->db->query('SELECT * FROM opd_hdr WHERE is_active = 1');
		return $builder->getResult();
	}

	public function selectBidang()
	{
		$builder = $this->db->query('SELECT * FROM bidang');
		return $builder->getResult();
	}



	public function hapusOpd($id, $user)
	{
		return $this->db->query("CALL opd_delete('$id','$user')");
	}

	public function updatePassword($id, $passwd)
	{

		$builder = $this->db->table('pegawai');
		$builder->set('passwd', $passwd);
		$builder->where('id', $id);
		$builder->update();
	}

	public function hapusPegawai($id)
	{
		$builder = $this->db->table('pegawai');
		$builder->where('id', $id);
		$builder->delete();
	}
}
