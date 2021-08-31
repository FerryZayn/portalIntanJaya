<?php

namespace App\Controllers;

use \App\Models\PemdaModel;
use \App\Models\TipeArtikelModel;

class ContentController extends BaseController
{
	protected $pemdaModel;
	protected $tipertikelModel;
	public function __construct()
	{
		$this->pemdaModel = new PemdaModel();
		$this->tipeArtikelModel = new TipeArtikelModel();
		$this->db = \Config\Database::connect();
	}

	//Halaman Depan Portal
	public function index()
	{
		$data = [
			'v_berita' => $this->pemdaModel->tampilBerita(),
			'v_informasi' => $this->pemdaModel->tampilInformasi(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
			'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
			'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
		];
		return view('/content/home', $data);
	}

	//Tampil Detail Berita dan Informasi
	public function detailBerita($slug)
	{
		$data = [
			'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
			'v_informasirelasi' => $this->pemdaModel->tampilInformasi(),
			'v_berita' => $this->pemdaModel->getBeritaDetail($slug),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
			'v_beritaa' => $this->pemdaModel->contentBerita(),
			'v_informasii' => $this->pemdaModel->contentInformasi(),
			'v_notif' => $this->pemdaModel->bacaIni(),
			'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
			'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
		];
		return view('/content/berita-detail', $data);
	}

	//Tampil Semua Artikel, Berita dan Informasi
	public function semuaArtikel()
	{
		$data = [
			// 'v_informasi' => $this->pemdaModel->tampilInformasi(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),

			//Pagin
			'v_informasi' => $this->pemdaModel->paginate(2, 'artikel'),
			'pager' => $this->pemdaModel->pager
		];
		return view('/content/semua-artikel', $data);
	}
	public function semuaInformasi()
	{
		$data = [
			'v_informasi' => $this->pemdaModel->tampilInformasi(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
		];
		return view('/content/semua-informasi', $data);
	}
	public function semuaBerita()
	{
		$data = [
			'v_berita' => $this->pemdaModel->tampilBerita(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
		];
		return view('/content/semua-berita', $data);
	}

	//Tampil Visi Misi
	public function visiMisi()
	{
		$data = [
			'v_visi' => $this->pemdaModel->tampilVisi(),
			'v_misi' => $this->pemdaModel->tampilMisi(),
			'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
			'v_informasirelasi' => $this->pemdaModel->tampilInformasi(),
			'v_beritaa' => $this->pemdaModel->contentBerita(),
			'v_informasii' => $this->pemdaModel->contentInformasi(),
			'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
			'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
		];
		return view('/content/visi-misi', $data);
	}

	//Album Foto
	public function albumFoto()
	{
		$data = [
			'v_visi' => $this->pemdaModel->tampilVisi(),
			'v_misi' => $this->pemdaModel->tampilMisi(),
			'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
			'v_informasirelasi' => $this->pemdaModel->tampilInformasi(),
			'v_beritaa' => $this->pemdaModel->contentBerita(),
			'v_informasii' => $this->pemdaModel->contentInformasi(),
			'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
			'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
		];
		return view('/content/semua-album-foto', $data);
	}
	public function albumFotodetail()
	{
		$data = [
			'v_beritarelasi' => $this->pemdaModel->tampilBerita(),
			'v_informasirelasi' => $this->pemdaModel->tampilBerita(),
			'v_informasiheader' => $this->pemdaModel->tampilInformasi(),
			'v_beritaheader' => $this->pemdaModel->tampilBerita(),
			'v_beritaa' => $this->pemdaModel->contentBerita(),
			'v_informasii' => $this->pemdaModel->contentInformasi(),
			'v_latestpostlist' => $this->pemdaModel->contentLatestpostList(),
			'v_latestpostbox' => $this->pemdaModel->contentLatestpostBox(),
		];
		return view('/content/album-foto-detail', $data);
	}
}
