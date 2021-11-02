<?php

namespace App\Controllers;

use App\Models\PemdaModel;
use App\Models\TipeArtikelModel;
use App\Models\OPDModel;

class AdminController extends BaseController
{
	protected $pemdaModel;
	protected $opdModel;
	protected $tipertikelModel;
	public function __construct()
	{
		$this->pemdaModel = new PemdaModel();
		$this->opdModel = new OPDModel();
		$this->tipeArtikelModel = new TipeArtikelModel();
		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		return view('/administrator/index');
	}
	public function hakAkses()
	{
		$data = [
			'data' => $this->opdModel->hakakseshdr(),
		];
		return view('/administrator/hak-akses', $data);
	}


	function settingChecked($hah_id)
	{
		$data = $this->db->query("CALL hak_akses_dtl_view($hah_id)")->getResult();
		echo json_encode($data);
	}


	// public function hakAksess($role, $user)
	// {
	// 	$query = $this->db->query("CALL hak_akses_view('$role','$user')");
	// 	$results = $query->getResult();
	// 	return $results;
	// }
	// public function iscrud($user)
	// {
	// 	$query = $this->db->query("CALL cek_hak_akses('$user')");
	// 	$results = $query->getResult();
	// 	return $results;
	// }
	// public function hakakseshdr()
	// {
	// 	$query = $this->db->query("CALL hak_akses_hdr_view()");
	// 	$results = $query->getResult();
	// 	return $results;
	// }


	// Hak Akses
	public function crudUpdate()
	{
		$id = $this->request->getVar('id');
		$name = $this->request->getVar('name');

		$builder = $this->db->table('hak_akses_dtl');

		if ($name == "is_view") {
			$value = $this->request->getVar('value');
			if ($value == 1) {
				$builder->set('is_view', 0);
				$builder->where('id', $id);
			}
			if ($value == 0) {
				$builder->set('is_view', 1);
				$builder->where('id', $id);
			}
		}
		if ($name == "is_insert") {
			$value = $this->request->getVar('value');
			if ($value == 1) {
				$builder->set('is_insert', 0);
				$builder->where('id', $id);
			}
			if ($value == 0) {
				$builder->set('is_insert', 1);
				$builder->where('id', $id);
			}
		}
		if ($name == "is_update") {
			$value = $this->request->getVar('value');
			if ($value == 1) {
				$builder->set('is_update', 0);
				$builder->where('id', $id);
			}
			if ($value == 0) {
				$builder->set('is_update', 1);
				$builder->where('id', $id);
			}
		}
		if ($name == "is_delete") {
			$value = $this->request->getVar('value');
			if ($value == 1) {
				$builder->set('is_delete', 0);
				$builder->where('id', $id);
			}
			if ($value == 0) {
				$builder->set('is_delete', 1);
				$builder->where('id', $id);
			}
		}



		return $builder->update();
	}
}
