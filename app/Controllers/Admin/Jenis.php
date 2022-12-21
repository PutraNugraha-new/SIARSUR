<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\jenisModel;
use App\Models\smModel;

class Jenis extends BaseController
{
    protected $jenisModel;
    protected $SmModel;
    public function __construct()
    {
        $this->jenisModel = new jenisModel();
        $this->SmModel = new smModel();
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

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Jenis Surat',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'jenis' => $this->jenisModel->getJenis()
        ];
        return view('admin/jenissurat/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
        ])) {
            // $validation = \config\Services::validation();
            // return redirect()->to('sm/create')->withInput()->with('validation', $validation);
            return redirect()->to('jenis/create')->withInput();
        }
        $data = $this->request->getGetPost('jenis');
        $validasi = $this->jenisModel->jumlahJenis($data);

        if ($validasi > 0) {
            session()->setFlashdata('pesan', 'Jenis sudah ada');
            return redirect()->to('/jenis/create');
        }
        $this->jenisModel->save([
            'jenis' => $this->request->getVar('jenis')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/jenis');
    }

    public function delete($id)
    {
        // $data = $this->request->getGetPost('id_jenis');
        $validasi = $this->SmModel->cariJenis($id);
        if ($validasi > 0) {
            session()->setFlashdata('pesan_merah', 'Jenis sedang dipakai');
            return redirect()->to('/jenis');
        }

        $this->jenisModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/jenis');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Jenis Surat',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'jenis' => $this->jenisModel->getJenis($id)
        ];
        return view('admin/jenissurat/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/jenis/edit/' . $this->request->getVar('id_jenis'))->withInput();
        }

        $this->jenisModel->save([
            'id_jenis' => $id,
            'jenis' => $this->request->getVar('jenis')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/jenis');
    }
}
