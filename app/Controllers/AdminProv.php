<?php

namespace App\Controllers;

use App\Models\DokumentasiModel;
use App\Models\KabupatenModel;
use App\Models\VaksinModel;

class AdminProv extends BaseController
{
    public function notValidMessage($t)
    {
        return (
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span style="margin-right: 6px;">' . $t . '</span> :(
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
    }
    public function index()
    {
        $data = array(
            "page" => "Admin/provinsi/dashboard.php"
        );
        return view("container", $data);
    }
    public function data_kabupaten()
    {
        $kabupatenModel = new KabupatenModel;
        $data = array(
            "page" => "Admin/provinsi/data_kabupaten.php",
            "data_kab" => $kabupatenModel->findAll()
        );
        return view("container", $data);
    }
    public function add_kabupaten()
    {
        $validation = \Config\Services::validation();
        $kabupatenModel = new KabupatenModel;
        $data = array(
            "nama_kabupaten" => $this->request->getPost("kabupaten"),
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password")
        );
        $rules = [
            'nama_kabupaten' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten harus diisi.',
                ],
            ],
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username harus diisi.',
                ],
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
                ],
            ],
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $kabupatenModel->insert($data);
            session()->setFlashdata(
                "message",
                '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   Success
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            '
            );
        } else {
            $errors = $validation->getErrors();
            $arr = array();
            foreach ($errors as $e) :
                array_push($arr, $this->notValidMessage($e));
            endforeach;
            $str = implode("", $arr);
            session()->setFlashdata(
                "message",
                $str
            );
        }
        return redirect()->to("admin_prov/data_kabupaten");
        // return $this->response->setStatusCode(200);
    }
    public function delete_kabupaten($id_kab)
    {
        $kabupatenModel = new KabupatenModel;
        $kabupatenModel->delete($id_kab);
        session()->setFlashdata(
            "message",
            '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   Success
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            '
        );
        return redirect()->to("admin_prov/data_kabupaten");
    }
    public function edit_kabupaten($id_kab)
    {
        $validation = \Config\Services::validation();
        $kabupatenModel = new KabupatenModel;
        $data = array(
            "nama_kabupaten" => $this->request->getPost("kabupaten"),
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("password")
        );
        $rules = [
            'nama_kabupaten' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten harus diisi.',
                ],
            ],
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username harus diisi.',
                ],
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
                ],
            ],
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $kabupatenModel->update($id_kab, $data);
            session()->setFlashdata(
                "message",
                '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   Success
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            '
            );
        } else {
            $errors = $validation->getErrors();
            $arr = array();
            foreach ($errors as $e) :
                array_push($arr, $this->notValidMessage($e));
            endforeach;
            $str = implode("", $arr);
            session()->setFlashdata(
                "message",
                $str
            );
        }
        return redirect()->to("admin_prov/data_kabupaten");
    }
    public function laporan()
    {
        $kabupatenModel = new KabupatenModel;
        $data = array(
            "page" => "Admin/provinsi/laporan.php",
            "kabupaten" => $kabupatenModel->findAll()
        );
        return view("container", $data);
    }
    public function laporan_detail()
    {
        $vaksinModel = new VaksinModel;
        // $jadwal = $this->request->getPost("jadwal");
        $id_kab = $this->request->getVar("kabupaten");
        $dari = $this->request->getVar("from");
        $sampai = $this->request->getVar("to");
        $data = "";
        $data = $vaksinModel->join(
            "pemilik_ternak",
            "pemilik_ternak.id_pemilik_ternak = vaksinasi.id_peternak",
            "left"
        )->join(
            "jadwal_vaksin",
            "jadwal_vaksin.id_vaksin = vaksinasi.id_vaksinasi",
            "left"
        )->whereIn(
            "vaksinasi.id_vaksinasi",
            db_connect()->table(
                "jadwal_vaksin"
            )->select("id_vaksin")
        )
            ->where(
                "pemilik_ternak.id_kab",
                $id_kab
            )->where(
                "jadwal_vaksin.tgl_pemberian >=",
                $dari
            )->where(
                "jadwal_vaksin.tgl_pemberian <=",
                $sampai
            )->findAll();


        // return;
        return $this->response->setStatusCode(200)->setJSON(array("data" => $data));
    }
}
