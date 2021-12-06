<?php

namespace App\Controllers;

use App\Models\ProcedureModel;

class MasterController extends BaseController
{
    public function index()
    {
        return view('/administrator/master/dashboard');
    }

    public function pegawaiHome()
    {
        $procedure = new ProcedureModel;
        $user = $this->session->id;
        $pegawai = $this->db->query("CALL pegawai_view('$user')")->getResultArray();
        $golongan = $this->db->query("select * from golongan_pegawai")->getResult();

        // $opd_id = $this->session->opd_id;
        // $jabatan = $this->db->query("select id, nama_jabatan from jabatan where opd_hdr_id =" . $opd_id)->getResult();

        $opd_hdr_id = $this->session->opd_id;
        $jabatan = $this->db->query("call jabatan_view('$opd_hdr_id')")->getResult();

        $data = [
            'title' => 'Pegawai Details | e-Surat',
            'uri' => $this->request->uri->getSegment(1),
            'get' => $this->session,
            'v_pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'iscrud' => $procedure->iscrud($user),
        ];
        return view('/administrator/master/v_pegawai', $data);
    }

    public function prosesaddPegawai()
    {
        $this->validation->setRules([
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap Harus diisi !'
                ]
            ],

            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'password' => [
                'rules' => 'password',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'golongan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'kode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi !'
                ]
            ],


        ]);

        $isDataValid = $this->validation->withRequest($this->request)->run();

        session()->setFlashdata('fullname', $this->validation->getError('fullname'));
        session()->setFlashdata('nik', $this->validation->getError('nik'));
        session()->setFlashdata('nip', $this->validation->getError('nip'));
        session()->setFlashdata('gender', $this->validation->getError('gender'));
        session()->setFlashdata('phone', $this->validation->getError('phone'));
        session()->setFlashdata('email', $this->validation->getError('email'));
        session()->setFlashdata('golongan', $this->validation->getError('golongan'));
        session()->setFlashdata('kode', $this->validation->getError('kode'));
        session()->setFlashdata('username', $this->validation->getError('username'));
        session()->setFlashdata('jabatan', $this->validation->getError('jabatan'));
        session()->setFlashdata('tgl_lahir', $this->validation->getError('tgl_lahir'));


        if ($isDataValid) {
            $user = $this->session->id;
            $nama_pegawai = $this->request->getVar('fullname');
            $nik = $this->request->getVar('nik');
            $nip = $this->request->getVar('nip');
            $gender = $this->request->getVar('gender');
            $nohp = $this->request->getVar('phone');
            $email = $this->request->getVar('email');
            $golongan = $this->request->getVar('golongan');
            $kode = $this->request->getVar('kode');
            $username = $this->request->getVar('username');
            $passwd = $this->request->getVar('password');
            $jabatan_id = $this->request->getVar('jabatan');
            $tanggal_lahir = $this->request->getVar('tgl_lahir');

            $result = $this->db->query("CALL pegawai_insert($user,'$nama_pegawai','$nik','$nip','$gender','$nohp','$email','$golongan','$kode','$username','$passwd','$jabatan_id','$tanggal_lahir')")->getRow();

            if ($result->n == 81) {
                session()->setFlashdata('pesan', 'add');
                return redirect()->to('/administrator/master/v_pegawai');
            } elseif ($result->n == 80) {
                session()->setFlashdata('pesan', 'update');
                return redirect()->back()->withInput();
                // return redirect()->to('/administrator/master/v_pegawai');
            } elseif ($result->n == 54) {

                session()->setFlashdata('pesan', '54');
                return redirect()->back()->withInput();
                // return redirect()->to('/administrator/master/v_pegawai');
            }
        }

        session()->setFlashdata('pesan', 'isvalid');
        return view('/administrator/master/v_pegawai');
    }



    public function hapusPegawai()
    {
        $p_id_input = $this->request->getPost('id');
        $pegawai_id = $this->session->id;
        // $this->db->query("CALL bidang_delete('$id','$user')");
        $this->db->query("call pegawai_delete('$p_id_input', '$pegawai_id')");
        session()->setFlashdata('pesan', 'delete');
        return redirect()->to('/administrator/master/v_pegawai');
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
}
