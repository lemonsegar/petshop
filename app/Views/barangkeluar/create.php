<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Tambah Barang Keluar</h1>
</div>

<div class="section-body">
    <div class="card">
        <form action="<?= site_url('barangkeluar/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" value="<?= $no_faktur ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <div class="input-group">
                                <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                                <input type="text" class="form-control" id="nama_pelanggan" readonly required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPelanggan">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="detail_table">
                            <thead class="bg-light">
                                <tr>
                                    <th width="35%">Produk</th>
                                    <th width="20%">Jumlah</th>
                                    <th width="20%">Harga</th>
                                    <th width="20%">Subtotal</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="id_produk[]" class="form-control select2" required>
                                            <option value="">Pilih Produk</option>
                                            <?php foreach ($produk as $row): ?>
                                                <option value="<?= $row->id_produk ?>" data-harga="<?= $row->harga ?>" data-stok="<?= $row->stok ?>">
                                                    <?= $row->nama_produk ?> (Stok: <?= $row->stok ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" name="jumlah[]" class="form-control jumlah" min="1" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Unit</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" name="harga[]" class="form-control harga text-right" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" name="subtotal[]" class="form-control subtotal text-right" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm hapus-baris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right font-weight-bold">Total</td>
                                    <td>
                                        <div class="input">

                                            <input type="number" name="total_harga" class="form-control text-right" id="total" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
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
                <a href="<?= site_url('barangkeluar') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        function initSelect2(element) {
            $(element).select2({
                width: '100%',
                placeholder: 'Pilih Produk',
                allowClear: true
            });
        }

        // Inisialisasi awal
        initSelect2('.select2');

        // Event saat produk dipilih
        $(document).on('change', '.select2', function() {
            var row = $(this).closest('tr');
            var selected = $(this).find(':selected');
            var harga = selected.data('harga') || 0;
            var stok = selected.data('stok') || 0;

            row.find('.harga').val(harga);
            row.find('.jumlah')
                .attr('max', stok)
                .attr('placeholder', 'Max: ' + stok);

            hitungSubtotal(row);
        });

        // Event untuk perubahan jumlah
        $(document).on('input', '.jumlah', function() {
            var row = $(this).closest('tr');
            var jumlah = parseInt($(this).val()) || 0;
            var max = parseInt($(this).attr('max')) || 0;

            if (jumlah > max) {
                alert('Stok tidak mencukupi! Maksimal: ' + max);
                $(this).val(max);
            }

            hitungSubtotal(row);
        });

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

        // Hapus baris
        $(document).on('click', '.hapus-baris', function() {
            var tbody = $('#detail_table tbody');
            var row = $(this).closest('tr');

            if (tbody.find('tr').length > 1) {
                row.remove();
            } else {
                row.find('input').val('');
                row.find('select').val(null).trigger('change');
            }
            hitungTotal();
        });

        // Tambah baris baru
        $('#tambah-baris').click(function() {
            var newRow = `
                <tr>
                    <td>
                        <select name="id_produk[]" class="form-control select2-new" required>
                            <option value="">Pilih Produk</option>
                            <?php foreach ($produk as $row): ?>
                            <option value="<?= $row->id_produk ?>" 
                                    data-harga="<?= $row->harga ?>"
                                    data-stok="<?= $row->stok ?>">
                                <?= $row->nama_produk ?> (Stok: <?= $row->stok ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="number" name="jumlah[]" class="form-control jumlah" min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="harga[]" class="form-control harga text-right" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="subtotal[]" class="form-control subtotal text-right" readonly>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm hapus-baris">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            $('#detail_table tbody').append(newRow);

            // Inisialisasi Select2 pada baris baru
            initSelect2('#detail_table tbody tr:last .select2-new');
            // Ubah kelas setelah inisialisasi
            $('#detail_table tbody tr:last .select2-new').removeClass('select2-new').addClass('select2');
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

        // Inisialisasi DataTable untuk tabel pelanggan
        var tablePelanggan = $('#tablePelanggan').DataTable({
            processing: true,
            language: {
                processing: '<i class="fas fa-spinner fa-spin fa-lg"></i> Memuat data...',
                zeroRecords: 'Tidak ada data yang ditemukan',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
                infoFiltered: '(difilter dari _MAX_ total data)',
                search: 'Cari:',
                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                },
                lengthMenu: 'Tampilkan _MENU_ data'
            },
            ajax: {
                url: '<?= site_url('pelanggan/datatables') ?>',
                type: 'POST',
                data: function(d) {
                    d.<?= csrf_token() ?> = '<?= csrf_hash() ?>'
                }
            },
            columns: [{
                    data: 'nama_pelanggan',
                    width: '30%'
                },
                {
                    data: 'alamat',
                    width: '35%'
                },
                {
                    data: 'no_telfon',
                    width: '20%'
                },
                {
                    data: null,
                    width: '15%',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `<button type="button" class="btn btn-primary btn-sm pilih-pelanggan" 
                                data-id="${data.id_pelanggan}" 
                                data-nama="${data.nama_pelanggan}">
                                <i class="fas fa-check"></i> Pilih
                                </button>`;
                    }
                }
            ],
            order: [
                [0, 'asc']
            ],
            pageLength: 10,
            responsive: true,
            autoWidth: false
        });

        // Pilih Pelanggan
        $(document).on('click', '.pilih-pelanggan', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#id_pelanggan').val(id);
            $('#nama_pelanggan').val(nama);
            $('#modalPelanggan').modal('hide');
        });
    });
</script>
<?= $this->endSection() ?>