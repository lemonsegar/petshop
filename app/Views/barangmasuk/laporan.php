<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<style>
    .form-group label {
        color: #6777ef;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-filter {
        margin-top: 31px;
    }

    .table th {
        background-color: #f8f9fa;
        font-size: 14px;
    }

    .table td {
        font-size: 14px;
        vertical-align: middle;
    }

    .total-row {
        background-color: #f8f9fa;
        font-weight: 600;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Laporan Barang Masuk</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="" method="get" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Filter Berdasarkan</label>
                            <select class="form-control" name="filter_type" id="filter_type">
                                <option value="tanggal" <?= ($filter_type == 'tanggal') ? 'selected' : '' ?>>Tanggal</option>
                                <option value="bulan" <?= ($filter_type == 'bulan') ? 'selected' : '' ?>>Bulan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Filter Tanggal -->
                    <div class="col-md-6 filter-tanggal" <?= ($filter_type == 'bulan') ? 'style="display:none"' : '' ?>>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Awal</label>
                                    <input type="date" class="form-control" name="tgl_awal" value="<?= $tgl_awal ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="tgl_akhir" value="<?= $tgl_akhir ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Bulan -->
                    <div class="col-md-6 filter-bulan" <?= ($filter_type == 'tanggal') ? 'style="display:none"' : '' ?>>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select class="form-control" name="bulan">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $i = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        ?>
                                            <option value="<?= $i ?>" <?= ($bulan == $i) ? 'selected' : '' ?>>
                                                <?= bulan($i) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select class="form-control" name="tahun">
                                        <?php
                                        $tahun_sekarang = date('Y');
                                        for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 5; $i--) {
                                        ?>
                                            <option value="<?= $i ?>" <?= ($tahun == $i) ? 'selected' : '' ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="btn-filter">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="<?= site_url('barangmasuk/laporan') ?>" class="btn btn-light">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                            <a href="<?= site_url('barangmasuk/cetakpdf') . "?" . http_build_query($_GET) ?>"
                                class="btn btn-danger" target="_blank">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%">No Faktur</th>
                            <th width="30%">Produk</th>
                            <th class="text-right" width="10%">Jumlah</th>
                            <th class="text-right" width="15%">Harga</th>
                            <th class="text-right" width="15%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($barang_masuk as $row) :
                            $total += $row['subtotal'];
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                                <td><?= $row['no_faktur'] ?></td>
                                <td><?= $row['nama_produk'] ?></td>
                                <td class="text-right"><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                <td class="text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td class="text-right">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <th colspan="6" class="text-right">Total</th>
                            <th class="text-right">Rp <?= number_format($total, 0, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            "pageLength": 25,
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Toggle filter type
        $('#filter_type').change(function() {
            if ($(this).val() == 'tanggal') {
                $('.filter-tanggal').show();
                $('.filter-bulan').hide();
            } else {
                $('.filter-tanggal').hide();
                $('.filter-bulan').show();
            }
        });

        // Validasi tanggal
        $('input[name="tgl_awal"]').on('change', function() {
            let tgl_awal = $(this).val();
            let tgl_akhir = $('input[name="tgl_akhir"]').val();

            if (tgl_awal > tgl_akhir) {
                $('input[name="tgl_akhir"]').val(tgl_awal);
            }
        });
    });
</script>
<?= $this->endSection() ?>