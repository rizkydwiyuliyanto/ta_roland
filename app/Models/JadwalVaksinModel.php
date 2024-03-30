<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalVaksinModel extends Model
{
    protected $table = 'jadwal_vaksin';
    protected $primaryKey = "id_jadwal";
    protected $allowedFields = [
        'id_jadwal', 'id_vaksin', "tgl_pemberian", "rizky_bgst"
    ];
}
