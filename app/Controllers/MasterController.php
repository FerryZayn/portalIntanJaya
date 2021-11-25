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

        $pegawai = $this->db->query("CALL pegawai_view('$user')")->getResult();
        $golongan = $this->db->query("select * from golongan_pegawai")->getResult();

        $opd_id = $this->session->id;
        $jabatan = $this->db->query("select id, nama_jabatan from jabatan where opd_hdr_id =" . $opd_id)->getResult();

        $pegawai_id = $this->session->id;
        $vartikel = $this->db->query("call pegawai_view($pegawai_id)")->getResultArray();
        $data = [
            'title' => 'Pegawai Details | e-Surat',
            'uri' => $this->request->uri->getSegment(1),
            'get' => $this->session,
            'data' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'iscrud' => $procedure->iscrud($user),

            'v_pegawai' => $vartikel,
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


        // dd($this->request->getVar());
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
            // dd($this->request->getVar('phone'));

            $result = $this->db->query("CALL pegawai_insert($user,'$nama_pegawai','$nik','$nip','$gender','$nohp','$email','$golongan','$kode','$username','$passwd','$jabatan_id','$tanggal_lahir')")->getRow();
            // $result = $this->db->query("CALL pegawai_insert($user,'$nama_pegawai','$nik','$nip', '$gender','$no_hp','$email','$golongan','$kode','$username','$passwd','$jabatan_id','$tanggal_lahir')")->getRow();
            // dd($result->n);
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
        // return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        return view('/administrator/master/v_pegawai');
    }
}
