<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\smModel;

class Dashboard extends BaseController
{
    protected $SmModel;

    public function __construct()
    {
        $this->SmModel = new smModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard | Home',
            'user' => 'Admin',
            'suratMasuk' => 'Surat Masuk',
            'suratKeluar' => 'Surat Keluar',
            'disposisi' => 'Disposisi',
            'jumlahSM' => $this->SmModel->jumlahSm()
        ];
        return view('admin/dashboard/index', $data);
    }
}
