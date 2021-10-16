<?php

namespace App\Controllers;

use \App\Models\AuthModel;

class AuthController extends BaseController
{
	// protected $authModel;
	// public function __construct()
	// {
	// 	$this->authModel = new AuthModel();
	// 	// $this->db = \Config\Database::connect();
	// }

	public function index()
	{

		if (session('id')) {
			$data = [
				'title' => 'Halaman Depan',
			];
			return view('/administrator/index', $data);
		}
		return view('/auth/login');
	}

	public function loginProses()
	{
		$this->validation->setRules([
			'email' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Email Harus diisi!'
				]
			],

			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password Harus diisi!'
				]
			],

		]);

		$isDataValid = $this->validation->withRequest($this->request)->run();
		if ($isDataValid) {
			$email = $this->request->getVar('email');
			$password = $this->request->getVar('password');

			$ipAddress = $this->get_client_ip();
			$result = $this->db->query("CALL login('$email','$password','$ipAddress')")->getRow();
			if ($result->n == 50) {

				$ses_data = [
					'id'       =>  $result->usr_name,
					'nama_pegawai' => $result->usr_name2,
					// 'email'         => $result->email,
					// 'nama_opd' => $result->opd_n,
					// 'opd_id' => $result->opd_id,
					'logged_in'     => TRUE
				];
				$this->session->set($ses_data);
				return redirect()->to('/administrator/index');
			} else if ($result->n == 51) {
				session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">User Password Tidak Sesuai</div>');
				return redirect()->back()->withInput();
			} else if ($result->n == 52) {
				session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">User Belum Aktivasi !</div>');
				return redirect()->back()->withInput();
			} else {
				session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">User tidak Terdaftar</div>');
				return redirect()->back()->withInput();
			}
		}
		session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Field tidak boleh Kosong</div>');
		return redirect()->to('/auth/login');
	}




	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/auth/login');
	}

	function get_client_ip()
	{
		$ipAddress = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			// to get shared ISP IP address
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// check for IPs passing through proxy servers
			// check if multiple IP addresses are set and take the first one
			$ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			foreach ($ipAddressList as $ip) {
				if (!empty($ip)) {
					// if you prefer, you can check for valid IP address here
					$ipAddress = $ip;
					break;
				}
			}
		} else if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
			$ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (!empty($_SERVER['HTTP_FORWARDED'])) {
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
		} else if (!empty($_SERVER['REMOTE_ADDR'])) {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		return $ipAddress;
	}
}
