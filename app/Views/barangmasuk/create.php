<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 36px !important;
        border: 1px solid #e4e6fc !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }

    .table td {
        vertical-align: middle !important;
    }

    .hapus-baris {
        width: 35px;
        height: 35px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        background-color: #ff4081;
        border: none;
    }

    .hapus-baris:hover {
        background-color: #f50057;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .hapus-baris i {
        font-size: 14px;
    }
</style>

<div class="section-header">
    <h1>Tambah Barang Masuk</h1>
</div>

<div class="section-body">
    <div class="card">
        <form action="<?= site_url('barangmasuk/store') ?>" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" value="<?= $no_faktur ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <input type="text" class="form-control" name="supplier" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="detail_table">
                            <thead>
                                <tr>
                                    <th width="35%">Produk</th>
                                    <th width="15%">Jumlah</th>
                                    <th width="20%">Harga</th>
                                    <th width="20%">Subtotal</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="id_produk[]" class="form-control produk select2" required>
                                            <option value="">Pilih Produk</option>
                                            <?php foreach ($produk as $row): ?>
                                                <option value="<?= $row->id_produk ?>"
                                                    data-harga="<?= $row->harga ?>">
                                                    <?= $row->nama_produk ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control jumlah" required>
                                    </td>
                                    <td>
                                        <input type="number" name="harga[]" class="form-control harga" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="subtotal[]" class="form-control subtotal" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm hapus-baris" style="border-radius: 50%;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Total</td>
                                    <td>
                                        <input type="number" name="total_harga" class="form-control" id="total" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" id="tambah-baris">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('barangmasuk') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada load pertama
        initSelect2();

        // Fungsi untuk inisialisasi Select2
        function initSelect2() {
            $('.select2').select2({
                width: '100%',
                placeholder: 'Pilih Produk',
                allowClear: true
            }).on('select2:unselecting', function() {
                $(this).data('unselecting', true);
            }).on('select2:opening', function(e) {
                if ($(this).data('unselecting')) {
                    $(this).removeData('unselecting');
                    e.preventDefault();
                }
            });
        }

        // Hitung subtotal
        function hitungSubtotal(row) {
            var jumlah = parseInt(row.find('.jumlah').val()) || 0;
            var harga = parseInt(row.find('.harga').val()) || 0;
            var subtotal = jumlah * harga;
            row.find('.subtotal').val(subtotal);
            hitungTotal();
        }

        // Hitung total
        function hitungTotal() {
            var total = 0;
            $('.subtotal').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#total').val(total);
        }

        // Event saat produk dipilih
        $(document).on('change', '.produk', function() {
            var row = $(this).closest('tr');
            var harga = $(this).find(':selected').data('harga');
            row.find('.harga').val(harga);
            hitungSubtotal(row);
        });

        // Event untuk perubahan jumlah
        $(document).on('input', '.jumlah', function() {
            hitungSubtotal($(this).closest('tr'));
        });

        // Tambah baris baru
        $('#tambah-baris').click(function() {
            var firstRow = $('#detail_table tbody tr:first');
            var newRow = firstRow.clone(true);

            try {
                // Hapus Select2 dari elemen yang akan diclone
                newRow.find('.select2-container').remove();
                newRow.find('select')
                    .removeAttr('data-select2-id')
                    .removeAttr('aria-hidden')
                    .removeAttr('tabindex');
            } catch (e) {
                console.log('Error saat membersihkan Select2:', e);
            }

            // Reset nilai-nilai
            newRow.find('input').val('');
            newRow.find('select').val('');

            // Tambahkan baris baru
            $('#detail_table tbody').append(newRow);

            // Inisialisasi Select2 pada baris baru
            newRow.find('select').select2({
                width: '100%',
                placeholder: 'Pilih Produk',
                allowClear: true
            });
        });

        // Perbaikan fungsi hapus baris
        $(document).on('click', '.hapus-baris', function() {
            var row = $(this).closest('tr');
            if ($('#detail_table tbody tr').length > 1) {
                try {
                    // Hapus event handler Select2 terlebih dahulu
                    row.find('select').off().select2('destroy');
                } catch (e) {
                    console.log('Select2 sudah di-destroy atau belum diinisialisasi');
                }

                // Hapus elemen select2 dari DOM
                row.find('.select2-container').remove();

                // Hapus baris
                row.remove();

                // Hitung ulang total
                hitungTotal();
            } else {
                // Reset baris terakhir
                row.find('input').val('');
                try {
                    row.find('select').val(null).trigger('change');
                } catch (e) {
                    row.find('select').val('');
                }
                hitungSubtotal(row);
            }
        });

        // Tambahkan animasi hover untuk tombol hapus
        $('.hapus-baris').hover(
            function() {
                $(this).css('transform', 'scale(1.1)');
            },
            function() {
                $(this).css('transform', 'scale(1)');
            }
        );

        // Validasi sebelum submit
        $('form').on('submit', function(e) {
            var valid = false;

            // Cek apakah ada minimal satu baris yang terisi
            $('#detail_table tbody tr').each(function() {
                var produk = $(this).find('.produk').val();
                var jumlah = $(this).find('.jumlah').val();

                if (produk && jumlah) {
                    valid = true;
                    return false; // break loop jika sudah ada yang valid
                }
            });

            // Hapus baris kosong sebelum submit
            $('#detail_table tbody tr').each(function() {
                var produk = $(this).find('.produk').val();
                var jumlah = $(this).find('.jumlah').val();

                if (!produk || !jumlah) {
                    // Destroy Select2 sebelum menghapus baris
                    $(this).find('.select2').select2('destroy');
                    $(this).remove();
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Mohon isi minimal satu produk');
                return false;
            }

            return true;
        });
    });
</script>
<?= $this->endSection() ?>