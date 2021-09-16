<?php

namespace App\Models;

use CodeIgniter\Model;

class PemdaModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id', 'judul', 'slug', 'file_gambar', 'path_file_gambar', 'isi_artikel', 'created_date', 'last_modified_date', 'nama_pengarang', 'user_created', 'user_updated',
        'notes', 'opd_hdr_id', 'is_active', 'tipe_artikel_id', 'status_sistem_id'
    ];

    // Details Artikel
    public function getDetails($slug)
    {
        return $this->db
            ->table('artikel')
            ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }



    //GET Order informasi & Berita pada Content_______________________________________________________________________
    public function contentInformasi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 2, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('10')
            ->get()
            ->getResultArray();
    }
    public function contentBerita()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('10')
            ->get()
            ->getResultArray();
    }

    //Get Konten File Latest Post________________________________________________________________________________________
    public function contentLatestpostList()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('10')
            ->get()
            ->getResultArray();
    }
    public function contentLatestpostBox()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('1')
            ->get()
            ->getResultArray();
    }

    //Notifikasi Berita Kanan_____________________________________________________________________________________
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




    //GET Visi_________________________________________________________________________________________________
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








    //GET Misi_____________________________________________________________________________________________________
    public function tampilMisi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 6, 'is_active' => 1])
            ->get()
            ->getResultArray();
    }
    public function getMisiUpdate($slug)
    {
        return $this->db
            ->table('artikel')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }
    public function jumlahMisi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 6, 'is_active' => 1])
            ->countAllResults();
    }




    //GET Berita__________________________________________________________________________________________________________
    public function tampilBerita()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('RAND ()')
            ->get()
            ->getResultArray();
    }
    public function getBeritaUpdate($slug)
    {
        return $this->db
            ->table('artikel')
            ->where('slug', $slug)
            ->get()
            ->getRow();
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
            ->orderBy('RAND ()')
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
    public function getInformasiUpdate($slug)
    {
        return $this->db
            ->table('artikel')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }
    public function getInformasiDetail($slug)
    {
        return $this->db
            ->table('artikel')
            ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }

    //Get jumlah album Foto
    public function tampilAlbumfoto()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 3, 'is_active' => 1])
            ->orderBy('RAND ()')
            // ->limit(2)
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
            ->orderBy('RAND ()')
            ->get()
            ->getResultArray();
    }
    public function getSlideShowDetail($slug)
    {
        return $this->db
            ->table('artikel')
            ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }
}
