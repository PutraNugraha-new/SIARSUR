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
                    <?= $title; ?>

                </div>
                <div class="card-body">
                    <form action="/sm/save" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="nosurat" class="col-sm-2 col-form-label">Nomor Surat</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_surat" class="form-control <?= ($validation->hasError('no_surat ')) ? 'is-invalid' : ''; ?>" id="nosurat" autofocus value="<?= old('no_surat'); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tglsurat" class="col-sm-2 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_surat" class="form-control <?= ($validation->hasError('tgl_surat')) ? 'is-invalid' : ''; ?>" id="tglsurat" value="<?= old('tgl_surat'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_surat'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tglditerima" class="col-sm-2 col-form-label">Tanggal Diterima</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_diterima" class="form-control <?= ($validation->hasError('tgl_diterima')) ? 'is-invalid' : ''; ?>" id="tglditerima" value="<?= old('tgl_diterima'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_diterima'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                            <div class="col-sm-10">
                                <input type="text" name="perihal" class="form-control <?= ($validation->hasError('perihal')) ? 'is-invalid' : ''; ?>" id="perihal" value="<?= old('perihal'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('perihal'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="sifat" class="col-sm-2 col-form-label">Sifat</label>
                            <div class="col-sm-10">
                                <select id="sifat" name="sifat" class="form-select <?= ($validation->hasError('sifat')) ? 'is-invalid' : ''; ?>" value="<?= old('sifat'); ?>">
                                    <option disabled selected>Pilih Sifat Surat</option>
                                    <?php foreach ($sifat as $data) : ?>
                                        <option value="<?= $data['sifat']; ?>"><?= $data['sifat']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sifat'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                                <select id="jenis" name="jenis" class="form-select <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" value="<?= old('jenis'); ?>">
                                    <option disabled selected>Pilih jenis Surat</option>
                                    <?php foreach ($jenis as $data) : ?>
                                        <option value="<?= $data['jenis']; ?>"><?= $data['jenis']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jenis'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="surat_dari" class="col-sm-2 col-form-label">Surat Dari</label>
                            <div class="col-sm-10">
                                <input type="text" name="surat_dari" class="form-control <?= ($validation->hasError('surat_dari')) ? 'is-invalid' : ''; ?>" id="surat_dari" value="<?= old('surat_dari'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('surat_dari'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="surat_untuk" class="col-sm-2 col-form-label">Surat Untuk</label>
                            <div class="col-sm-10">
                                <input type="text" name="surat_untuk" class="form-control <?= ($validation->hasError('surat_untuk')) ? 'is-invalid' : ''; ?>" id="surat_untuk" value="<?= old('surat_untuk'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('surat_untuk'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" class="<?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" cols="100" rows="10"><?= old('keterangan'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('keterangan'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="file" class="col-sm-2 col-form-label">Upload Dokumen</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control <?= ($validation->hasError('file')) ? 'is-invalid' : ''; ?>" id="file" name="file">
                                    <label class="input-group-text" for="file">Upload</label>
                                    <div class="invalid-feedback" value="<?= old('file'); ?>">
                                        <?= $validation->getError('file'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan Data</button>
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