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

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Sifat Surat',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'sifat' => $this->sifatModel->getSifat()
        ];
        return view('admin/sifatsurat/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
        ])) {
            // $validation = \config\Services::validation();
            // return redirect()->to('sm/create')->withInput()->with('validation', $validation);
            return redirect()->to('sifat/create')->withInput();
        }
        $data = $this->request->getGetPost('sifat');
        $validasi = $this->sifatModel->jumlahSifat($data);

        if ($validasi > 0) {
            session()->setFlashdata('pesan', 'sifat sudah ada');
            return redirect()->to('/sifat/create');
        }
        $this->sifatModel->save([
            'sifat' => $this->request->getVar('sifat')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/sifat');
    }

    public function delete($id)
    {
        // $data = $this->request->getGetPost('id_jenis');
        $validasi = $this->SmModel->cariSifat($id);
        if ($validasi > 0) {
            session()->setFlashdata('pesan_merah', 'Jenis sedang dipakai');
            return redirect()->to('/sifat');
        }

        $this->sifatModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/sifat');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Jenis Surat',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'sifat' => $this->sifatModel->getSifat($id)
        ];
        return view('admin/sifatsurat/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/sifat/edit/' . $this->request->getVar('id_sifat'))->withInput();
        }

        $this->sifatModel->save([
            'id_sifat' => $id,
            'sifat' => $this->request->getVar('sifat')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/sifat');
    }
}
