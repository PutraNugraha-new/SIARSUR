<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/sm">Surat Masuk</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <?= $title; ?>

                </div>
                <form action="/admin/sm/save" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="no_agenda" class="mb-2">No Agenda</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('no_agenda')) ? 'is-invalid' : ''; ?>" name="no_agenda" placeholder="nomor agenda" id="no_agenda" autofocus value="<?= old('no_agenda'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_agenda'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_surat" class="mb-2">No Surat</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('no_surat')) ? 'is-invalid' : ''; ?>" name="no_surat" placeholder="nomor surat" id="nosurat" autofocus value="<?= old('no_surat'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no_surat'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tglsurat" class="mb-    2">Tanggal Surat</label>
                                    <input type="date" name="tgl_surat" class="form-control <?= ($validation->hasError('tgl_surat ')) ? 'is-invalid' : ''; ?>" id="tglsurat" value="<?= old('tgl_surat'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tgl_surat'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tglterima" class="mb-2">Tanggal Diterima</label>
                                    <input type="date" name="tgl_terima" class="form-control <?= ($validation->hasError('tgl_terima ')) ? 'is-invalid' : ''; ?>" id="tglterima" value="<?= old('tgl_terima'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tgl_terima'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="perihal" class="mb-2">Perihal</label>
                                    <textarea class="form-control <?= ($validation->hasError('perihal')) ? 'is-invalid' : ''; ?>" name="perihal" id="perihal"></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('perihal'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_sifat" class="mb-2">Sifat</label>
                                    <select id="id_sifat" name="id_sifat" class="form-select <?= ($validation->hasError('id_sifat')) ? 'is-invalid' : ''; ?>" value="<?= old('id_sifat'); ?>">
                                        <option hidden value=""></option>
                                        <?php foreach ($sifat as $data) : ?>
                                            <option value="<?= $data['id_sifat']; ?>"><?= $data['sifat']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sifat'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="id_jenis" class="mb-2">jenis</label>
                                    <select id="id_jenis" name="id_jenis" class="form-select <?= ($validation->hasError('id_jenis')) ? 'is-invalid' : ''; ?>">
                                        <option hidden value=""></option>
                                        <?php foreach ($jenis as $data) : ?>
                                            <option value="<?= $data['id_jenis']; ?>"><?= $data['jenis']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('sifat'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="surat_dari" class="mb-2">Surat Dari</label>
                                    <input type="text" name="surat_dari" class="form-control <?= ($validation->hasError('surat_dari')) ? 'is-invalid' : ''; ?>" id="surat_dari" value="<?= old('surat_dari'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('surat_dari'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="surat_untuk" class="mb-2">Surat Untuk</label>
                                    <input type="text" name="surat_untuk" class="form-control <?= ($validation->hasError('surat_untuk')) ? 'is-invalid' : ''; ?>" id="surat_untuk" value="<?= old('surat_untuk'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('surat_untuk'); ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dokumen" class="mb-2">Upload Dokumen</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control <?= ($validation->hasError('dokumen')) ? 'is-invalid' : ''; ?>" id="dokumen" name="dokumen">
                                        <label class="input-group-text" for="dokumen">Upload</label>
                                        <div class="invalid-feedback" value="<?= old('dokumen'); ?>">
                                            <?= $validation->getError('dokumen'); ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambahkan Data</button>
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