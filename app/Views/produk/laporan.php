<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Laporan Data Produk</h1>
</div>

<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-12">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-primary">Dari</label>
                                    <select class="form-control form-control-sm" name="dari" id="dari">
                                        <?php foreach ($produk_list as $p) : ?>
                                            <option value="<?= $p['id_produk'] ?>" <?= ($dari == $p['id_produk']) ? 'selected' : '' ?>>
                                                <?= $p['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-primary">Sampai</label>
                                    <select class="form-control form-control-sm" name="sampai" id="sampai">
                                        <?php foreach ($produk_list as $p) : ?>
                                            <option value="<?= $p['id_produk'] ?>" <?= ($sampai == $p['id_produk']) ? 'selected' : '' ?>>
                                                <?= $p['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-top: 28px;">
                                    <button type="submit" class="btn btn-sm btn-primary px-4">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="<?= site_url('produk/laporan') ?>" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-sync"></i> Reset
                                    </a>
                                    <a href="<?= site_url('produk/cetakpdf') . "?dari={$dari}&sampai={$sampai}" ?>"
                                        class="btn btn-sm btn-danger" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Cetak PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="tabel">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="10%">ID Produk</th>
                            <th width="30%">Nama Produk</th>
                            <th width="20%">Kategori</th>
                            <th class="text-right" width="15%">Stok</th>
                            <th class="text-right" width="20%">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($produk as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $row['id_produk'] ?></td>
                                <td><?= $row['nama_produk'] ?></td>
                                <td><?= $row['kategori'] ?></td>
                                <td class="text-right"><?= number_format($row['stok'], 0, ',', '.') ?></td>
                                <td class="text-right">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<style>
    .form-control-sm {
        height: calc(1.5em + 0.5rem + 2px);
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .table-sm td,
    .table-sm th {
        padding: 0.3rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            "pageLength": 10,
            "order": [],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
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

        // Validasi input
        $('#dari').on('change', function() {
            let dari = $(this).val();
            let sampai = $('#sampai').val();

            if (dari > sampai) {
                $('#sampai').val(dari);
            }
        });
    });
</script>
<?= $this->endSection() ?>