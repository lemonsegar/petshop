<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Barang Keluar</h3>
                    <div class="float-right">
                        <a href="<?= site_url('barangkeluar') ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button onclick="printDetail()" class="btn btn-primary btn-sm">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="140px">No. Faktur</th>
                                    <td>: <?= $barangkeluar->no_faktur ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>: <?= date('d/m/Y', strtotime($barangkeluar->tanggal)) ?></td>
                                </tr>
                                <tr>
                                    <th>Pelanggan</th>
                                    <td>: <?= $barangkeluar->nama_pelanggan ?></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>: <?= $barangkeluar->keterangan ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50px">No</th>
                                    <th>Nama Produk</th>
                                    <th width="100px">Jumlah</th>
                                    <th width="150px">Harga</th>
                                    <th width="150px">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail as $row):
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= $row['nama_produk'] ?></td>
                                        <td class="text-center"><?= $row['jumlah'] ?></td>
                                        <td class="text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        <td class="text-right">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total</th>
                                    <th class="text-right">Rp <?= number_format($barangkeluar->total_harga, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Area -->
<div id="print-area" class="d-none">
    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="margin-bottom: 5px;">Detail Barang Keluar</h2>
        <p style="margin: 0;"><?= $barangkeluar->no_faktur ?></p>
    </div>

    <div style="margin-bottom: 20px;">
        <table>
            <tr>
                <td style="width: 120px;">Tanggal</td>
                <td>: <?= date('d/m/Y', strtotime($barangkeluar->tanggal)) ?></td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>: <?= $barangkeluar->nama_pelanggan ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>: <?= $barangkeluar->keterangan ?? '-' ?></td>
            </tr>
        </table>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 5px;">No</th>
                <th style="border: 1px solid #000; padding: 5px;">Nama Produk</th>
                <th style="border: 1px solid #000; padding: 5px;">Jumlah</th>
                <th style="border: 1px solid #000; padding: 5px;">Harga</th>
                <th style="border: 1px solid #000; padding: 5px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($detail as $row):
            ?>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; text-align: center;"><?= $no++ ?></td>
                    <td style="border: 1px solid #000; padding: 5px;"><?= $row['nama_produk'] ?></td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: center;"><?= $row['jumlah'] ?></td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td style="border: 1px solid #000; padding: 5px; text-align: right;">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="border: 1px solid #000; padding: 5px; text-align: right;">Total</th>
                <th style="border: 1px solid #000; padding: 5px; text-align: right;">Rp <?= number_format($barangkeluar->total_harga, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->section('js') ?>
<script>
    function printDetail() {
        var printContent = document.getElementById('print-area').innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;

        window.print();

        document.body.innerHTML = originalContent;
    }
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>