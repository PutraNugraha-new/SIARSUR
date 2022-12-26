<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\skModel;
use App\Models\smModel;

class Dashboard extends BaseController
{
    protected $SmModel;
    protected $skModel;

    public function __construct()
    {
        $this->SmModel = new smModel();
        $this->skModel = new skModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard | Home',
            'user' => 'Admin',
            'suratMasuk' => 'Surat Masuk',
            'suratKeluar' => 'Surat Keluar',
            'disposisi' => 'Disposisi',
            'jumlahSM' => $this->SmModel->jumlahSm(),
            'jumlahSK' => $this->skModel->jumlahSk()
        ];
        return view('admin/dashboard/index', $data);
    }
}
