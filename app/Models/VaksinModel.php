<?php

namespace App\Models;

use CodeIgniter\Model;

class VaksinModel extends Model
{
    protected $table = 'vaksinasi';
    protected $primaryKey = "id_vaksinasi";
    protected $allowedFields = [
        'id_vaksinasi', 'id_peternak', "jumlah_dosis", "jenis"
    ];
}
