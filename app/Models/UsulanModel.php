<?php

namespace App\Models;

use CodeIgniter\Model;

class UsulanModel extends Model
{
    protected $table = 'usulan';
    protected $primaryKey = "id";
    protected $allowedFields = [
        'id', 'nama', "alamat", "no_hp","jumlah_ternak"
    ];
}
