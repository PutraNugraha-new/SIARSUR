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

    img {
        width: 50%;
    }
</style>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No surat</th>
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