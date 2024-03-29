<?php

namespace App\Controllers;

use App\Models\KabupatenModel;
use App\Models\UserModel;

class Auth extends BaseController
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
    public function login()
    {
        $data = array(
            "page" => "login.php"
        );
        return view("container", $data);
    }
    public function save_auth()
    {
        $userModel = new UserModel;
        $kabupatenModel = new KabupatenModel;
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $role = $this->request->getPost("role");
        if ($role == "admin_prov") {
            $adminData = $userModel->where("username", $username)->where("password", $password)->first();
            if (!is_null($adminData)) {
                session()->setFlashdata(
                    "message",
                    '<div class="alert alert-success" role="alert">
                        Login success :)
                    </div>
                '
                );
                session()->set(
                    "user",
                    array(
                        "id" => $adminData["id_user"],
                        "username" => $adminData["username"],
                        "password" => $adminData["password"]
                    )
                );
                return redirect()->to("admin_prov/dashboard");
            }
            session()->setFlashdata(
                "message",
                '<div class="alert alert-danger" role="alert">
                    Login gagal :)
                </div>
            '
            );
            return redirect()->to("login");
        } else if ($role == "admin_kab") {
            $adminData = $kabupatenModel->where("username", $username)->where("password", $password)->first();
            if (!is_null($adminData)) {
                session()->setFlashdata(
                    "message",
                    '<div class="alert alert-success" role="alert">
                        Login success :)
                    </div>
                '
                );
                session()->set(
                    "user",
                    array(
                        "id" => $adminData["id_kab"],
                        "nama_kabupaten" => $adminData["nama_kabupaten"],
                        "username" => $adminData["username"],
                        "password" => $adminData["password"]
                    )
                );
                return redirect()->to("admin_kab/dashboard");
            }
            session()->setFlashdata(
                "message",
                '<div class="alert alert-danger" role="alert">
                    Login gagal :)
                </div>
            '
            );
            return redirect()->to("login");
        }
    }
}
