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
                <div class="card-header bg-dark text-light">
                    <i class="fas fa-table me-1"></i>
                    Data Semua Surat Masuk

                </div>
                <div class="card-body">
                    <a href="/sm/create" class="btn btn-primary mb-1">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </a>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-primary" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat / tgl Surat</th>
                                <th>Tanggal Diterima</th>
                                <th>Perihal / keterangan</th>
                                <th>Sifat | Jenis</th>
                                <th>Nama Instansi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($surat as $data) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>
                                        <?= $data->no_surat; ?> - <br>
                                        <?= $data->tgl_surat; ?>

                                    </td>
                                    <td><?= $data->tgl_terima; ?></td>
                                    <td><?= $data->perihal; ?></td>
                                    <td><?= $data->sifat; ?> | <?= $data->jenis; ?></td>
                                    <td><?= $data->surat_dari; ?></td>
                                    <td class="d-flex flex-column">
                                        <a href="/sm/edit/<?= $data->id_masuk; ?>" class="btn btn-primary p-0"><i class="fas fa-pencil"></i></a>
                                        <a href="<?= base_url('filesurat/' . $data->dokumen); ?>" class="btn btn-success p-0 my-1"><i class="fas fa-download"></i></a>
                                        <form action="/sm/<?= $data->id_masuk; ?>" method="post" class="d-inline mx-auto">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger py-0" onclick="return confirm('yakin ingin menghapus ??')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php $i++;
                            endforeach; ?>
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