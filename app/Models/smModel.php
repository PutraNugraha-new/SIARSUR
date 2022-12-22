<?php

namespace App\Models;

use CodeIgniter\Model;

class smModel extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_masuk';
    protected $useTimestamps = true;
    protected $allowedFields = ['no_surat', 'tgl_surat', 'id_jenis', 'id_sifat', 'surat_dari', 'surat_untuk', 'tgl_terima', 'perihal', 'dokumen', 'slug'];

    public function getSm($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_masuk' => $id])->first();
    }

    public function getAll()
    {
        $builder = $this->db->table("surat_masuk");
        // $builder->select('*');
        $builder->join('sifat_surat', 'sifat_surat.id_sifat = surat_masuk.id_sifat');
        $builder->join('jenis_surat', 'jenis_surat.id_jenis = surat_masuk.id_jenis');
        $sifat = $builder->get()->getResult();
        return $sifat;
    }

    public function jumlahSm()
    {
        return $this->countAllResults();
    }

    public function cariJenis($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_jenis' => $id])->countAllResults();
    }
    public function cariSifat($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id_sifat' => $id])->countAllResults();
    }

    public function getBulan($tgl_awal = false, $tgl_akhir = false, $sifatSurat = false)
    {
        if (($tgl_awal == false) || ($tgl_akhir == false) || ($sifatSurat == false)) {
            $builder = $this->db->table("surat_masuk");
            // $builder->select('*');
            $builder->join('sifat_surat', 'sifat_surat.id_sifat = surat_masuk.id_sifat');
            $builder->join('jenis_surat', 'jenis_surat.id_jenis = surat_masuk.id_jenis');
            $sifat = $builder->get()->getResult();
            return $sifat;
        }
        $builder = $this->db->table("surat_masuk");
        // $builder->select('*');
        $builder->join('sifat_surat', 'sifat_surat.id_sifat = surat_masuk.id_sifat');
        $builder->join('jenis_surat', 'jenis_surat.id_jenis = surat_masuk.id_jenis');
        $builder->where('tgl_surat >=', $tgl_awal);
        $builder->where('tgl_surat <=', $tgl_akhir);
        $builder->where(['sifat' => $sifatSurat]);
        // $builder->where("DATE_FORMAT(tgl_surat, '%Y-%m')", $tgl_awal);
        // $builder->where("DATE_FORMAT(tgl_surat, '%Y-%m')", $tgl_akhir);
        $sifat = $builder->get()->getResult();
        return $sifat;
    }
}
