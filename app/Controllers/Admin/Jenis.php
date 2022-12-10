<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\jenisModel;

class Jenis extends BaseController
{
    protected $jenisModel;
    public function __construct()
    {
        $this->jenisModel = new jenisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Surat',
            'user' => 'Admin',
            'jenis' => $this->jenisModel->getJenis()
        ];
        // dd($data);

        return view('admin/jenissurat/index', $data);
    }
}
