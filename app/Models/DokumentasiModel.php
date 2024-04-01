<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumentasiModel extends Model
{
    protected $table = 'dokumentasi';
    protected $primaryKey = "id_dokumentasi";
    protected $allowedFields = [
        'id_dokumentasi', 'id_jadwal', "foto", "text"
    ];
}
