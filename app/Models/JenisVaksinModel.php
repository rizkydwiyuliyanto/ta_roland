<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisVaksinModel extends Model
{
    protected $table = 'jenis_vaksin';
    protected $primaryKey = "id";
    protected $allowedFields = [
        'id', 'jenis_vaksin'
    ];
}
