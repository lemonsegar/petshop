<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="section-header">
    <h1>Edit Pelayanan</h1>
</div>

<div class="section-body">
    <div class="card">
        <form action="<?= site_url('pelayanan/update/' . $pelayanan->id_pelayanan) ?>" method="post">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" class="form-control" name="no_faktur" value="<?= $pelayanan->no_faktur ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $pelayanan->tanggal ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <div class="input-group">
                                <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= $pelayanan->id_pelanggan ?>">
                                <input type="text" class="form-control" id="nama_pelanggan" value="<?= $pelayanan->nama_pelanggan ?>" readonly required>
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
                            <textarea class="form-control" name="keterangan" rows="5"><?= $pelayanan->keterangan ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="detail_table">
                            <thead class="bg-light">
                                <tr>
                                    <th width="35%">Layanan</th>
                                    <th width="30%">Harga</th>
                                    <th width="30%">Subtotal</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $row) : ?>
                                    <tr>
                                        <td>
                                            <select name="id_layanan[]" class="form-control select2-new" required>
                                                <option value="">Pilih Layanan</option>
                                                <?php foreach ($layanan as $l) : ?>
                                                    <option value="<?= $l['id_layanan'] ?>"
                                                        data-harga="<?= $l['harga'] ?>"
                                                        <?= ($l['id_layanan'] == $row['id_layanan']) ? 'selected' : '' ?>>
                                                        <?= $l['nama_layanan'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" name="harga[]" class="form-control harga text-right" value="<?= $row['harga'] ?>" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" name="subtotal[]" class="form-control subtotal text-right" value="<?= $row['subtotal'] ?>" readonly>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm hapus-baris">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right font-weight-bold">Total</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" name="total_harga" class="form-control text-right" id="total" value="<?= $pelayanan->total_harga ?>" readonly>
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
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= site_url('pelayanan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk semua baris
        initSelect2();

        // Tambah baris baru
        $('#tambah-baris').click(function() {
            var newRow = `
                <tr>
                    <td>
                        <select name="id_layanan[]" class="form-control select2-new" required>
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($layanan as $row) : ?>
                                <option value="<?= $row['id_layanan'] ?>" data-harga="<?= $row['harga'] ?>">
                                    <?= $row['nama_layanan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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
            initSelect2();
        });

        // Fungsi inisialisasi Select2
        function initSelect2() {
            $('.select2-new').select2({
                placeholder: 'Pilih Layanan',
                allowClear: true
            }).removeClass('select2-new');
        }

        // Event saat layanan dipilih
        $(document).on('change', 'select[name="id_layanan[]"]', function() {
            var row = $(this).closest('tr');
            var selected = $(this).find(':selected');
            var harga = selected.data('harga') || 0;

            row.find('.harga').val(harga);
            row.find('.subtotal').val(harga);
            hitungTotal();
        });

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
            if (tbody.find('tr').length > 1) {
                $(this).closest('tr').remove();
                hitungTotal();
            } else {
                alert('Minimal harus ada satu baris');
            }
        });

        // DataTable Pelanggan
        var tablePelanggan = $('#tablePelanggan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= site_url('pelanggan/datatables') ?>',
                type: 'POST',
                data: function(d) {
                    d.<?= csrf_token() ?> = '<?= csrf_hash() ?>';
                    return d;
                }
            },
            columns: [{
                    data: 'nama_pelanggan'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'no_telfon'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
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
            ]
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
</script><?= $this->endSection() ?>