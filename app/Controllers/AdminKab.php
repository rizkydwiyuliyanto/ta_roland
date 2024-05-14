<?php

namespace App\Controllers;

use App\Models\DokumentasiModel;
use App\Models\JadwalVaksinModel;
use App\Models\KabupatenModel;
use App\Models\PesertaModel;
use App\Models\PeternakModel;
use App\Models\UsulanModel;
use App\Models\JenisVaksinModel;
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
        $usulanModel = new UsulanModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "page" => "Admin/kabupaten/data_peternak.php",
            "data_peternak" => $peternakModel->select(
                "
                    pemilik_ternak.nik,
                    pemilik_ternak.id_usulan,
                    pemilik_ternak.id_kab,
                    pemilik_ternak.nama_pemilik,
                    pemilik_ternak.alamat AS alamat_pemilik,
                    pemilik_ternak.no_hp AS no_hp_pemilik,
                    pemilik_ternak.jumlah_ternak AS jumlah_ternak_pemilik,
                    admin_kabupaten.nama_kabupaten,
                    usulan.nama AS usulan_vaksin,
                    usulan.alamat AS alamat_usulan,
                    usulan.no_hp AS no_hp_usulan,
                    usulan.jumlah_ternak AS jumlah_ternak_usulan
                "
            )->join(
                "admin_kabupaten",
                "admin_kabupaten.id_kab=pemilik_ternak.id_kab",
                "left"
            )->join(
                "usulan",
                "usulan.id=pemilik_ternak.id_usulan",
                "left"
            )
                ->where("pemilik_ternak.id_kab", $id_kab)->findAll(80)
        );
        return view("container", $data);
    }
    public function select_usulan()
    {
        $usulanModel = new UsulanModel;
        $data = array(
            "usulan" => $usulanModel->whereNotIn(
                "usulan.id",
                db_connect()->table(
                    "pemilik_ternak"
                )->select(
                    "pemilik_ternak.id_usulan"
                )
            )->findAll()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function jadwal_vaksin()
    {
        $jenisVaksinModel = new JenisVaksinModel;
        $jadwalVaksinModel = new JadwalVaksinModel;
        $data = array(
            "page" => "admin/kabupaten/jadwal_vaksin.php",
            "jadwal_vaksin" => $jadwalVaksinModel->join(
                "jenis_vaksin",
                "jadwal_vaksin.id_jenis_vaksin=jenis_vaksin.id",
                "left"
            )->findAll(),
            "jenis_vaksin" => $jenisVaksinModel->findAll()
        );
        return view("container", $data);
    }
    public function detail_jadwal_vaksin($idJadwalVaksin)
    {
        $jadwalVaksinModel = new JadwalVaksinModel;
        $jenisVaksinModel = new JenisVaksinModel;
        $data = array(
            "detail_jadwal_vaksin" => $jadwalVaksinModel->where("id_jadwal", $idJadwalVaksin)->first(),
            "data_jenis_vaksin" => $jenisVaksinModel->findAll()
        );
        return $this->response->setStatusCode(200)->setJSON(array("data" => $data));
    }
    public function add_jadwal_vaksin()
    {
        $validation = \Config\Services::validation();
        $jadwalVaksinModel = new JadwalVaksinModel;
        $data = array(
            "id_jenis_vaksin" => $this->request->getPost("jenis"),
            "hari_vaksin" => $this->request->getPost("hari"),
            "tgl_vaksin" => $this->request->getPost("tgl_vaksin")
        );
        $rules = [
            'id_jenis_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID Jenis Vaksin harus diisi.',
                ],
            ],
            'hari_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hari harus diisi.',
                ],
            ],
            'tgl_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal vaksin harus diisi.',
                ],
            ]
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $jadwalVaksinModel->insert($data);
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
        return redirect()->to("admin_kab/jadwal_vaksin");
    }
    public function edit_jadwal_vaksin($idJadwalVaksin)
    {
        $validation = \Config\Services::validation();
        $jadwalVaksinModel = new JadwalVaksinModel;
        $data = array(
            "id_jenis_vaksin" => $this->request->getPost("jenis"),
            "hari_vaksin" => $this->request->getPost("hari"),
            "tgl_vaksin" => $this->request->getPost("tgl_vaksin")
        );
        $rules = [
            'id_jenis_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'ID Jenis Vaksin harus diisi.',
                ],
            ],
            'hari_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hari harus diisi.',
                ],
            ],
            'tgl_vaksin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal vaksin harus diisi.',
                ],
            ]
        ];
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $jadwalVaksinModel->update($idJadwalVaksin, $data);
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
        return redirect()->to("admin_kab/jadwal_vaksin");
    }
    public function delete_jadwal_vaksin($id_jadwal_vaksin)
    {
        $jadwalVaksinModel = new JadwalVaksinModel;
        $jadwalVaksinModel->delete($id_jadwal_vaksin);
        session()->setFlashdata(
            "message",
            '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               Success
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        '
        );
        return redirect()->to("admin_kab/jadwal_vaksin");
    }
    public function data_vaksin()
    {
        $peternakModel = new PeternakModel;
        $jenisVaksinModel = new JenisVaksinModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "page" => "Admin/kabupaten/data_vaksin.php",
            "data_vaksin" => $jenisVaksinModel->join("pemilik_ternak", "pemilik_ternak.nik=vaksinasi.id_peternak", "left")->where("pemilik_ternak.id_kab", $id_kab)->findAll(80),
            "data_peternak" => $peternakModel->where("pemilik_ternak.id_kab", $id_kab)->findAll()
        );
        return view("container", $data);
    }
    public function add_vaksin()
    {
        $validation = \Config\Services::validation();
        $jenisVaksinModel = new JenisVaksinModel;
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
            $jenisVaksinModel->insert($data);
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
        $jenisVaksinModel = new JenisVaksinModel;
        $jenisVaksinModel->delete($id_vaksin);
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
        $jenisVaksinModel = new JenisVaksinModel;
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
            $jenisVaksinModel->update($id_vaksin, $data);
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
            "pemilik_ternak.nik = vaksinasi.id_peternak",
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
        $pesertaModel = new PesertaModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "data_peserta" => $pesertaModel->select(
                "
                    peserta_vaksin.id AS id_peserta,
                    peserta_vaksin.nik,
                    peserta_vaksin.id_jadwal,
                    pemilik_ternak.alamat,
                    pemilik_ternak.no_hp,
                    pemilik_ternak.nama_pemilik,
                    pemilik_ternak.jumlah_ternak,
                    jadwal_vaksin.id_jenis_vaksin,
                    jadwal_vaksin.hari_vaksin,
                    jadwal_vaksin.tgl_vaksin,
                    jenis_vaksin.jenis_vaksin
                "
            )->join(
                "pemilik_ternak",
                "pemilik_ternak.nik=peserta_vaksin.nik",
                "left"
            )->join(
                "jadwal_vaksin",
                "jadwal_vaksin.id_jadwal=peserta_vaksin.id_jadwal",
                "left"
            )->join(
                "jenis_vaksin",
                "jenis_vaksin.id=jadwal_vaksin.id_jenis_vaksin",
                "left"
            )->where(
                "pemilik_ternak.id_kab",
                $id_kab
            )->findAll(),
            "page" => "Admin/kabupaten/data_dokumentasi.php"
        );
        return view("container", $data);
    }
    public function data_dokumentasi_detail($idPeserta)
    {
        $dokumentasiModel = new DokumentasiModel;
        $data["data"] = $dokumentasiModel->where("id_peserta", $idPeserta)->findAll();
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function add_dokumentasi2($idPeserta)
    {
        $dokumentasiModel = new DokumentasiModel;
        $validationRule = [
            'foto' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            // $arr = array();
            // foreach ($errors as $e) :
            //     array_push($arr, $this->notValidMessage($e));
            // endforeach;
            // $str = implode("", $arr);
            // session()->setFlashdata(
            //     "message",
            //     $str
            // );
            $error = ['errors' => $this->validator->getErrors()];
            $status = "";
            session()->setFlashdata(
                "message",
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span style="margin-right: 6px;">Failed</span> :(
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            $status = array(
                "success" => false
            );
            return redirect()->to("admin_kab/data_dokumentasi");
        } else {
            $img = $this->request->getFile("foto");
            if (!$img->hasMoved()) {
                $imgName = $img->getName();
                $img->move("../public/uploads/" . $idPeserta . "/dokumentasi/images/", $imgName);
                $filepath = base_url() . "uploads/" . $idPeserta . "/dokumentasi/images/" . $imgName;
                $data = array(
                    "id_peserta" => $idPeserta,
                    "foto" => $filepath,
                    "hari" => $this->request->getPost("hari"),
                    "tanggal" => $this->request->getPost("tanggal"),
                    "alamat" => $this->request->getPost("alamat"),
                    "keterangan" => $this->request->getPost("keterangan"),
                );
                $dokumentasiModel->insert($data);
                session()->setFlashdata(
                    "message",
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span style="margin-right: 6px;">Success</span> :)
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );
                $status = array(
                    "success" => true
                );
            }
        }
        return $this->response->setJSON($status);
    }
    public function dokumentasi_items($idPeserta)
    {
        $dokumentasiModel = new DokumentasiModel;
        $data = $dokumentasiModel->where("id_peserta", $idPeserta)->findAll();
        return $this->response->setStatusCode(200)->setJSON(array("data" => $data));
    }
    public function edit_dokumentasi($id_dokumentasi)
    {
        $dokumentasiModel = new DokumentasiModel;
        $validationRule = [
            'foto' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                ],
            ],
        ];
        $data = "";
        if (!$this->validate($validationRule)) {
            $data = array(
                "hari" => $this->request->getPost("hari"),
                "tanggal" => $this->request->getPost("tanggal"),
                "alamat" => $this->request->getPost("alamat"),
                "keterangan" => $this->request->getPost("keterangan"),
            );
            $dokumentasiModel->update($id_dokumentasi, $data);
            $status = array(
                "success" => true
            );
        } else {
            $img = $this->request->getFile("foto");
            if (!$img->hasMoved()) {
                $result = $dokumentasiModel->where("id_dokumentasi", $id_dokumentasi)->first();
                $imgName = $img->getName();
                $img->move("../public/uploads/" . $result["id_peserta"] . "/dokumentasi/images/", $imgName);
                $filepath = base_url() . "uploads/" . $result["id_peserta"] . "/dokumentasi/images/" . $imgName;
                $data = array(
                    "foto" => $filepath,
                    "hari" => $this->request->getPost("hari"),
                    "tanggal" => $this->request->getPost("tanggal"),
                    "alamat" => $this->request->getPost("alamat"),
                    "keterangan" => $this->request->getPost("keterangan"),
                );
                $dokumentasiModel->update($id_dokumentasi, $data);
                $status = array(
                    "success" => true
                );
            }
        };
        return $this->response->setJSON($status);
    }
    public function detail_dokumentasi($idDokumentasi)
    {
        $dokumentasiModel = new DokumentasiModel;
        $data = array(
            "detail" => $dokumentasiModel->where("id_dokumentasi", $idDokumentasi)->first()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function delete_dokumentasi($id_dokumentasi)
    {
        $dokumentasiModel = new DokumentasiModel;
        $dokumentasiModel->delete($id_dokumentasi);
        $status = array(
            "success" => true
        );
        return $this->response->setJSON($status);
    }
    public function add_peternak()
    {
        $validation = \Config\Services::validation();
        $peternakModel = new PeternakModel;
        $data = array(
            "nik" => $this->request->getPost("nik"),
            "id_kab" => $this->request->getVar("kabupaten"),
            "nama_pemilik" => $this->request->getPost("nama_pemilik"),
            "id_usulan" => $this->request->getPost("usulan"),
            "no_hp" => $this->request->getPost("no_hp"),
            "alamat" => $this->request->getPost("alamat")
        );
        $rules = [
            'nik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'NIK harus diisi.',
                ],
            ],
            'nama_pemilik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama pemilik harus diisi.',
                ],
            ],
            'id_usulan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Usulan harus diisi.',
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
    public function detail_peternak($nik)
    {
        $peternakModel = new PeternakModel;
        $usulanModel = new UsulanModel;
        $data = array(
            "detail_peternak" => $peternakModel->select(
                "
                    pemilik_ternak.nik,
                    pemilik_ternak.id_usulan,
                    pemilik_ternak.id_kab,
                    pemilik_ternak.nama_pemilik,
                    pemilik_ternak.no_hp,
                    pemilik_ternak.alamat,
                    usulan.nama
                "
            )->join(
                "usulan",
                "usulan.id=pemilik_ternak.id_usulan",
                "left"
            )->where("nik", $nik)->first(),
            "select_usulan" => $usulanModel->whereNotIn(
                "usulan.id",
                db_connect()->table(
                    "pemilik_ternak"
                )->select(
                    "pemilik_ternak.id_usulan"
                )
            )->findAll()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function edit_data_peternak($nik)
    {
        $validation = \Config\Services::validation();
        $peternakModel = new PeternakModel;
        $data = array(
            "nik" => $this->request->getPost("nik"),
            "nama_pemilik" => $this->request->getPost("nama_pemilik"),
            "id_usulan" => $this->request->getPost("usulan"),
            "no_hp" => $this->request->getPost("no_hp"),
            "alamat" => $this->request->getPost("alamat")
        );
        $rules = [
            'nik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'NIK harus diisi.',
                ],
            ],
            'nama_pemilik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama pemilik harus diisi.',
                ],
            ],
            'id_usulan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Usulan harus diisi.',
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
            $peternakModel->update($nik, $data);
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
    public function delete_peternak($nik)
    {
        $peternakModel = new PeternakModel;
        $peternakModel->delete($nik);
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

    public function tambah_usulan()
    {
        $usulanModel = new UsulanModel;
        $usulanModel->insert(
            array(
                "nama" => $this->request->getPost("nama"),
                "alamat" => $this->request->getPost("alamat"),
                "no_hp" => $this->request->getPost("no_hp"),
                "jumlah_ternak" => $this->request->getPost("jumlah_ternak"),
            )
        );
        return redirect()->to("admin_kab/data_peternak");
    }

    public function add_jenis_vaksin()
    {
        $jenisVaksinModel = new JenisVaksinModel;
        $jenisVaksinModel->insert(
            array(
                "jenis_vaksin" => $this->request->getPost("jenis")
            )
        );
        return redirect()->to("admin_kab/data_jenis_vaksin");
    }
    public function data_peserta()
    {
        $pesertaModel = new PesertaModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "data_peserta" => $pesertaModel->select(
                "
                    peserta_vaksin.id AS id_peserta,
                    peserta_vaksin.nik,
                    peserta_vaksin.id_jadwal,
                    pemilik_ternak.alamat,
                    pemilik_ternak.no_hp,
                    pemilik_ternak.nama_pemilik,
                    pemilik_ternak.jumlah_ternak,
                    jadwal_vaksin.id_jenis_vaksin,
                    jadwal_vaksin.hari_vaksin,
                    jadwal_vaksin.tgl_vaksin,
                    jenis_vaksin.jenis_vaksin
                "
            )->join(
                "pemilik_ternak",
                "pemilik_ternak.nik=peserta_vaksin.nik",
                "left"
            )->join(
                "jadwal_vaksin",
                "jadwal_vaksin.id_jadwal=peserta_vaksin.id_jadwal",
                "left"
            )->join(
                "jenis_vaksin",
                "jenis_vaksin.id=jadwal_vaksin.id_jenis_vaksin",
                "left"
            )->where(
                "pemilik_ternak.id_kab",
                $id_kab
            )->findAll(),
            "page" => "Admin/kabupaten/data_peserta.php"
        );
        return view("container", $data);
    }
    public function delete_peserta($idPeserta)
    {
        $pesertaModel = new PesertaModel;
        $pesertaModel->delete($idPeserta);
        session()->setFlashdata(
            "message",
            '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               Success
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        '
        );
        return redirect()->to("admin_kab/data_peserta");
    }
    public function detail_peserta($idPeserta)
    {
        $pesertaModel = new PesertaModel;
        $data = array(
            "data_peserta" => $pesertaModel->join(
                "pemilik_ternak",
                "pemilik_ternak.nik=peserta_vaksin.nik",
                "left"
            )->join(
                "jadwal_vaksin",
                "jadwal_vaksin.id_jadwal=peserta_vaksin.id_jadwal",
                "left"
            )->join(
                "jenis_vaksin",
                "jenis_vaksin.id=jadwal_vaksin.id_jenis_vaksin",
                "left"
            )->where(
                "peserta_vaksin.id",
                $idPeserta
            )->first()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function daftar_peserta()
    {
        $jadwalVaksinModel = new JenisVaksinModel;
        $data = array(
            "data_jadwal_vaksin" => $jadwalVaksinModel->findAll(),
            "page" => "Admin/kabupaten/daftar_peserta.php"
        );
        return view("container", $data);
    }
    public function detail_daftar_peserta($idVaksin)
    {
        $jadwalVaksinModel = new JadwalVaksinModel;
        $peternakModel = new PeternakModel;
        $id_kab = session()->get("user")["id"];
        $data = array(
            "jadwal_vaksin" => $jadwalVaksinModel->where("id_jenis_vaksin", $idVaksin)->findAll(),
            "data_peternak" => $peternakModel->where("id_kab", $id_kab)->findAll()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function add_peserta()
    {
        $pesertaModel = new PesertaModel;
        $validation = \Config\Services::validation();
        $rules = [
            'nik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Peserta harus diisi.',
                ],
            ],
            'id_jadwal' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jadwal harus diisi.',
                ],
            ]
        ];
        $data = array(
            "nik" => $this->request->getPost("peternak"),
            "id_jadwal" => $this->request->getPost("jadwal")
        );
        $validation->setRules($rules);
        if ($validation->run($data)) {
            $pesertaModel->insert($data);
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
        return redirect()->to("admin_kab/daftar_peserta");
    }
    public function detail_peserta_edit()
    {
        $pesertaModel = new PesertaModel;
        $jadwalVaksinModel = new JadwalVaksinModel;
        $peternakModel = new PeternakModel;
        $jenisVaksinModel = new JenisVaksinModel;
        $id_kab = session()->get("user")["id"];
        $idVaksin = $this->request->getVar("id_vaksin");
        $idPeserta = $this->request->getVar("id_peserta");
        $data = array(
            "jadwal_vaksin" => $jadwalVaksinModel->findAll(),
            "data_peternak" => $peternakModel->where("id_kab", $id_kab)->findAll(),
            "data_peserta" => $pesertaModel->where("id", $idPeserta)->first(),
            "jenis_vaksin" => $jenisVaksinModel->findAll()
        );
        return $this->response->setStatusCode(200)->setJSON($data);
    }
    public function edit_peserta($idPeserta)
    {
        $pesertaModel = new PesertaModel;
        $data = array(
            "nik" => $this->request->getPost("peternak"),
            "id_jadwal" => $this->request->getPost("jadwal")
        );
        $pesertaModel->update($idPeserta, $data);
        $status = array(
            "success" => true
        );
        return $this->response->setJSON($status);
    }
}
