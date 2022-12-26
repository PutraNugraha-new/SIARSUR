<style>
    table {
        border: 1px solid #000 !important;
        border-width: 1px 0 0 1px !important;
        width: 95% !important;
        margin-right: auto !important;
        margin-left: auto !important;
    }

    th {
        background-color: #ccc !important;
    }

    th,
    td {
        border: 1px solid #000 !important;
        border-width: 0 1px 1px 0 !important;
    }

    .container {
        margin: 20px;
        /* border: 1px solid #000; */
    }

    img {
        height: 75px !important;
        width: auto !important;
    }

    .container {
        font-family: 'Times New Roman', Times, serif !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="<?= base_url('assets-admin'); ?>/css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


<div class="container">
    <div class="row my-3 border-bottom">
        <!-- <div class="col-sm-1">
            <img src="<?= base_url('assets-admin'); ?>/img/logo.png" class="ms-4" alt="">
        </div> -->
        <div class="col-sm-12 text-center me-1">
            <strong>PEMERINTAH KOTA PALANGKA RAYA</strong>
            <BR>
            <strong>KANTOR DINAS PENIDIKAN</strong>
            <br>
            <p>Alamat : Jl. G.Obos XI (Komplek Perkantoran Lingkar Dalam Pemko Palangka Raya)
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center font-weight-bold">
            <strong style="font-size: 1.5em;">LAPORAN SURAT MASUK</strong>
        </div>
    </div>
    <div class="row mb-2">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No surat</th>
                    <th>No Agenda</th>
                    <th>Perihal</th>
                    <th>Tanggal Surat</th>
                    <th>Jenis</th>
                    <th>Sifat</th>
                    <th>Asal Surat</th>
                    <th>Tujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($surat as $data) :
                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $data->no_surat; ?></td>
                        <td><?= $data->no_agenda; ?></td>
                        <td><?= $data->perihal; ?></td>
                        <td><?= $data->tgl_surat; ?></td>
                        <td><?= $data->jenis; ?></td>
                        <td><?= $data->sifat; ?></td>
                        <td><?= $data->surat_dari; ?></td>
                        <td><?= $data->surat_untuk; ?></td>
                    </tr>
                <?php $i++;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="<?= base_url('assets-admin'); ?>/js/scripts.js"></script>
<script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= base_url('assets-admin'); ?>/js/datatables-simple-demo.js"></script>
<script script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>

<script>
    window.print()
</script>