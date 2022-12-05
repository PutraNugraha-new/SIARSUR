<?php

namespace App\Controllers\Admin;

use App\Models\smModel;
use App\Models\sifatModel;
use App\Controllers\BaseController;
use App\Models\jenisModel;

class Sm extends BaseController
{
    protected $SmModel;
    protected $SifatModel;
    protected $jenisModel;
    public function __construct()
    {
        $this->SmModel = new smModel();
        $this->SifatModel = new sifatModel();
        $this->jenisModel = new jenisModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Surat Masuk',
            'user' => 'Admin',
            'surat' => $this->SmModel->getAll()
        ];
        // dd($data);

        return view('admin/suratmasuk/index', $data);
    }

    // public function detail($id)
    // {
    //     $data = [
    //         'title' => 'Detail Surat',
    //         'surat' => $this->SmModel->getSm($id)
    //     ];

    //     if (empty($data['surat'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat ' . $id . ' tidak ditemukan.');
    //     }

    //     return view('surat/detail', $data);
    // }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Surat Masuk',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'surat' => $this->SmModel->getAll(),
            'sifat' => $this->SifatModel->getSifat(),
            'jenis' => $this->jenisModel->getJenis()
        ];
        return view('admin/suratmasuk/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tgl_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Surat harus diisi'
                ]
            ],
            'tgl_diterima' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Surat harus diisi'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'kode_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Instansi harus diisi'
                ]
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,1024]|ext_in[file,pdf]',
                'errors' => [
                    'uploaded' => 'Pilih file surat terlebih dahulu',
                    'max_size' => 'Ukuran file melebihi 1Mb',
                    'ext_in' => 'file harus berupa PDF'
                ]
            ],
        ])) {
            // $validation = \config\Services::validation();
            // return redirect()->to('sm/create')->withInput()->with('validation', $validation);
            return redirect()->to('sm/create')->withInput();
        }

        $fileSurat = $this->request->getFile('file');
        $fileSurat->move('fileSurat');
        $namaFile = $fileSurat->getName();

        $slug = url_title($this->request->getVar('perihal'), '-', true);
        $this->SmModel->save([
            // 'no_surat' => $this->request->getVar('no_surat'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'tgl_diterima' => $this->request->getVar('tgl_diterima'),
            'perihal' => $this->request->getVar('perihal'),
            'sifat' => $this->request->getVar('sifat'),
            'kode_instansi' => $this->request->getVar('kode_instansi'),
            'file' => $namaFile,
            'slug' => $slug
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/sm');
    }
}
