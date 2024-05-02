<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'peserta_vaksin';
    protected $primaryKey = "id";
    protected $allowedFields = [
        'id', 'nik', "id_jadwal"
    ];
}
