<?php

namespace App\Models;

use CodeIgniter\Model;

class PeternakModel extends Model
{
    protected $table = 'pemilik_ternak';
    protected $primaryKey = "id_pemilik_ternak";
    protected $allowedFields = [
        'id_pemilik_ternak', 'id_kab', "nama_pemilik", "no_hp", "alamat"
    ];
}
