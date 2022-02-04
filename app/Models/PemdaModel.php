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

    //Pencarian Artikel________________________________________________________________________________________________________
    public function search($keyword)
    {
        return $this->db
            ->table('artikel')
            ->where(['is_active' => 1])
            ->like('judul', $keyword)
            ->get()
            ->getResultArray();
    }

    //Ganti FIle Gambar saat update____________________________________________________________________________________________
    public function gantiGambar($id)
    {
        $query = $this->getWhere(['id' => $id]);
        return $query;
    }


    //GET Tampil Semua Artikel_______________________________________________________________________________________________
    public function getSemuaartikel()
    {
        return $this->db
            ->table('artikel')
            ->where(['status_sistem_id' => 2])
            ->orderBy('RAND ()')
            ->get()
            ->getResultArray();
    }

    public function getFotofooter()
    {
        return $this->db
            ->table('artikel')
            ->where(['status_sistem_id' => 2])
            ->orderBy('RAND ()')
            ->limit('9')
            ->get()
            ->getResultArray();
    }
    public function getCostumpost()
    {
        return $this->db
            ->table('artikel')
            ->where(['status_sistem_id' => 2])
            ->orderBy('RAND ()')
            ->limit('3')
            ->get()
            ->getResultArray();
    }

    // GET Details Artikel________________________________________________________________________________________________
    public function getDetailsArtikel($slug)
    {
        return $this->db
            ->table('artikel')
            ->join('tipe_artikel', 'tipe_artikel.id=artikel.tipe_artikel_id')
            ->join('status_sistem', 'status_sistem.id=artikel.status_sistem_id')
            ->where('slug', $slug)
            ->get()
            ->getRow();
    }

    // GET Update Artikel___________________________________________________________________________________________________________
    public function getUpdateArtikel($id)
    {
        return $this->db
            ->table('artikel')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    //GET Tampil dan Jumlah Berita___________________________________________________________________________________________________
    // public function tampilBerita()
    // {
    //     return $this->db
    //         ->table('artikel')
    //         ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
    //         ->orderBy('RAND ()')
    //         ->get()
    //         ->getResultArray();
    // }
    public function jumlahBerita()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->countAllResults();
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
    public function contentBeritaMenu()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 1, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('4')
            ->get()
            ->getResultArray();
    }

    //GET Tampil dan Jumlah Informasi_______________________________________________________________________________________________
    // public function tampilInformasi()
    // {
    //     return $this->db
    //         ->table('artikel')
    //         ->where(['tipe_artikel_id' => 2, 'is_active' => 1])
    //         ->orderBy('RAND ()')
    //         ->get()
    //         ->getResultArray();
    // }
    public function jumlahInformasi()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 2, 'is_active' => 1])
            ->countAllResults();
    }
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
    public function contentInformasiMenu()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 2, 'opd_hdr_id' => 0, 'status_sistem_id' => 2])
            ->orderBy('RAND()')
            ->limit('4')
            ->get()
            ->getResultArray();
    }

    //Get Tampil dan jumlah Album Foto________________________________________________________________________________________________
    // public function tampilAlbumfoto()
    // {
    //     return $this->db
    //         ->table('artikel')
    //         ->where(['tipe_artikel_id' => 3, 'is_active' => 1])
    //         ->orderBy('RAND ()')
    //         // ->limit(2)
    //         ->get()
    //         ->getResultArray();
    // }
    public function jumlahFoto()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 3, 'is_active' => 1])
            ->countAllResults();
    }
    public function contentAlbumfotoMenu()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 3, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('4')
            ->get()
            ->getResultArray();
    }

    //Get Tampil dan jumlah Album Video_______________________________________________________________________________________________
    // public function tampilAlbumvideo()
    // {
    //     return $this->db
    //         ->table('artikel')
    //         ->where(['tipe_artikel_id' => 4, 'is_active' => 1])
    //         ->get()
    //         ->getResultArray();
    // }
    public function jumlahVideo()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 4, 'is_active' => 1])
            ->countAllResults();
    }
    public function contentAlbumvideoMenu()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 4, 'is_active' => 1])
            ->orderBy('RAND()')
            ->limit('4')
            ->get()
            ->getResultArray();
    }

    //GET Tampil dan Jumlah Visi______________________________________________________________________________________________
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

    //GET Tampil dan Jumlah Misi________________________________________________________________________________________________
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

    //Get Tampil Slide Show______________________________________________________________________________________________________
    // public function tampilSlideshow()
    // {
    //     return $this->db
    //         ->table('artikel')
    //         ->where(['tipe_artikel_id' => 7, 'opd_hdr_id' => 0, 'status_sistem_id' => 2])
    //         ->orderBy('RAND ()')
    //         ->get()
    //         ->getResultArray();
    // }
    public function jumlahSlideshow()
    {
        return $this->db
            ->table('artikel')
            ->where(['tipe_artikel_id' => 7, 'is_active' => 1])
            ->countAllResults();
    }


    //Notifikasi Berita Kanan Content_______________________________________________________________________________________________________
    public function bacaIni()
    {
        return $this->db
            ->table('artikel')
            ->orderBy('RAND()')
            ->limit(1, 0)
            ->get()
            ->getResultArray();
    }
}
