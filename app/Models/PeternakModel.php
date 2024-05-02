<?php

namespace App\Models;

use CodeIgniter\Model;

class PeternakModel extends Model
{
    protected $table = 'pemilik_ternak';
    protected $primaryKey = "nik";
    protected $allowedFields = [
        'nik', 'id_kab', "nama_pemilik", "no_hp", "alamat"
    ];
}
