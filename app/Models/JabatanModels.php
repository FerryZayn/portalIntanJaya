<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModels extends Model
{
	protected $table      = 'jabatan';
	protected $returnType = "object";


	public function getJabatan()
	{
		$query = $this->db->query('SELECT id, nama_jabatan
FROM jabatan');

		$results = $query->getResult();

		return $results;
	}
}
