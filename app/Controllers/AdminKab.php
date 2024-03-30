<?php

namespace App\Controllers;

use App\Models\JadwalVaksinModel;
use App\Models\KabupatenModel;
use App\Models\PeternakModel;
use App\Models\VaksinModel;
use CodeIgniter\Database\BaseBuilder;

class AdminKab extends BaseController
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
            "page" => "Admin/kabupaten/dashboard.php"
        );
        return view("container", $data);
    }
    public function data_peternak()
    {
        $peternakModel = new PeternakModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "page" => "Admin/kabupaten/data_peternak.php",
            "data_peternak" => $peternakModel->join("admin_kabupaten", "admin_kabupaten.id_kab=pemilik_ternak.id_kab", "left")->where("pemilik_ternak.id_kab", $id_kab)->findAll(80)
        );
        return view("container", $data);
    }
    public function data_vaksin()
    {
        $peternakModel = new PeternakModel;
        $vaksinModel = new VaksinModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "page" => "Admin/kabupaten/data_vaksin.php",
            "data_vaksin" => $vaksinModel->join("pemilik_ternak", "pemilik_ternak.id_pemilik_ternak=vaksinasi.id_peternak", "left")->findAll(80),
            "data_peternak" => $peternakModel->where("pemilik_ternak.id_kab", $id_kab)->findAll()
        );
        return view("container", $data);
    }
    public function add_vaksin()
    {
        $validation = \Config\Services::validation();
        $vaksinModel = new VaksinModel;
        $data = array(
            "id_peternak" => $this->request->getPost("id_peternak"),
            "jumlah_dosis" => $this->request->getPost("jumlah_dosis"),
            "jenis" => $this->request->getPost("jenis")
        );
        $rules = [
            'id_peternak' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Peternak harus diisi.',
                ],
            ],
            'jumlah_dosis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jumlah dosis harus diisi.',
                ],
            ],
            'jenis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis vaksin harus diisi.',
                ],
            ],
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $vaksinModel->insert($data);
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
        return redirect()->to("admin_kab/data_vaksin");
    }
    public function delete_vaksin($id_vaksin)
    {
        $vaksinModel = new VaksinModel;
        $vaksinModel->delete($id_vaksin);
        session()->setFlashdata(
            "message",
            '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   Success
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            '
        );
        return redirect()->to("admin_kab/data_vaksin");
    }
    public function edit_vaksin($id_vaksin)
    {
        $validation = \Config\Services::validation();
        $vaksinModel = new VaksinModel;
        $data = array(
            "id_peternak" => $this->request->getPost("id_peternak"),
            "jumlah_dosis" => $this->request->getPost("jumlah_dosis"),
            "jenis" => $this->request->getPost("jenis")
        );
        $rules = [
            'id_peternak' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Peternak harus diisi.',
                ],
            ],
            'jumlah_dosis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jumlah dosis harus diisi.',
                ],
            ],
            'jenis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis vaksin harus diisi.',
                ],
            ],
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $vaksinModel->update($id_vaksin, $data);
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
        return redirect()->to("admin_kab/data_vaksin");
    }
    public function data_jadwal_vaksin()
    {
        $status = $this->request->getVar("status");
        $vaksinModel = new VaksinModel;
        $dataJadwalVaksin = "";
        $id_kab = session()->get("user")["id"];
        if ($status == "0" or $status == "") {
            $dataJadwalVaksin = $vaksinModel->join(
                "pemilik_ternak",
                "pemilik_ternak.id_pemilik_ternak = vaksinasi.id_peternak",
                "left"
            )->where(
                "pemilik_ternak.id_kab",
                $id_kab
            )->findAll();
        }
        // $dataJadwalVaksin = $dataJadwalVaksinModel->select(
        //     "
        //         jadwal_vaksin.id_jadwal,
        //         jadwal_vaksin.tgl_pemberian,
        //         vaksinasi.jumlah_dosis,
        //         vaksinasi.id_vaksinasi
        //     "
        // );
        $data = array(
            "page" => "Admin/kabupaten/data_jadwal_vaksin.php",
            "data_jadwal_vaksin" => $dataJadwalVaksin
        );
        return view("container", $data);
    }
    public function input_jadwal()
    {
        $validation = \Config\Services::validation();
        $jadwalVaksinModel = new JadwalVaksinModel;
        $id_jadwal = $this->request->getVar("id_jadwal");
        $data = array(
            "id_vaksin" => $this->request->getPost("id_vaksin"),
            "tgl_pemberian" => $this->request->getPost("tgl_pemberian")
        );
        $rules = [
            'id_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID Vaksin harus diisi.',
                ],
            ],
            'tgl_pemberian' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal pemberian harus diisi.',
                ],
            ]
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            if ($id_jadwal == "") {
                $jadwalVaksinModel->insert($data);
            } else {
                $jadwalVaksinModel->update($id_jadwal, $data);
            };
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
        return redirect()->to("admin_kab/data_jadwal_vaksin");
    }
    public function edit_jadwal($id_jadwal)
    {
        $dataJadwalVaksinModel = new JadwalVaksinModel;

        // $newformat = date('Y-m-d', $this->request->getJsonVar("tgl_pemberian"));
        $data = array(
            // "tgl_pemberian" => $this->request->getPost("tgl_pemberian"),
            "tgl_pemberian" => $this->request->getJsonVar("tgl_pemberian"),
        );
        $dataJadwalVaksinModel->update($id_jadwal, $data);
        return $this->response->setStatusCode(200);
    }
    public function delete_jadwal($id_jadwal)
    {
        $dataJadwalVaksinModel = new JadwalVaksinModel;
        $dataJadwalVaksinModel->delete($id_jadwal);
        return $this->response->setStatusCode(200);
    }
    public function data_jadwal_vaksin_detail($id_vaksinasi)
    {
        $dataJadwalVaksin = "";
        $id_kab = session()->get("user")["id"];
        $dataJadwalVaksinModel = new JadwalVaksinModel;
        $dataJadwalVaksin = $dataJadwalVaksinModel->join(
            "vaksinasi",
            "vaksinasi.id_vaksinasi = jadwal_vaksin.id_vaksin",
            "left"
        )->join(
            "pemilik_ternak",
            "pemilik_ternak.id_pemilik_ternak = vaksinasi.id_peternak",
            "left"
        )->where(
            "vaksinasi.id_vaksinasi",
            $id_vaksinasi
        )->where(
            "pemilik_ternak.id_kab",
            $id_kab
        )->whereIn(
            "id_vaksinasi",
            db_connect()->table(
                "jadwal_vaksin"
            )->select("id_vaksin")
        )->findAll();
        $data["data"] = $dataJadwalVaksin;
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function data_dokumentasi()
    {
        $data = array(
            "page" => "Admin/kabupaten/data_dokumentasi.php"
        );
        return view("container", $data);
    }
    public function add_peternak()
    {
        $validation = \Config\Services::validation();
        $peternakModel = new PeternakModel;
        $data = array(
            "id_kab" => $this->request->getVar("kabupaten"),
            "nama_pemilik" => $this->request->getPost("nama_pemilik"),
            "no_hp" => $this->request->getPost("no_hp"),
            "alamat" => $this->request->getPost("alamat")
        );
        $rules = [
            'nama_pemilik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama pemilik harus diisi.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'No. HP harus diisi.',
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                ],
            ],
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $peternakModel->insert($data);
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
        return redirect()->to("admin_kab/data_peternak");
    }
    public function delete_peternak($id_pemilik_ternak)
    {
        $peternakModel = new PeternakModel;
        $peternakModel->delete($id_pemilik_ternak);
        session()->setFlashdata(
            "message",
            '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   Success
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            '
        );
        return redirect()->to("admin_kab/data_peternak");
    }
    public function edit_peternak($id_pemilik_ternak)
    {
        $validation = \Config\Services::validation();
        $peternakModel = new PeternakModel;
        $data = array(
            "nama_pemilik" => $this->request->getPost("nama_pemilik"),
            "no_hp" => $this->request->getPost("no_hp"),
            "alamat" => $this->request->getPost("alamat")
        );
        $rules = [
            'nama_pemilik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama pemilik harus diisi.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'No. HP harus diisi.',
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                ],
            ],
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $peternakModel->update($id_pemilik_ternak, $data);
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
        return redirect()->to("admin_kab/data_peternak");
    }
}
