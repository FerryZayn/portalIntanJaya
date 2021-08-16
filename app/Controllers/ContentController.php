<?php

namespace App\Controllers;

class ContentController extends BaseController
{
	public function index()
	{
		return view('/content/home');
	}
	public function detail()
	{
		return view('/content/berita-detail');
	}
	public function semuaberitainformasi()
	{
		return view('/content/semua-berita-informasi');
	}
	public function visiMisi()
	{
		return view('/content/visi-misi');
	}
	public function albumFoto()
	{
		return view('/content/semua-album-foto');
	}
	public function albumFotodetail()
	{
		return view('/content/album-foto-detail');
	}
}
