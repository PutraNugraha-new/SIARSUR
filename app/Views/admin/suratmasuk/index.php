<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Semua Surat Masuk

                </div>
                <div class="card-body">
                    <a href="/sm/create" class="btn btn-primary mb-1">
                        <i class="fas fa-plus"></i>
                        Tambah Arsip
                    </a>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Tanggal Diterima</th>
                                <th>Perihal</th>
                                <th>Sifat</th>
                                <th>Jenis</th>
                                <th>Nama Instansi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($surat as $data) : ?>
                                <tr>
                                    <td><?= $data->no_surat; ?></td>
                                    <td><?= $data->tgl_surat; ?></td>
                                    <td><?= $data->tgl_terima; ?></td>
                                    <td><?= $data->perihal; ?></td>
                                    <td><?= $data->sifat; ?></td>
                                    <td><?= $data->jenis; ?></td>
                                    <td><?= $data->surat_dari; ?></td>
                                    <td class="justify-content-center d-flex ">
                                        <a href="#" class="btn btn-primary">Edit</a>
                                        <!-- <a href="#" class="btn btn-success  mx-2" for="staticBackdrop-<?= $data->no_surat; ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop-<?= $data->no_surat; ?>">Detail</a> -->
                                        <button type="button" class="btn btn-success mx-2 tampilModaldetail" data-id="<?= $data->no_surat; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Detail
                                        </button>
                                        <a href="#" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<?= $this->endSection(); ?>