<?php

namespace App\Controllers\Admin;

use App\Models\smModel;
use App\Models\sifatModel;
use App\Controllers\BaseController;
use App\Models\jenisModel;
use \Dompdf\Dompdf;

class Sm extends BaseController
{
    protected $SmModel;
    protected $sifatModel;
    protected $jenisModel;
    public function __construct()
    {
        $this->SmModel = new smModel();
        $this->sifatModel = new sifatModel();
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

    public function printPdf()
    {
        $dompdf = new Dompdf();
        $data = [
            'title' => 'Surat Masuk',
            'user' => 'Admin',
            'surat' => $this->SmModel->getAll()
        ];
        // return view('admin/suratmasuk/cetak', $data);
        $html =  view('admin/suratmasuk/cetak', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('surat masuk.pdf', array(
            "Attachment" => false
        ));
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
            'surat' => $this->SmModel->getSm(),
            'sifat' => $this->sifatModel->getSifat(),
            'jenis' => $this->jenisModel->getJenis()
        ];
        return view('admin/suratmasuk/create', $data);
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
            'surat_dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Asal Surat harus diisi'
                ]
            ],
            'surat_untuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan Surat harus diisi'
                ]
            ],
            'tgl_terima' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
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
            return redirect()->to('sm/create')->withInput();
        }

        $fileSurat = $this->request->getFile('dokumen');
        $fileSurat->move('fileSurat');
        $namaFile = $fileSurat->getName();

        $slug = url_title($this->request->getVar('perihal'), '-', true);
        $this->SmModel->save([
            'no_surat' => $this->request->getVar('no_surat'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'id_sifat' => $this->request->getVar('id_sifat'),
            'surat_dari' => $this->request->getVar('surat_dari'),
            'surat_untuk' => $this->request->getVar('surat_untuk'),
            'tgl_terima' => $this->request->getVar('tgl_terima'),
            'perihal' => $this->request->getVar('perihal'),
            'dokumen' => $namaFile,
            'slug' => $slug
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/sm');
    }

    public function delete($id)
    {
        $surat = $this->SmModel->find($id);
        unlink('fileSurat/' . $surat['dokumen']);

        $this->SmModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('sm');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Surat Masuk',
            'user' => 'Admin',
            'validation' => \config\Services::validation(),
            'surat' => $this->SmModel->getSm($id),
            'sifat' => $this->sifatModel->getSifat(),
            'jenis' => $this->jenisModel->getJenis()
        ];
        return view('admin/suratmasuk/edit', $data);
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
            'surat_dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Asal Surat harus diisi'
                ]
            ],
            'surat_untuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tujuan Surat harus diisi'
                ]
            ],
            'tgl_terima' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Surat harus diisi'
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
            return redirect()->to('/sm/edit/' . $this->request->getVar('id_masuk'))->withInput();
        }
        $fileSurat = $this->request->getFile('dokumen');

        if ($fileSurat->getError() == 4) {
            $namaFile = $this->request->getVar('fileLama');
        } else {
            $namaFile = $fileSurat->getName();
            $fileSurat->move('fileSurat', $namaFile);
            unlink('fileSurat/' . $this->request->getVar('fileLama'));
        }

        $slug = url_title($this->request->getVar('perihal'), '-', true);
        $this->SmModel->save([
            'id_masuk' => $id,
            'no_surat' => $this->request->getVar('no_surat'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'id_sifat' => $this->request->getVar('id_sifat'),
            'surat_dari' => $this->request->getVar('surat_dari'),
            'surat_untuk' => $this->request->getVar('surat_untuk'),
            'tgl_terima' => $this->request->getVar('tgl_terima'),
            'perihal' => $this->request->getVar('perihal'),
            'dokumen' => $namaFile,
            'slug' => $slug
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/sm');
    }
}
