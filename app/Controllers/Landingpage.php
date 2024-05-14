<?php

namespace App\Controllers;

use App\Models\DistribusiVaksinModel;
use App\Models\KabupatenModel;
use App\Models\UsulanModel;

class Landingpage extends BaseController
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
    public function index(): string
    {
        $kabupatenModel = new KabupatenModel;
        $data = array(
            "data_kab" => $kabupatenModel->findAll(),
            "page" => "Landingpage/home.php"
        );
        return view('container', $data);
    }
    public function add_usulan()
    {
        $usulanModel = new UsulanModel;
        $validation = \Config\Services::validation();
        $rules = [
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.',
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nomor HP harus diisi.',
                ],
            ],
            'jumlah_ternak' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jumlah ternak harus diisi.',
                ],
            ],
        ];
        $data = array(
            "nama" => $this->request->getPost("nama"),
            "alamat" => $this->request->getPost("alamat"),
            "no_hp" => $this->request->getPost("no_hp"),
            "jumlah_ternak" => $this->request->getPost("jumlah_ternak")
        );
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $usulanModel->insert($data);
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
        return redirect()->to("/");
    }
    public function jenis_vaksin($idKab)
    {
        $distribusiModel = new DistribusiVaksinModel;
        $data = array(
            "data_vaksin" => $distribusiModel->select(
                "
                    distribusi_vaksin.id_jenis_vaksin,
                    jenis_vaksin.jenis_vaksin
                "
            )->join(
                "jenis_vaksin",
                "jenis_vaksin.id=distribusi_vaksin.id_jenis_vaksin",
                "left"
            )->where(
                "distribusi_vaksin.id_kabupaten",
                $idKab
            )->groupBy("id_jenis_vaksin")->findAll(),
            "kab" => $idKab
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function select_jenis_vaksin($idJenisVaksin)
    {
        $distribusiModel = new DistribusiVaksinModel;
        $data = array(
            "data_tahun_vaksin" => $distribusiModel->select(
                "
                    distribusi_vaksin.tahun_vaksin,
                    SUM(distribusi_vaksin.jumlah_dosis) AS total_jumlah_vaksin
                "
            )->where(
                "distribusi_vaksin.id_jenis_vaksin",
                $idJenisVaksin
            )->groupBy("distribusi_vaksin.tahun_vaksin")->findAll()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
}
