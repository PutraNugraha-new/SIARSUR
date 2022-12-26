<?php

namespace App\Controllers\Admin;

use App\Models\skModel;
use App\Models\sifatModel;
use App\Controllers\BaseController;
use App\Models\jenisModel;
use \Dompdf\Dompdf;

class Sk extends BaseController
{
    protected $skModel;
    protected $sifatModel;
    protected $jenisModel;
    public function __construct()
    {
        $this->skModel = new skModel();
        $this->sifatModel = new sifatModel();
        $this->jenisModel = new jenisModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Surat Keluar',
            'user' => 'Admin',
            'surat' => $this->skModel->getAll()
        ];
        return view('admin/suratkeluar/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Surat Keluar',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'sifat' => $this->sifatModel->getSifat(),
            'jenis' => $this->jenisModel->getJenis(),
            'surat' => $this->skModel->getSk()
        ];
        return view('admin/suratkeluar/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'no_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'no_agenda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'tgl_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Surat harus diisi'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Surat harus diisi'
                ]
            ],
            'id_sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sifat Surat harus diisi'
                ]
            ],
            'surat_untuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan Surat harus diisi'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|max_size[dokumen,1024]|ext_in[dokumen,pdf]',
                'errors' => [
                    'uploaded' => 'Pilih file surat terlebih dahulu',
                    'max_size' => 'Ukuran file melebihi 1Mb',
                    'ext_in' => 'dokumen harus berupa PDF'
                ]
            ],
        ])) {
            // $validation = \config\Services::validation();
            // return redirect()->to('sm/create')->withInput()->with('validation', $validation);
            return redirect()->to('sk/create')->withInput();
        }
        $fileSurat = $this->request->getFile('dokumen');
        $fileSurat->move('fileSuratkeluar');
        $namaFile = $fileSurat->getName();

        $this->skModel->save([
            'no_surat' => $this->request->getVar('no_surat'),
            'no_agenda' => $this->request->getVar('no_agenda'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'id_sifat' => $this->request->getVar('id_sifat'),
            'surat_untuk' => $this->request->getVar('surat_untuk'),
            'perihal' => $this->request->getVar('perihal'),
            'dokumen' => $namaFile
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/sk');
    }

    public function delete($id)
    {
        $surat = $this->skModel->find($id);
        unlink('fileSuratkeluar/' . $surat['dokumen']);

        $this->skModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('sk');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Surat Keluar',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'surat' => $this->skModel->getSk($id),
            'sifat' => $this->sifatModel->getSifat(),
            'jenis' => $this->jenisModel->getJenis()
        ];
        return view('admin/suratkeluar/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'no_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'no_agenda' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'tgl_surat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Surat harus diisi'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Surat harus diisi'
                ]
            ],
            'id_sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sifat Surat harus diisi'
                ]
            ],
            'surat_untuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan Surat harus diisi'
                ]
            ],
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
                ]
            ],
            'dokumen' => [
                'rules' => 'max_size[dokumen,1024]|ext_in[dokumen,pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file melebihi 1Mb',
                    'ext_in' => 'dokumen harus berupa PDF'
                ]
            ],
        ])) {
            return redirect()->to('/sk/edit/' . $this->request->getVar('id_keluar'))->withInput();
        }
        $fileSurat = $this->request->getFile('dokumen');

        if ($fileSurat->getError() == 4) {
            $namaFile = $this->request->getVar('fileLama');
        } else {
            $namaFile = $fileSurat->getName();
            $fileSurat->move('fileSuratkeluar', $namaFile);
            unlink('fileSuratkeluar/' . $this->request->getVar('fileLama'));
        }

        $this->skModel->save([
            'id_keluar' => $id,
            'no_surat' => $this->request->getVar('no_surat'),
            'no_agenda' => $this->request->getVar('no_agenda'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'id_sifat' => $this->request->getVar('id_sifat'),
            'surat_untuk' => $this->request->getVar('surat_untuk'),
            'perihal' => $this->request->getVar('perihal'),
            'dokumen' => $namaFile
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/sk');
    }
}
