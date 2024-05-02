<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalVaksinModel extends Model
{
    protected $table = 'jadwal_vaksin';
    protected $primaryKey = "id_jadwal";
    protected $allowedFields = [
        'id_jadwal', 'id_jenis_vaksin', "hari_vaksin","tgl_vaksin"
    ];
}
