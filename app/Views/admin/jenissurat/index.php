<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                    <i class="fas fa-table me-1"></i>
                    Data Jenis Surat Masuk

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
                                <th>Jenis Surat</th>
                                <th class="text-center col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($jenis as $data) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $data['jenis']; ?></td>
                                    <td class="d-flex flex-column">
                                        <a href="/sm/edit/<?= $data['id_jenis']; ?>" class="btn btn-primary p-0 mx-auto mb-2 w-25"><i class="fas fa-pencil"></i></a>
                                        <form action="/sm/<?= $data['id_jenis']; ?>" method="post" class="d-inline mx-auto">
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