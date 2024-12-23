<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Edit Barang Masuk</h1>
</div>

<div class="section-body">
    <div class="card">
        <form action="<?= site_url('barangmasuk/update/' . $barangmasuk['id_barang_masuk']) ?>" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" class="form-control" value="<?= $barangmasuk['no_faktur'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $barangmasuk['tanggal'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <input type="text" class="form-control" name="supplier" value="<?= $barangmasuk['supplier'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="5"><?= $barangmasuk['keterangan'] ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="detail_table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $row): ?>
                                    <tr>
                                        <td>
                                            <select name="id_produk[]" class="form-control select2" required>
                                                <option value="">Pilih Produk</option>
                                                <?php foreach ($produk as $p): ?>
                                                    <option value="<?= $p->id_produk ?>"
                                                        data-harga="<?= $p->harga ?>"
                                                        <?= ($p->id_produk == $row['id_produk']) ? 'selected' : '' ?>>
                                                        <?= $p->nama_produk ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control jumlah" value="<?= $row['jumlah'] ?>" required>
                                        </td>
                                        <td>
                                            <input type="number" name="harga[]" class="form-control harga" value="<?= $row['harga'] ?>" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="subtotal[]" class="form-control subtotal" value="<?= $row['subtotal'] ?>" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm hapus-baris" style="border-radius: 50%;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Total</td>
                                    <td>
                                        <input type="number" name="total_harga" class="form-control" id="total" value="<?= $barangmasuk['total_harga'] ?>" readonly>
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
        // Inisialisasi Select2
        function initSelect2() {
            $('.select2').select2({
                width: '100%',
                placeholder: 'Pilih Produk',
                allowClear: true
            });
        }

        // Inisialisasi awal
        initSelect2();

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
        $(document).on('change', '.select2', function() {
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
            var lastRow = $('#detail_table tbody tr:last');
            var newRow = lastRow.clone();

            // Bersihkan Select2
            newRow.find('.select2-container').remove();
            newRow.find('select')
                .removeClass('select2-hidden-accessible')
                .removeAttr('data-select2-id')
                .find('option')
                .removeAttr('data-select2-id');

            // Reset nilai
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

        // Hapus baris
        $(document).on('click', '.hapus-baris', function() {
            var row = $(this).closest('tr');
            if ($('#detail_table tbody tr').length > 1) {
                // Hapus Select2 sebelum menghapus baris
                var select2Instance = row.find('.select2');
                if (select2Instance.data('select2')) {
                    select2Instance.select2('destroy');
                }
                row.remove();
                hitungTotal();
            } else {
                alert('Minimal harus ada satu baris');
                // Reset baris pertama
                row.find('input').val('');
                row.find('select').val('').trigger('change');
                hitungTotal();
            }
        });

        // Validasi sebelum submit
        $('form').on('submit', function(e) {
            var valid = false;

            $('#detail_table tbody tr').each(function() {
                var produk = $(this).find('select').val();
                var jumlah = $(this).find('.jumlah').val();

                if (produk && jumlah) {
                    valid = true;
                    return false; // break loop
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Mohon isi minimal satu produk');
                return false;
            }

            // Hapus baris kosong sebelum submit
            $('#detail_table tbody tr').each(function() {
                var produk = $(this).find('select').val();
                var jumlah = $(this).find('.jumlah').val();

                if (!produk || !jumlah) {
                    $(this).remove();
                }
            });

            return true;
        });
    });
</script>
<?= $this->endSection() ?>