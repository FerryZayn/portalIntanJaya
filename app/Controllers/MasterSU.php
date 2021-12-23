<?php

namespace App\Controllers;

use App\Models\ProcedureModel;

class MasterSU extends BaseController
{

    protected $procedureModel;
    public function __construct()
    {
        $this->procedureModel = new ProcedureModel();
        $this->db = \Config\Database::connect();
    }


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

    //Pegawai SU_____________________________________________________________________________________________________
    public function pegawai()
    {
        $procedure = new ProcedureModel;
        $pegawai = $this->db->query("call pegawai_view_su()")->getResultArray();
        $p_input_id = $this->session->id;
        $jabatan = $this->db->query("call jabatan_view($p_input_id)")->getResultArray();
        $golongan = $this->db->query("select * from golongan_pegawai")->getResult();
        $data = [
            'tampilpegawai' => $pegawai,

            // 'tampiledit' => $procedure->pegawaiViewdtl(),

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


    public function editPegawaisu($p_id)
    {
        $procedure = new ProcedureModel;
        $golongan = $this->db->query("select * from golongan_pegawai")->getResult();
        $data = [
            'golongan' => $golongan,
            'tampiledit' => $this->procedureModel->pegawaiViewdtl($p_id),
            'opdview' => $procedure->selectOpd(),
        ];
        return view('/administrator/mastersu/v_pegawai_edit', $data);
    }


    public function prosesUpdatePegawai()
    {
        $p_id_input = $this->session->id;
        $pegawai_id = $this->request->getVar('pegawai_id');
        $p_nama = $this->request->getVar('p_nama');
        $p_nik = $this->request->getVar('p_nik');
        $p_nip = $this->request->getVar('p_nip');
        $p_kelamin_code = $this->request->getVar('p_kelamin_code');
        $p_no_hp = $this->request->getVar('p_no_hp');
        $p_email = $this->request->getVar('p_email');
        $p_golongan_id = $this->request->getVar('p_golongan_id');
        $opd_id = $this->request->getVar('opd_id');
        $tempat_l = $this->request->getVar('tempat_l');
        $p_jabatan = $this->request->getVar('p_jabatan');
        $p_tanggal_lahir = $this->request->getVar('p_tanggal_lahir');
        // dd($this->request->getVar());

        $is_p = $this->request->getVar('is_p');
        $pegawai = $is_p == "on" ? '1' : '0';

        $this->db->query("call pegawai_update_su('$p_id_input', '$p_nama', '$p_nik', '$p_nip', '$p_kelamin_code', '$p_no_hp', '$p_email', '$p_golongan_id', '$p_jabatan', '$p_tanggal_lahir', '$pegawai_id', '$pegawai', '$tempat_l', '$opd_id')");

        session()->setFlashdata('pesan', 'suksesedit');
        return redirect()->to('/administrator/mastersu/v_pegawai');
    }



    public function hapusPegawaisu()
    {
        $pegawai_id = $this->request->getPost('pegawai_id');
        $p_id_input = $this->session->id;

        $this->db->query("call pegawai_delete('$p_id_input', '$pegawai_id')");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/mastersu/v_pegawai');
    }




    //OPD_____________________________________________________________________________________________________
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

    public function opdHapussu()
    {
        $opd_hdr_id = $this->request->getPost('opd_hdr_id');
        $pegawai_id = $this->session->id;

        $this->db->query("call opd_delete('$opd_hdr_id', '$pegawai_id') ");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/mastersu/v_opd');
    }




    //Bidang_____________________________________________________________________________________________________
    public function addmasterBidang()
    {
        $pegawai_id = $this->session->id;
        $kd = $this->request->getVar('kd');
        $nama_bidang = $this->request->getVar('nama_bidang');
        $tipe_b_id = $this->request->getVar('tipe_b_id');
        $this->db->query("call bidang_insert('$pegawai_id', '$kd', '$nama_bidang', '$tipe_b_id')");
        session()->setFlashdata('info', 'Add Bidang berhasil');
        return redirect()->to('/administrator/mastersu/v_opd');
    }



    // Master Bidang SU________________________________________________________________________________________
    public function masterBidangSU($id)
    {
        $procedure = new ProcedureModel;

        $data = [
            'title' => 'e-Surat | Bidang',
            'uri' => $this->request->uri->getSegment(1),
            'get' => $this->session,
            'data' => $procedure->bidangViewsu($id),
            'select' => $procedure->selectOpd(),
            'id_opd' => $id,
        ];
        return view('/administrator/mastersu/v_master_bidang', $data);
    }

    public function addmasterBidangsu()
    {
        $pegawai_id = $this->session->id;
        $kd = $this->request->getVar('kd');
        $nama_bidang = $this->request->getVar('nama_bidang');
        $tipe_b_id = $this->request->getVar('tipe_b_id');
        $opd_id = $this->request->getVar('opd_id');
        $query = $this->db->query("call bidang_insert_su('$pegawai_id', '$kd', '$nama_bidang', '$tipe_b_id', '$opd_id')")->getRow();
        if ($query->n == 81) {
            session()->setFlashdata('Info', 'Data Berhasil Ditambahkan');
        } elseif ($query->n == 80) {
            session()->setFlashdata('Info', 'Oppssss, Data Sudah ada!');
        }
        return redirect()->to('/masterbidangsu' . '/' . $opd_id);
    }


    public function updateMasterBidangSU()
    {
        $pegawai_id = $this->session->id;
        $kode_bidang = $this->request->getVar('kode_bidang');
        $nama_bidang = $this->request->getVar('nama_bidang');
        $bidang_id = $this->request->getVar('bidang_id');

        $opd_id = $this->request->getVar('opd_id');

        $this->db->query("CALL bidang_update('$bidang_id','$pegawai_id','$kode_bidang','$nama_bidang')");
        session()->setFlashdata('Info', 'Update Data Bidang Berhasil...');
        return redirect()->to('/masterbidangsu' . '/' . $opd_id);
    }

    public function delete()
    {
        $bidang_id = $this->request->getPost('bidang_id');
        $pegawai_id = $this->session->id;

        $opd_id = $this->request->getPost('opd_id');

        $this->db->query("call bidang_delete('$bidang_id', '$pegawai_id') ");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/masterbidangsu' . '/' . $opd_id);
    }




    // Master Sub Bidang SU________________________________________________________________________________________
    public function masterSubid($opd, $bidang)
    {

        $subidang = $this->db->query("CALL sub_bidang_view($bidang)")->getResult();
        $data = [
            'title' => 'e-Surat | Bidang',
            'uri' => $this->request->uri->getSegment(1),
            'get' => $this->session,
            'data' => $subidang,
            'id_opd' => $opd,
            'id' => $bidang,
            // 'iscrud' => $procedure->iscrud($user),
        ];
        return view('pages/master/v_master_subidang', $data);
    }

    public function masteraddSubid()
    {
        $user = $this->session->id;
        $kode_sub = $this->request->getVar('kode_subid');
        $nama_subid = $this->request->getVar('nama_subid');
        $id = $this->request->getVar('id');
        $id_opd = $this->request->getVar('id_opd');
        $result = $this->db->query("CALL sub_bidang_insert('$user', '$kode_sub','$id','$nama_subid')")->getRow();
        // dd($result);
        if ($result->n == 81) {
            session()->setFlashdata('pesan', 'add');
        } elseif ($result->n == 80) {
            session()->setFlashdata('pesan', 'ganda');
        }

        return redirect()->to('/mastersubbidang' . '/' . $id_opd . '/' . $id);
    }

    public function masterupdateSubid()
    {
        // dd($this->request->getVar());
        $user = $this->session->id;
        $kode_sub = $this->request->getVar('kode_subid');
        $nama_subid = $this->request->getVar('nama_subid');
        $id = $this->request->getVar('id');
        $bidang_id = $this->request->getVar('bidang_id');
        $id_opd = $this->request->getVar('id_opd');

        $this->db->query("CALL sub_bidang_update('$user','$kode_sub','$bidang_id','$nama_subid','$id')");
        session()->setFlashdata('pesan', 'update');
        return redirect()->to('/mastersubbidang' . '/' . $id_opd . '/' . $bidang_id);
    }


    public function masterdeletesubid()
    {
        $id = $this->request->getPost('id');
        $bidang_id = $this->request->getVar('bidang_id');
        $id_opd = $this->request->getVar('id_opd');
        $user = $this->session->id;
        $this->db->query("CALL sub_bidang_delete('$user','$id')");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/mastersubbidang' . '/' . $id_opd . '/' . $bidang_id);
    }





    // Master Jabatan SU________________________________________________________________________________________
    public function masterJabatansu($id)
    {
        $procedure = new ProcedureModel;
        $user = $this->session->id;
        $jabatan = $this->db->query("CALL jabatan_view_su('$id')")->getResultArray();
        $bidang = $this->db->query("CALL bidang_view_su('$id')")->getResultArray();
        $subbidang = $this->db->query("call sub_bidang_view($id)")->getResultArray();

        $data = [
            'uri' => $this->request->uri->getSegment(1),
            'get' => $this->session,
            'data' => $jabatan,
            'select' => $bidang,
            'subbid' => $subbidang,
            'id_opd' => $id,
            'iscrud' => $procedure->iscrud($user),
        ];
        return view('/administrator/mastersu/v_master_jabatan', $data);
    }


    public function addmasterJabatansu()
    {
        $pegawai_id = $this->session->id;
        $kd = $this->request->getVar('kd');
        $sb_id = $this->request->getVar('sb_id');
        $b_id = $this->request->getVar('b_id');
        $lvl = $this->request->getVar('lvl');
        $nama_j = $this->request->getVar('nama_j');
        $hah_id = $this->request->getVar('hah_id');
        $notes = $this->request->getVar('notes');

        $opd_id = $this->request->getVar('opd_id');

        $this->db->query("call jabatan_insert_su('$pegawai_id', '$kd', '$b_id', '$sb_id', '$lvl', '$nama_j', '$hah_id', '$notes', '$opd_id')");
        session()->setFlashdata('pesan', 'add');

        return redirect()->to('masterjabatansu/' . $opd_id);
    }


    public function masterDeljabatansu()
    {
        $j_id = $this->request->getVar('j_id');
        $pegawai_id = $this->session->id;

        $opd_id = $this->request->getVar('opd_id');

        $this->db->query("call jabatan_delete('$j_id', '$pegawai_id')")->getRow();

        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('masterjabatansu/' . $opd_id);
    }
}
