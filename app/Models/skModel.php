<?php

namespace App\Models;

use CodeIgniter\Model;

class skModel extends Model
{
    protected $table = 'surat_keluar';
    protected $primaryKey = 'id_keluar';
    protected $useTimestamps = true;
    protected $allowedFields = ['no_surat', 'no_agenda', 'tgl_surat', 'id_jenis', 'id_sifat', 'surat_untuk', 'perihal', 'dokumen'];

    public function getSk($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_keluar' => $id])->first();
    }

    public function getAll()
    {
        $builder = $this->db->table("surat_keluar");
        // $builder->select('*');
        $builder->join('sifat_surat', 'sifat_surat.id_sifat = surat_keluar.id_sifat');
        $builder->join('jenis_surat', 'jenis_surat.id_jenis = surat_keluar.id_jenis');
        $sifat = $builder->get()->getResult();
        return $sifat;
    }

    public function jumlahSk()
    {
        return $this->countAllResults();
    }
}
