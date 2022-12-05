<?php

namespace App\Models;

use CodeIgniter\Model;

class jenisModel extends Model
{
    protected $table = 'jenis_surat';
    protected $primaryKey = 'id_jenis';
    protected $useTimestamps = true;
    protected $allowedFields = ['jenis'];

    public function getJenis($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_jenis' => $id])->first();
    }
}
