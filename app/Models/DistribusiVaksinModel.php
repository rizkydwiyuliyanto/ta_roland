<?php

namespace App\Models;

use CodeIgniter\Model;

class DistribusiVaksinModel extends Model
{
    protected $table = 'distribusi_vaksin';
    protected $primaryKey = "id";
    protected $allowedFields = [
        'id', 'id_kabupaten', "id_jenis_vaksin", "tahun_vaksin", "jumlah_dosis"
    ];
}
