<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | Home',
            'user' => 'Admin',
            'suratMasuk' => 'Surat Masuk',
            'suratKeluar' => 'Surat Keluar',
            'disposisi' => 'Disposisi'
        ];
        return view('admin/dashboard/index', $data);
    }
}
