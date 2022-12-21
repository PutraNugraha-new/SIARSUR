<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\sifatModel;
use App\Models\smModel;

class Sifat extends BaseController
{
    protected $sifatModel;
    protected $SmModel;
    public function __construct()
    {
        $this->sifatModel = new sifatModel();
        $this->SmModel = new smModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sifat Surat',
            'user' => 'Admin',
            'sifat' => $this->sifatModel->getSifat()
        ];
        // dd($data);

        return view('admin/sifatsurat/index', $data);
    }
}
