<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Laporan Data Pelanggan</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="<?= site_url('pelanggan/cetakpdf') ?>" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf"></i> Cetak PDF
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pelanggan as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_pelanggan'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['no_telfon'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
<?= $this->endSection() ?>