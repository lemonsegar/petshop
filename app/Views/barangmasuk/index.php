<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Data Barang Masuk</h1>
    <div class="section-header-button">
        <a href="<?= site_url('barangmasuk/create') ?>" class="btn btn-primary">Tambah Baru</a>
    </div>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($barangmasuk as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['no_faktur'] ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                                <td><?= $row['supplier'] ?></td>
                                <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                <td>
                                    <a href="<?= site_url('barangmasuk/show/' . $row['id_barang_masuk']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= site_url('barangmasuk/edit/' . $row['id_barang_masuk']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= site_url('barangmasuk/delete/' . $row['id_barang_masuk']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                </td>
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
    $("#table-1").dataTable();
</script>
<?= $this->endSection() ?>