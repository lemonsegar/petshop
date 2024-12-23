<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Detail Barang Masuk</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="200">No Faktur</th>
                            <td><?= $barangmasuk['no_faktur'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d/m/Y', strtotime($barangmasuk['tanggal'])) ?></td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td><?= $barangmasuk['supplier'] ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= $barangmasuk['keterangan'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($detail as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_produk'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total</strong></td>
                                <td>Rp <?= number_format($barangmasuk['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?= site_url('barangmasuk') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>