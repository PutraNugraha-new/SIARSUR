<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- <h1 class="mt-4"><?= $title; ?></h1> -->
            <ol class="breadcrumb my-4">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-header bg-dark text-light">
                    <i class="fas fa-table me-1"></i>
                    Data Semua Surat Masuk

                </div>
                <div class="card-body">
                    <a href="/sm/create" class="btn btn-outline-primary mb-1 shadow">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </a>
                    <!-- <a href="/sm/printPdf" class="btn btn-success mb-1" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-print"></i>
                        Cetak
                    </a> -->
                    <button type="button" class="btn btn-outline-success mb-1 shadow" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-print"></i> Laporan
                    </button>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-primary" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Agenda</th>
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
                                    <td><?= $data->no_agenda; ?></td>
                                    <td>
                                        <?= $data->no_surat; ?> - <br>
                                        <b> <?= $data->tgl_surat; ?></b>
                                    </td>
                                    <td><?= $data->tgl_terima; ?></td>
                                    <td><?= $data->perihal; ?></td>
                                    <td><?= $data->sifat; ?> | <b> <?= $data->jenis; ?> </b></td>
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
    <!-- modals -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/sm/printPdf" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="bulan" class="mb-2">Dari Bulan</label>
                            <input type="date" class="form-control" name="tgl_awal" id="bulan">
                            <small class="text-danger">Jangan diisi jika ingin mencetak semua tanggal</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bulan" class="mb-2">Sampai Bulan</label>
                            <input type="date" class="form-control" name="tgl_akhir" id="bulan">
                            <small class="text-danger">Jangan diisi jika ingin mencetak semua tanggal</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_sifat" class="mb-2">Sifat</label>
                            <select id="id_sifat" name="sifat" class="form-select">
                                <option hidden value=""></option>
                                <?php foreach ($sifat as $data) : ?>
                                    <option value="<?= $data['sifat']; ?>"><?= $data['sifat']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->
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