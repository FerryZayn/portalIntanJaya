<?php

namespace App\Models;

use CodeIgniter\Model;

class PemdaModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id',
        'judul',
        'slug',
        'file_gambar',
        'path_file_gambar',
        'isi_artikel',
        'created_date',
        'last_modified_date',
        'nama_pengarang',
        'user_created',
        'user_updated',
        'notes',
        'opd_hdr_id',
        'is_active',
        'tipe_artikel_id',
        'status_sistem_id',
    ];

    //GET Order informasi & Berita pada Content
    public function contentInformasi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 2, 'is_active' => 1])
            ->orderBy('id', 'DESC')
            ->limit('10')
            ->get()
            ->getResultArray();
    }
    public function contentBerita()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('id', 'DESC')
            ->limit('10')
            ->get()
            ->getResultArray();
    }

    //Get Konten File Latest Post
    public function contentLatestpostList()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('id', 'ASC')
            ->limit('10')
            ->get()
            ->getResultArray();
    }
    public function contentLatestpostBox()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('id', 'DESC')
            ->limit('1')
            ->get()
            ->getResultArray();
    }

    //Notifikasi Berita Kanan
    public function bacaIni()
    {
        return $this->db
            ->table('artikel')
            // ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('RAND ()')
            ->limit(1, 0)
            ->get()
            ->getResultArray();
    }

    //GET Visi
    public function tampilVisi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 5, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function jumlahVisi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 5, 'is_active' => 1])
            ->countAllResults();
    }

    //GET Misi
    public function tampilMisi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 6, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function jumlahMisi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 6, 'is_active' => 1])
            ->countAllResults();
    }

    //GET Berita
    public function tampilBerita()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function getBeritaDetail($slug)
    {
        return $this->db
            ->table('artikel')
            ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }
    public function jumlahBerita()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->countAllResults();
    }

    //GET Informasi
    public function tampilInformasi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 2, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function jumlahInformasi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 2, 'is_active' => 1])
            ->countAllResults();
    }
    public function getInformasiDetail($judul)
    {
        return $this->db
            ->table('artikel')
            ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('judul', $judul)
            ->get()
            ->getRow();
    }

    //Get jumlah album Foto
    public function tampilAlbumfoto()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 3, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function jumlahFoto()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 3, 'is_active' => 1])
            ->countAllResults();
    }

    //Get jumlah album Video
    public function tampilAlbumvideo()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 4, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function jumlahVideo()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 4, 'is_active' => 1])
            ->countAllResults();
    }

    //Get Slide Show
    public function tampilSlideshow()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 7, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
}
