<?php

namespace App\Controllers;

use App\Models\ProcedureModel;

class MasterSU extends BaseController
{
    public function index()
    {
        $opd = $this->db->query("call opd_view()")->getResultArray();
        $data = [
            'opdtampil' => $opd,
        ];
        return view('/administrator/mastersu/dashboard', $data);
    }

    public function selectJabatan($opd_id)
    {
        $jabatan = $this->db->query("CALL jabatan_view_su('$opd_id')")->getResult();
        return json_encode($jabatan);
    }
    public function pegawai()
    {
        $procedure = new ProcedureModel;
        $pegawai = $this->db->query("call pegawai_view_su()")->getResultArray();

        $p_input_id = $this->session->id;
        $jabatan = $this->db->query("call jabatan_view($p_input_id)")->getResultArray();

        $golongan = $this->db->query("select * from golongan_pegawai")->getResult();
        $data = [
            'tampilpegawai' => $pegawai,
            'jabatan' => $jabatan,

            'golongan' => $golongan,
            'opdview' => $procedure->selectOpd(),
        ];
        return view('/administrator/mastersu/v_pegawai', $data);
    }


    public function addPegawaisu()
    {
        $p_id_input = $this->session->id;
        $p_nama = $this->request->getVar('p_nama');
        $p_nik = $this->request->getVar('p_nik');
        $p_nip = $this->request->getVar('p_nip');
        $p_kelamin_code = $this->request->getVar('p_kelamin_code');
        $p_no_hp = $this->request->getVar('p_no_hp');
        $p_email = $this->request->getVar('p_email');
        $p_golongan_id = $this->request->getVar('p_golongan_id');
        $p_kode = $this->request->getVar('p_kode');
        $p_username = $this->request->getVar('p_username');
        $p_passwd = $this->request->getVar('p_passwd');
        $p_jabatan = $this->request->getVar('p_jabatan');
        $p_tanggal_lahir = $this->request->getVar('p_tanggal_lahir');
        $opd_id = $this->request->getVar('opd_id');
        $is_p = $this->request->getVar('is_p');

        $pegawai = $is_p == "on" ? '1' : '0';


        $result = $this->db->query("call pegawai_insert_su('$p_id_input', '$p_nama', '$p_nik', '$p_nip', '$p_kelamin_code', '$p_no_hp', '$p_email', '$p_golongan_id', '$p_kode', '$p_username', '$p_passwd', '$p_jabatan', '$p_tanggal_lahir', '$opd_id', '$pegawai')")->getRow();

        if ($result->n == 81) {
            session()->setFlashdata('pesan', 'add');
        } elseif ($result->n == 80) {
            session()->setFlashdata('pesan', 'ganda');
        } elseif ($result->n == 54) {
            session()->setFlashdata('pesan', '54');
        }

        // return view('/administrator/mastersu/v_pegawai');
        // return redirect()->to('/administrator/mastersu/v_pegawai');
        session()->setFlashdata('info', 'Proses simpan Pegawai OPD berhasil');
        return redirect()->to('/administrator/mastersu/v_pegawai');
    }















    public function editPegawai()
    {
        $id = $this->request->getVar('id');
        $user = $this->session->id;
        $nama_pegawai = $this->request->getVar('fullname');
        $nik = $this->request->getVar('nik');
        $nip = $this->request->getVar('nip');
        $gender = $this->request->getVar('gender');
        $no_hp = $this->request->getVar('no_telpone');
        $email = $this->request->getVar('email');
        $golongan = $this->request->getVar('golongan');
        $kode = $this->request->getVar('kode');
        $username = $this->request->getVar('username');
        $passwd = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $jabatan_id = $this->request->getVar('jabatan');
        $tanggal_lahir = $this->request->getVar('tgl_lahir');
        // dd($this->request->getVar());
        $this->db->query("CALL pegawai_update('$id','$nama_pegawai','$nik','$nip', '$gender','$no_hp','$email','$golongan','$kode','$username','$passwd','$jabatan_id','$tanggal_lahir','$user')");
        session()->setFlashdata('pesan', 'suksesedit');
        return redirect()->to('/administrator/master/v_pegawai');
    }



    public function hapusPegawaisu()
    {
        $pegawai_id = $this->request->getPost('pegawai_id');
        $p_id_input = $this->session->id;

        $this->db->query("call pegawai_delete('$p_id_input', '$pegawai_id')");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/mastersu/v_pegawai');
    }










    public function bidang()
    {
        $pegawai_id = $this->session->id;
        $vbidang = $this->db->query("call bidang_view($pegawai_id)")->getResultArray();
        $data = [
            'data' => $vbidang,
        ];
        return view('/administrator/master/v_bidang', $data);
    }

    public function addBidang()
    {
        $pegawai_id = $this->session->id;
        $kd = $this->request->getVar('kd');
        $nama_bidang = $this->request->getVar('nama_bidang');
        $tipe_b_id = $this->request->getVar('tipe_b_id');

        $this->db->query("call bidang_insert('$pegawai_id', '$kd', '$nama_bidang', '$tipe_b_id')");
        session()->setFlashdata('info', 'Add Bidang berhasil');
        return redirect()->to('/administrator/master/v_bidang');
    }

    public function updateBidang()
    {
        $bidang_id = $this->request->getVar('id');

        $pegawai_id = $this->session->id;
        $kode = $this->request->getVar('kode');
        $nama_bidang = $this->request->getVar('nama_bidang');
        $this->db->query("call bidang_update('$bidang_id', '$pegawai_id', '$kode', '$nama_bidang')");
        session()->setFlashdata('pesan', 'update');
        return redirect()->to('/administrator/master/v_bidang');
    }

    public function hapusBidang()
    {
        $id = $this->request->getPost('id');
        $user = $this->session->id;
        $this->db->query("CALL bidang_delete('$id','$user')");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/master/v_bidang');
    }


    public function jabatan()
    {
        $procedure = new ProcedureModel;
        $user = $this->session->id;
        $jabatan = $this->db->query("CALL jabatan_view('$user')")->getResult();
        $hak_akses = $this->db->query("select * from hak_akses_hdr where id != 0")->getResult();
        $subid = $this->db->query("select id,nama_sub_bidang from sub_bidang")->getResult();
        $sjabatan = $this->db->query("select * from level_jabatan where id != 0")->getResult();


        $data = [
            'title' => 'Jabatan | e-Surat',
            'uri' => $this->request->uri->getSegment(1),
            'get' => $this->session,
            'data' => $jabatan,
            'subid' => $subid,
            'sjabatan' => $sjabatan,
            'select' => $procedure->bidangView($user),
            'iscrud' => $procedure->iscrud($user),
            'hk' => $hak_akses,
        ];
        return view('/administrator/master/v_jabatan', $data);
    }
    public function addJabatan()
    {
        // dd($this->request->getVar());
        $user = $this->session->id;
        $bidang = $this->request->getVar('bidang');
        $subid = $this->request->getVar('subid');
        $jabatan = $this->request->getVar('jabatan');
        $kode = $this->request->getVar('kode');
        $level = $this->request->getVar('level');
        $akses = $this->request->getVar('hakakses');
        $notes = $this->request->getVar('notes');

        $result = $this->db->query("CALL jabatan_insert('$user','$kode',$bidang,$subid,'$level','$jabatan','$akses','$notes') ")->getRow();
        if ($result->n == 81) {
            session()->setFlashdata('pesan', 'add');
            return redirect()->to('/administrator/master/v_jabatan');
        } elseif ($result->n == 80) {
            session()->setFlashdata('pesan', 'ganda');
            return redirect()->to('/administrator/master/v_jabatan');
        }
    }
    public function updateJabatan()
    {
        $user = $this->session->id;
        $id = $this->request->getVar('id');
        $bidang = $this->request->getVar('bidang');
        $subid = $this->request->getVar('subid');
        $jabatan = $this->request->getVar('jabatan');
        $kode = $this->request->getVar('kode');
        $level = $this->request->getVar('level');
        $akses = $this->request->getVar('hakakses');
        $notes = $this->request->getVar('notes');

        $this->db->query("CALL jabatan_update('$user','$kode','$bidang','$subid','$level','$jabatan','$akses','$notes','$id') ");


        session()->setFlashdata('pesan', 'update');
        return redirect()->to('/administrator/master/v_jabatan');
    }
    public function deleteJabatan()
    {
        $id = $this->request->getPost('id');
        $user = $this->session->id;
        $this->db->query("CALL jabatan_delete('$id','$user')");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/master/v_jabatan');
    }




    public function opd()
    {
        $opd = $this->db->query("call opd_view()")->getResultArray();

        $data = [
            'opdtampil' => $opd,
        ];
        return view('/administrator/mastersu/v_opd', $data);
    }
    public function tambahOpdsu()
    {
        $pegawai_id = $this->session->id;
        $nama_opd = $this->request->getVar('opd');
        $alamat_opd = $this->request->getVar('alamat');
        $kode_pos = $this->request->getVar('k_pos');
        $telepon = $this->request->getVar('telepone');
        $fax = $this->request->getVar('fax');
        $email = $this->request->getVar('email');
        $website = $this->request->getVar('website');
        $kode = $this->request->getVar('kode');
        $level = $this->request->getVar('level');
        $nuk = $this->request->getVar('nuk');

        $insert = $this->db->query("CALL opd_insert('$pegawai_id', '$kode','$nama_opd','$alamat_opd','$kode_pos','$telepon','$fax','$email','$website','$level','$nuk')")->getRow();

        if ($insert->n == 81) {
            session()->setFlashdata('pesan', 'add');
        } elseif ($insert->n == 80) {
            session()->setFlashdata('pesan', 'ganda');
        }
        return redirect()->to('/administrator/mastersu/v_opd');
    }

    // GET Hapus OPD___________________________________________________________________________________
    public function opdHapussu()
    {
        $opd_hdr_id = $this->request->getPost('opd_hdr_id');
        $pegawai_id = $this->session->id;

        $this->db->query("call opd_delete('$opd_hdr_id', '$pegawai_id') ");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/mastersu/v_opd');
    }
}
