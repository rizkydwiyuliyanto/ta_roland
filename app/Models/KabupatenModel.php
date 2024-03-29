<?php

namespace App\Models;

use CodeIgniter\Model;

class KabupatenModel extends Model
{
    protected $table = 'admin_kabupaten';
    protected $primaryKey = "id_kab";
    protected $allowedFields = [
        'id_kab', 'nama_kabupaten', "username", "password"
    ];
}
