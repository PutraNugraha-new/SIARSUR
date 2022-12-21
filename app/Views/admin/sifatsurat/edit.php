<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/jenis">Sifat Surat</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <?= $title; ?>

                </div>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <form action="/admin/sifat/update/<?= $sifat['id_sifat']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="sifat" class="mb-2">Sifat Surat</label>
                                    <input type="hidden" name="id_sifat" value="<?= $sifat['id_sifat']; ?>">
                                    <input type="text" class="form-control <?= ($validation->hasError('sifat')) ? 'is-invalid' : ''; ?>" name="sifat" placeholder="sifat surat" id="nosurat" value="<?= $sifat['sifat']; ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sifat'); ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                        </div>



                </form>
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